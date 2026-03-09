<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ContactFormController extends Controller
{
    public function send(Request $request): JsonResponse
    {
        // ── 0. Honeypot check ──────────────────────────────────────────────
        // Field 'website' adalah honeypot — manusia tidak akan mengisinya.
        // Jika terisi, kemungkinan besar bot. Kembalikan respons sukses palsu
        // agar bot tidak tahu ia diblokir (silent rejection).
        if ($request->filled('website')) {
            Log::info('Contact form: honeypot terisi dari IP ' . $request->ip());
            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil terkirim! Tim AROMAS akan menghubungi Anda dalam 2 jam kerja.',
            ]);
        }

        // ── 1. Validasi input ──────────────────────────────────────────────
        try {
            $validated = $request->validate([
                'subject' => 'required|string|max:100',
                'name'    => 'required|string|max:150',
                'company' => 'nullable|string|max:150',
                'email'   => 'required|email|max:150',
                'phone'   => ['required', 'string', 'max:20', 'regex:/^[0-9\+\-\s\(\)]+$/'],
                'product' => 'nullable|string|max:100',
                'volume'  => 'nullable|string|max:100',
                'city'    => 'required|string|max:150',
                'message' => 'required|string|max:1000',
                'files'   => 'nullable|array|max:5',
                'files.*' => [
                    'file',
                    'max:5120',
                    'mimes:pdf,jpg,jpeg,png,xlsx',
                ],
            ], [
                // Pesan error dalam Bahasa Indonesia yang ramah pengguna
                'subject.required'  => 'Silakan pilih topik pesan terlebih dahulu.',
                'name.required'     => 'Nama lengkap wajib diisi.',
                'name.max'          => 'Nama terlalu panjang, maksimal 150 karakter.',
                'email.required'    => 'Alamat email wajib diisi.',
                'email.email'       => 'Format email tidak valid. Contoh: nama@domain.com',
                'email.max'         => 'Alamat email terlalu panjang.',
                'phone.required'    => 'Nomor WhatsApp wajib diisi.',
                'phone.regex'       => 'Nomor telepon hanya boleh berisi angka, +, -, spasi, atau tanda kurung.',
                'phone.max'         => 'Nomor telepon terlalu panjang, maksimal 20 karakter.',
                'city.required'     => 'Kota/Provinsi wajib diisi.',
                'message.required'  => 'Isi pesan wajib diisi.',
                'message.max'       => 'Pesan terlalu panjang, maksimal 1000 karakter.',
                'files.max'         => 'Maksimal 5 file lampiran diperbolehkan.',
                'files.*.max'       => 'Ukuran file melebihi batas 5 MB. Harap kompres file Anda.',
                'files.*.mimes'     => 'Format file tidak didukung. Gunakan PDF, JPG, PNG, atau XLSX.',
            ]);
        } catch (ValidationException $e) {
            // Kembalikan error validasi dengan pesan pertama yang ditemukan
            $firstError = collect($e->errors())->flatten()->first();
            return response()->json([
                'success' => false,
                'message' => $firstError,
                'errors'  => $e->errors(),
            ], 422);
        }

        // ── 2. Simpan lampiran ke storage ──────────────────────────────────
        $attachmentPaths = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                try {
                    $path = $file->store('contact-attachments', 'public');
                    $attachmentPaths[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'path'          => $path,
                        'mime'          => $file->getMimeType(),
                        'size'          => $file->getSize(),
                    ];
                } catch (\Exception $e) {
                    Log::warning('Contact form: gagal menyimpan lampiran - ' . $e->getMessage());
                    // Tidak batalkan proses, lanjutkan tanpa file ini
                }
            }
        }

        // ── 3. Simpan ke database ──────────────────────────────────────────
        try {
            ContactMessage::create([
                'subject'     => $validated['subject'],
                'name'        => $validated['name'],
                'company'     => $validated['company'] ?? null,
                'email'       => $validated['email'],
                'phone'       => $validated['phone'],
                'product'     => $validated['product'] ?? null,
                'volume'      => $validated['volume'] ?? null,
                'city'        => $validated['city'],
                'message'     => $validated['message'],
                'attachments' => !empty($attachmentPaths) ? $attachmentPaths : null,
                'status'      => 'new',
            ]);
        } catch (\Exception $e) {
            Log::error('Contact form: gagal menyimpan ke database - ' . $e->getMessage());

            // Hapus file yang sudah terlanjur diupload
            foreach ($attachmentPaths as $att) {
                Storage::disk('public')->delete($att['path']);
            }

            return response()->json([
                'success' => false,
                'message' => 'Maaf, sistem kami sedang mengalami gangguan. Silakan hubungi kami langsung melalui tombol WhatsApp di halaman ini.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil terkirim! Tim AROMAS akan menghubungi Anda dalam 2 jam kerja.',
        ]);
    }
}
