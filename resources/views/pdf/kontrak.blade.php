<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>KONTRAK SEWA KIOS</title>
    <style>
        @page { margin: 2cm }
        body { 
            font-family: 'Times New Roman', Times, serif; 
            font-size: 12pt; 
            line-height: 1.5;
            background: url('{{ public_path("images/watermark.png") }}') repeat;
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px;
            position: relative;
        }
        .title { 
            font-size: 14pt; 
            font-weight: bold; 
            text-decoration: underline;
            text-transform: uppercase;
        }
        .document-number {
            color: #333;
            font-weight: bold;
            margin: 10px 0;
        }
        .parties { 
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .clause { 
            margin: 15px 0;
            text-align: justify;
        }
        .clause-title { 
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
        }
        .signature-area { 
            display: flex; 
            justify-content: space-between; 
            margin-top: 50px; 
            page-break-inside: avoid;
        }
        .signature-box { 
            width: 45%; 
            text-align: center;
        }
        .signature-line { 
            border-top: 1px solid #000; 
            width: 80%; 
            margin: 50px auto 0 auto;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 9pt;
            color: #666;
        }
        .page-number:after {
            content: counter(page);
        }
    </style>
</head>
<body>
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

    <div class="signature-area">
        <div class="signature-box">
            <div>PIHAK PERTAMA</div>
            <div class="signature-line"></div>
            <div>({{ strtoupper($pedagang->name) }})</div>
        </div>
        
        <div class="signature-box">
            <div>PIHAK KEDUA</div>
            <div class="signature-line"></div>
            <div>({{ strtoupper(auth()->user()->name) }})</div>
        </div>
    </div>

    <div class="footer">
        <p>Halaman <span class="page-number"></span> - Dokumen ini diterbitkan secara digital pada {{ now()->format('d/m/Y H:i:s') }}</p>
        <p>{{ config('app.name') }} - {{ config('app.url') }}</p>
    </div>
</body>
</html>
