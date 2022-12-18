<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktur Transaksi Peminjaman</title>
</head>
<body>
    <h1>Bukti Transaksi Peminjaman Buku</h1>
    <h2>Perpustakaan Manja</h2>
    <h3>Nama Peminjam: {{ $transaction->nama_peminjam }}</h3>
    <h3>Tanggal Pinjam: {{ $transaction->tanggal_pinjam }}</h3>
    <h3>Tanggal Kembali: {{ $transaction->tanggal_kembali }}</h3>
    <h3>Buku yang dipinjam:</h3>
    <ul>
        @foreach ($transaction->books as $book)
            <li>{{ $book->judul }}</li>
        @endforeach
    </ul>

    <h2>Mohon untuk mengembalikan buku tepat waktu, jika tidak maka akan dikenakan denda.</h2>
</body>
</html>