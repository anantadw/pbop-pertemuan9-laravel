@extends('adminlte::page')

@section('title', 'Tambah Buku')

@section('content_header')
    <h1 class="m-0 text-dark text-center">Tambah Buku</h1>
@stop

@section('content')
    <form action="{{ route('books.store') }}" method="post" enctype="multi-part/form-data" enctype="multipart/form-data">
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
                            <input type="number" min="1900" max="{{ date('Y') }}" class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit" placeholder="Masukkan tahun terbit (YYYY)" name="tahun_terbit">
                            @error('tahun_terbit') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah_buku">Jumlah Buku</label>
                            <input type="number" min="0" max="99" class="form-control @error('jumlah_buku') is-invalid @enderror" id="jumlah_buku" placeholder="Masukkan jumlah buku buku" name="jumlah_buku">
                            @error('jumlah_buku') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" cols="30" rows="5" placeholder="Deskripsi buku"></textarea>
                            @error('deskripsi') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="gambar">Upload Gambar</label>
                            <input type="file" class="form-control h-5" name='gambar' id="gambar">
                            @error('gambar')<spam class="text-danger">{{$message}}</spam>@enderror
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
