@extends('adminlte::page')

@section('title', 'Books Menu')

@section('content_header')
    <h1 class="m-0 text-dark">Books Menu</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col">
                            <h3 class="d-inline-block mr-3">Data Buku</h3>
                            <a href="{{ route('books.create') }}" class="btn btn-success">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Buku
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-hover table-bordered table-stripped" id="example2">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Judul</th>
                                        <th>Pengarang</th>
                                        <th>Tahun Terbit</th>
                                        <th>Jumlah Buku</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($books as $key => $book)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $book->judul }}</td>
                                        <td>{{ $book->pengarang }}</td>
                                        <td>{{ $book->tahun_terbit }}</td>
                                        <td>{{ $book->jumlah_buku }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info mb-2 mb-xl-0">
                                                <i class="fas fa-info mr-1"></i>
                                                Detail
                                            </button>
                                            <button type="button" class="btn btn-warning mb-2 mb-xl-0">
                                                <i class="fas fa-edit mr-1"></i>
                                                Ubah
                                            </button>
                                            <button type="button" class="btn btn-danger">
                                                <i class="fas fa-trash mr-1"></i>
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop