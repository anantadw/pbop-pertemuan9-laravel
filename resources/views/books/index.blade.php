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
                    <a href="{{route('books.create')}}" class="btn btn-primary mb-2">
                        Tambah
                    </a>
                    <a href="{{route('books.show', 1)}}" class="btn btn-primary mb-2">
                        Ubah
                    </a>
                    <a href="{{route('books.delete')}}" class="btn btn-primary mb-2">
                        Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop