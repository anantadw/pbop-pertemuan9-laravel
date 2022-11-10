@extends('adminlte::page')

@section('title', 'Books Menu')

@section('content_header')
    <h1 class="m-0 text-dark">Books Menu</h1>
@stop

@section('plugins.Sweetalert2', true)
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col">
                            <h3 class="d-inline-block mr-3">Data Buku</h3>
                            <a href="{{ route('books.create') }}" class="btn btn-success mr-2">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Buku
                            </a>
                            <a href="{{ route('books.generate-pdf') }}" class="btn btn-info">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Cetak PDF
                            </a>
                            {{-- <button type="button" class="btn btn-primary m-1" id="btnOpenSaltB">Open Sweetalert2 (Basic)</button> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{-- <table class="table table-hover table-bordered table-stripped" id="example2">
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
                                            {{-- <button type="button" class="btn btn-info mb-2 mb-xl-0">
                                                <i class="fas fa-info mr-1"></i>
                                                Detail
                                            </button> --}}
                                            <a href="{{route('books.show', $book)}}" class="btn btn-info mb-2 mb-xl-0">
                                                Detail
                                            </a>
                                            <a href="{{route('books.edit', $book)}}" class="btn btn-warning mb-2 mb-xl-0">
                                                Edit
                                            </a>
                                            <form action="{{route('books.destroy', $book)}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mb-2 mb-xl-0" >Delete</button>
                                            </form>
                          
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table> --}}
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function() {
            $('#btnOpenSaltB').click(function() {
                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                );
            });

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $('#btnOpenSaltC').click(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                });
            });
        })
    </script>
@endpush