<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pesan Baru dari Website</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; background-color: #f4f7f6; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .header { text-align: center; border-bottom: 2px solid #228b22; padding-bottom: 15px; margin-bottom: 25px; }
        .header h2 { color: #0b2a1a; margin: 0; }
        .content { margin-bottom: 20px; }
        .field { margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .label { font-weight: bold; color: #424242; font-size: 0.9em; text-transform: uppercase; letter-spacing: 0.5px; }
        .value { margin-top: 5px; font-size: 1.05em; color: #111; }
        .message-box { background: #f8f9fa; padding: 15px; border-radius: 6px; border-left: 4px solid #d4a017; font-style: italic; white-space: pre-wrap; margin-top: 5px; }
        .footer { text-align: center; font-size: 0.8em; color: #777; border-top: 1px solid #eee; padding-top: 20px; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pesan Baru dari Formulir Kontak AROMAS</h2>
        </div>
        
        <div class="content">
            <p>Halo Admin, Anda menerima pesan baru dari website AROMAS dengan rincian sebagai berikut:</p>
            
            <div class="field">
                <div class="label">Subjek:</div>
                <div class="value"><strong>{{ $data['subject'] ?? '-' }}</strong></div>
            </div>
            
            <div class="field">
                <div class="label">Nama Lengkap:</div>
                <div class="value">{{ $data['name'] ?? '-' }}</div>
            </div>
            
            <div class="field">
                <div class="label">Nama Perusahaan:</div>
                <div class="value">{{ $data['company'] ?? '-' }}</div>
            </div>
            
            <div class="field">
                <div class="label">Email:</div>
                <div class="value"><a href="mailto:{{ $data['email'] ?? '' }}">{{ $data['email'] ?? '-' }}</a></div>
            </div>
            
            <div class="field">
                <div class="label">No. WhatsApp / HP:</div>
                <div class="value"><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $data['phone'] ?? '') }}" target="_blank">{{ $data['phone'] ?? '-' }}</a></div>
            </div>

            <div class="field">
                <div class="label">Kota / Provinsi:</div>
                <div class="value">{{ $data['city'] ?? '-' }}</div>
            </div>
            
            <div class="field">
                <div class="label">Produk yang Diminati:</div>
                <div class="value">{{ $data['product'] ?? '-' }}</div>
            </div>
            
            <div class="field">
                <div class="label">Estimasi Volume / Bulan:</div>
                <div class="value">{{ $data['volume'] ?? '-' }}</div>
            </div>
            
            <div class="field">
                <div class="label">Isi Pesan:</div>
                <div class="message-box">{{ $data['message'] ?? '-' }}</div>
            </div>

            @if(isset($data['files']) && count($data['files']) > 0)
            <div class="field">
                <div class="label">Lampiran:</div>
                <div class="value" style="color: #228b22; font-weight: bold;">
                    Terlampir {{ count($data['files']) }} file dalam email ini.
                </div>
            </div>
            @endif
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis dari formulir kontak website AROMAS.<br>
            Harap segera balasi pesan ini ke kontak terkait.</p>
        </div>
    </div>
</body>
</html>
