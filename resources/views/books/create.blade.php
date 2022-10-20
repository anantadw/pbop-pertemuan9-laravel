@extends('adminlte::page')

@section('title', 'Tambah Buku')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Buku</h1>
@stop

@section('content')
    <form action="{{route('books.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputName">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="exampleInputName" placeholder="Judul buku" name="judul" value="{{old('judul')}}">
                            @error('judul') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail">Pengarang</label>
                            <input type="text" class="form-control @error('pengarang') is-invalid @enderror" id="exampleInputPengarang" placeholder="Masukkan pengarang" name="pengarang" value="{{old('pengarang')}}">
                            @error('pengarang') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">Penerbit</label>
                            <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="exampleInputpenerbit" placeholder="Penerbit" name="penerbit">
                            @error('penerbit') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">Tahun terbit</label>
                            <input type="text" class="form-control" id="exampleInputPassword" placeholder="Tahun terbit" name="tahun_terbit">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">Jumlah</label>
                            <input type="number" class="form-control" id="exampleInputPassword" placeholder="Jumlah buku" name="jumlah_buku">
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('books.index')}}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop
