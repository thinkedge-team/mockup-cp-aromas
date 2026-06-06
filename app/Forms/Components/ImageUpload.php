<?php

namespace App\Forms\Components;

use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ImageUpload extends FileUpload
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->saveUploadedFileUsing(function (TemporaryUploadedFile $file): string {
            $directory = $this->getDirectory() ?? 'uploads';
            $disk = $this->getDiskName() ?? 'public';
            $mime = $file->getMimeType();

            if (! str_starts_with($mime, 'image/') || $mime === 'image/svg+xml') {
                return $file->storeAs($directory, $file->hashName(), $disk);
            }

            $filename = pathinfo($file->hashName(), PATHINFO_FILENAME).'.webp';

            $image = Image::read($file->getRealPath());

            if ($image->width() > 1920) {
                $image->scaleDown(width: 1920);
            }

            Storage::disk($disk)->put(
                $directory.'/'.$filename,
                $image->toWebp(quality: 82)->toString()
            );

            return $directory.'/'.$filename;
        });

        // Override URL generation so it uses the current request origin instead of
        // APP_URL — FilePond fetches existing files via fetch(), which is CORS-blocked
        // when APP_URL differs from the host the browser used to load the admin.
        $this->getUploadedFileUsing(function (string $file, string|array|null $storedFileNames): ?array {
            $disk = $this->getDisk();

            if ($this->shouldFetchFileInformation()) {
                try {
                    if (! $disk->exists($file)) {
                        return null;
                    }
                } catch (\Throwable) {
                    return null;
                }
            }

            $url = request()->getSchemeAndHttpHost().'/storage/'.ltrim($file, '/');

            return [
                'name' => (is_array($storedFileNames) ? ($storedFileNames[$file] ?? null) : $storedFileNames) ?? basename($file),
                'size' => $this->shouldFetchFileInformation() ? $disk->size($file) : 0,
                'type' => $this->shouldFetchFileInformation() ? $disk->mimeType($file) : null,
                'url' => $url,
            ];
        });
    }
}
