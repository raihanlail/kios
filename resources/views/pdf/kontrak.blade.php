<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>KONTRAK SEWA KIOS</title>
    <style>
         @page { margin: 1.5cm } /* Reduced margin */
        body { 
            font-family: 'Times New Roman', Times, serif; 
            font-size: 11pt; /* Reduced from 12pt */
            line-height: 1.3; /* Reduced from 1.5 */
            background: url('{{ public_path("images/watermark.png") }}') repeat;
        }
        .letterhead {
            text-align: center;
            margin-bottom: 15px; /* Reduced from 20px */
        }
        .company-name {
            font-size: 14pt; /* Reduced from 16pt */
            font-weight: bold;
            margin-bottom: 3px; /* Reduced from 5px */
        }
        .company-tagline {
            font-size: 10pt; /* Reduced from 12pt */
            font-style: italic;
            margin-bottom: 3px;
        }
        .company-address {
            font-size: 9pt; /* Reduced from 11pt */
            margin-bottom: 3px;
        }
        .letterhead-line {
            border-bottom: 2px solid #000; /* Reduced from 3px */
            margin-top: 8px;
            margin-bottom: 15px;
        }
        .header { 
            text-align: center; 
            margin-bottom: 25px; /* Reduced from 30px */
        }
        .title { 
            font-size: 12pt; /* Reduced from 14pt */
            font-weight: bold; 
            text-decoration: underline;
            text-transform: uppercase;
        }
        .parties { 
            margin: 15px 0;
            padding: 12px; /* Reduced from 15px */
        }
        .clause { 
            margin: 12px 0; /* Reduced from 15px */
        }
        .clause-title { 
            font-weight: bold;
            margin-bottom: 8px;
        }
        .signature-area { 
            margin-top: 40px; /* Reduced from 50px */
        }
        .signature-line { 
            width: 75%; /* Reduced from 80% */
            margin: 40px auto 0 auto; /* Reduced from 50px */
        }
        .footer {
            font-size: 8pt; /* Reduced from 9pt */
        }
        .page-number:after {
            content: counter(page);
        }
    </style>
</head>
<body>
    <!-- Kop Surat -->
    <div class="letterhead">
        <div class="company-name">PERUMDA PASAR PAKUAN JAYA</div>
        <div class="company-tagline">"Pasar Bersih Belanja Nyaman Pedagang Untung"</div>
        <div class="company-address">
           Blok F Trade Center Pasar Kebon Kembang Lt. 3, Jl. Dewi Sartika, Cibogor, Bogor Tengah, Kota Bogor<br>
            Telp: +62251 8330313 | Email: info@pasarpakuanjaya.co.id<br>
            Website: https://pasarpakuanjaya.co.id/
        </div>
        <div class="letterhead-line"></div>
    </div>

    <!-- Konten Dokumen -->
    <div class="header">
        <div class="title">KONTRAK SEWA KIOS</div>
        <div class="document-number">Nomor: {{ sprintf('KSK-%04d/%s/%s', $sewa->id, date('m'), date('Y')) }}</div>
        <div>Tanggal: {{ now()->isoFormat('dddd, D MMMM Y') }}</div>
    </div>

    <div class="parties">
        <div class="party">
            <div class="clause-title">PIHAK PERTAMA (PENYEWA):</div>
            <div>Nama: <strong>{{ strtoupper($pedagang->name) }}</strong></div>
            <div>Email: {{ $pedagang->email }}</div>
            <div>NIK: {{ $sewa->no_ktp ?? '-' }}</div>
        </div>
        
        <div class="party">
            <div class="clause-title">PIHAK KEDUA (PENGELOLA):</div>
            <div>Staff Keuangan</div>
            <div>{{ config('app.company_name', 'Pengelola Pasar') }}</div>
        </div>
    </div>

    <div class="clause">
        <div class="clause-title">PASAL 1 - OBJEK SEWA</div>
        <p>Menyewakan kios dengan spesifikasi sebagai berikut:</p>
        <ul>
            <li>Nama Kios: {{ $kios->nama_kios }}</li>
            <li>Lokasi: {{ $kios->lokasi }}</li>
            <li>Pasar: {{ $kios->pasar->nama_pasar }}</li>
        </ul>
    </div>

    <div class="clause">
        <div class="clause-title">KETENTUAN SEWA</div>
        <ul>
            <li>Masa sewa: {{ $sewa->durasi }} bulan</li>
            <li>Harga sewa: Rp {{ number_format($kios->harga_sewa, 0, ',', '.') }}/bulan</li>
            <li>Total pembayaran: Rp {{ number_format($kios->harga_sewa * $sewa->durasi, 0, ',', '.') }}</li>
        </ul>
    </div>

     <div class="signature-area" style="display: flex; justify-content: space-between; margin-top: 30px;">
        <div class="signature-box" style="text-align: center; flex: 1;">
            <div>PIHAK PERTAMA</div>
            <div class="signature-line"></div>
            <div>({{ strtoupper($pedagang->name) }})</div>
        </div>
        
        <div class="signature-box" style="text-align: center; flex: 1;">
            <div>PIHAK KEDUA</div>
            <div class="signature-line"></div>
            <div>MANAGER UMUM</div>
        </div>
    </div>

    <div style="position: relative; margin-top: 20px;">
       <div style="margin-top: 20px; text-align: center;">
    <img src="{{ public_path('qr.png') }}" style="width: 50px; height: 50px;">
    <div style="font-size: 9pt; margin-top: 5px;">Mengetahui,<br>Ketua PPPJ</div>
</div>
        
        
    </div>
</body>
</html>