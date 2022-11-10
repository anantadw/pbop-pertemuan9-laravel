@extends('adminlte::page')

@section('title', 'Detail Buku')

@section('content_header')
    <h1 class="m-0 text-dark text-center">Detail Buku</h1>
@stop

@section('content')
    <form action="" method="post">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" value="{{$book->judul}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="pengarang">Pengarang</label>
                            <input type="text" class="form-control" id="pengarang"
                            value="{{$book->pengarang}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit"
                            value="{{$book->penerbit}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="tahun_terbit">Tahun terbit</label>
                            <input type="number" min="1900" max="{{ date('Y') }}" class="form-control" id="tahun_terbit"
                            value="{{$book->tahun_terbit}}"disabled>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_buku">Jumlah Buku</label>
                            <input type="number" min="0" max="99" class="form-control" id="jumlah_buku"
                            value="{{$book->jumlah_buku}}"disabled>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5" disabled>{{$book->deskripsi}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="created_at">Ditambahkan pada</label>
                            <input type="text" class="form-control" id="created_at"
                            value="{{$book->created_at}}" disabled>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('books.index')}}" class="btn btn-secondary float-right">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop
