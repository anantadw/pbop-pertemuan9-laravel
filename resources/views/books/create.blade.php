@extends('adminlte::page')

@section('title', 'Tambah Buku')

@section('content_header')
    <h1 class="m-0 text-dark text-center">Tambah Buku</h1>
@stop

@section('content')
    <form action="{{route('books.store')}}" method="post">
        @csrf
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" placeholder="Masukkan judul buku" name="judul" value="{{old('judul')}}">
                            @error('judul') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="pengarang">Pengarang</label>
                            <input type="text" class="form-control @error('pengarang') is-invalid @enderror" id="pengarang" placeholder="Masukkan pengarang" name="pengarang" value="{{old('pengarang')}}">
                            @error('pengarang') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" placeholder="Masukkan penerbit" name="penerbit">
                            @error('penerbit') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="tahun_terbit">Tahun terbit</label>
                            <input type="text" class="form-control" id="tahun_terbit" placeholder="Masukkan tahun terbit" name="tahun_terbit">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" placeholder="Masukkan jumlah buku" name="jumlah_buku">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus mr-2"></i>
                            Simpan
                        </button>
                        <a href="{{route('books.index')}}" class="btn btn-secondary float-right">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop
