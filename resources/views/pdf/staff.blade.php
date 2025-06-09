<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembayaran</title>
    <style>
         @page {
            size: landscape;
        }
        .letterhead {
            text-align: center;
            margin-bottom: 15px; /* Reduced from 20px */
        }
        .logo-wrapper {
            flex: 0 0 auto; 
            width: 100px; 
            margin-right: 20px; 
        }
        
        /* Gambar logo */
        .logo-wrapper img {
            width: 100%;
            height: auto;
            display: block;
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
        body { 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
       
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0 0; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; font-size: 12px; text-align: right; }
    </style>
</head>
<body>
     <div class="letterhead">
        <div class="logo-wrapper">
            <img src="{{ public_path('header.png') }}" alt="Logo Perusahaan" style="width: 650px; height: 150px;">
        </div>
        <div class="letterhead-line"></div>
    </div>
    <div class="header">
        <h1>LAPORAN KEUANGAN SEWA KIOS</h1>
        <p>Sistem Manajemen Pasar</p>
        <p>Periode: {{ now()->startOfMonth()->format('d F Y') }} - {{ now()->endOfMonth()->format('d F Y') }}</p>
        <p>Waktu Cetak: {{ now()->format('d F Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                
                <th>Nama Pedagang</th>
                <th>Email</th>
                <th>No Telp</th>
                <th>Pasar</th>
                <th>Kios</th>
                <th>Durasi</th>
                <th>Jumlah</th>
                <th>Status Pembayaran</th>
                <th>Status Sewa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayaran as $key => $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
               
                <td>{{ $item->sewa->pedagang->name }}</td>
                <td>{{ $item->sewa->pedagang->email }}</td>
                <td>{{ $item->sewa->no_telp }}</td>
                <td>{{ $item->sewa->kios->pasar->nama_pasar }}</td>
                <td>{{ $item->sewa->kios->nama_kios }}</td>
                <td>{{ $item->sewa->durasi }} Bulan</td>
                <td class="text-right">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>{{ ucfirst($item->status) }}</td>
                <td>{{ ucfirst($item->sewa->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div style="position: absolute; left: 0; bottom: 0; text-align: center;">
            <img src="{{ public_path('qr.png') }}" style="width: 100px; height: 100px;">
            <div style="font-size: 9pt; margin-top: 5px;">Mengetahui,<br>Ketua PPPJ</div>
        </div>
        <p>Total Pembayaran: Rp {{ number_format($pembayaran->sum('jumlah'), 0, ',', '.') }}</p>
    </div>
</body>
</html>