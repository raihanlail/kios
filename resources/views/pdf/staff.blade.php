<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembayaran</title>
    <style>
         @page {
            size: landscape;
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
    <div class="header">
        <h1>Laporan Keuangan</h1>
        <p>Dicetak pada: {{ now()->format('d F Y H:i:s') }}</p>
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
        <p>Total Pembayaran: Rp {{ number_format($pembayaran->sum('jumlah'), 0, ',', '.') }}</p>
    </div>
</body>
</html>