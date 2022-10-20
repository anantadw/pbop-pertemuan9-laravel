@extends('adminlte::page')

@section('title', 'Update Buku')

@section('content_header')
    <h1 class="m-0 text-dark">Update Buku</h1>
@stop

@section('content')
    <form action="{{route('books.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputName">Book ID</label>
                            <input type="text" class="form-control @error('ID') is-invalid @enderror" id="exampleInputName" placeholder="id buku" name="id" value="{{old('id')}}">
                            @error('judul') <span class="text-danger">{{$message}}</span> @enderror
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
