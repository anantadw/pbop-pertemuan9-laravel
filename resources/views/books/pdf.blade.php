@extends('adminlte::page')

@section('content')
    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Tahun Terbit</th>
                <th>Jumlah Buku</th>
            </tr>
        </thead>
        <tbody>
        @foreach($books as $key => $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->judul }}</td>
                <td>{{ $book->pengarang }}</td>
                <td>{{ $book->tahun_terbit }}</td>
                <td>{{ $book->jumlah_buku }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop