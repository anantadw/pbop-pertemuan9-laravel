@extends('adminlte::page')

@section('title', 'Transaksi')

@section('content_header')
    <h1 class="m-0 text-dark text-center">Buat Transaksi Peminjaman</h1>
@stop

@section('content')
    <form action="{{ route('transactions.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="peminjam">ID Peminjam</label>
                            <input type="text" class="form-control @error('peminjam') is-invalid @enderror" id="peminjam" placeholder="Masukkan ID peminjam" name="peminjam" value="{{old('peminjam')}}">
                            @error('peminjam') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <p class="font-weight-bold d-inline-block mr-2">Buku</p>
                        <button class="btn btn-secondary" type="button" id="add-book-input">
                            <i class="fa fa-plus"></i>
                        </button>
                        <div class="form-group mt-3" id="book-input"></div>
                        <div class="form-group">
                            <label for="peminjam">Tanggal Pinjam</label>
                            <input type="date" class="form-control @error('tgl_pinjam') is-invalid @enderror" id="tgl_pinjam" placeholder="Masukkan tanggal pinjam" name="tgl_pinjam" value="{{ date('Y-m-d') }}">
                            @error('tgl_pinjam') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus mr-2"></i>
                            Simpan
                        </button>
                        <a href="{{route('transactions.index')}}" class="btn btn-secondary float-right">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@push('js')
    <script>
        let number = 1;

        $(document).ready(function() {
            $('#add-book-input').click(function() {
                $('#book-input').append(`<div class='row mb-3' id='input${number}'>
                                <div class='col-6'>
                                    <input type='text' class='form-control @error('buku[]') is-invalid @enderror' id='buku${number}' placeholder='ID Buku' name='buku[]' value='{{old('buku[]')}}'>
                                    @error('buku[]') <span class='text-danger'>{{$message}}</span> @enderror
                                </div>
                                <div class='col-2'>
                                    <button type='button' class='btn btn-danger d-block w-100 delete-book' id='delete${number}'>Hapus</button>
                                </div>
                            </div>`);
                number += 1;
                (number === 4) ?  $('#add-book-input').hide() :  $('#add-book-input').show();
            });
        });

        $(document).on('click', '.delete-book', function() {
            const inputId = $(this).parent().parent().attr('id');
            $('#' + inputId).remove();
            number -= 1;
            (number === 4) ?  $('#add-book-input').hide() :  $('#add-book-input').show();
        });
    </script>
@endpush