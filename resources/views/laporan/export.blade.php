<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            border-bottom: 2px solid black;
            padding: 8px 5px;
            text-align: left;
        }

        td {
            padding: 8px 5px;
            vertical-align: top;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }

        /* Pengaturan lebar kolom */
        .col-no { width: 30px; }
        .col-nama { width: 120px; }
        .col-alamat { width: auto; }
        .col-tanggal { width: 90px; }
        .col-lama { width: 70px; }
        .col-status { width: 80px; }
        .col-total { width: 110px; }

        .bold { font-weight: bold; }

        /* Garis pemisah horizontal antara data dan footer */
        .border-footer-top {
            border-top: 2px solid black;
        }
    </style>
</head>
<body>

<h2>Laporan Transaksi</h2>

<table>
    <thead>
        <tr>
            <th class="col-no text-center">No</th>
            <th class="col-nama">Nama</th>
            <th class="col-alamat">Alamat</th>
            <th class="col-tanggal text-center">Tanggal</th>
            <th class="col-lama text-center">Lama Sewa</th>
            <th class="col-status text-center">Status</th>
            <th class="col-total text-right">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksi as $item)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $item->Nama }}</td>
            <td>{{ $item->Alamat }}</td>
            <td class="text-center">{{ $item->Tanggal_pesan }}</td>
            <td class="text-center">{{ $item->Lama_sewa }}</td>
            <td class="text-center">{{ $item->Status }}</td>
            <td class="text-right">Rp {{ number_format($item->Total, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
    
    @php
        $grandTotal = $transaksi->sum('Total');
    @endphp

    <tfoot>
        <tr>
            <td colspan="6" class="border-footer-top"></td>
            <td class="border-footer-top text-right bold" style="padding-top: 10px;">Total</td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td class="text-right bold">
                Rp {{ number_format($grandTotal, 0, ',', '.') }}
            </td>
        </tr>
    </tfoot>
</table>

</body>
</html>