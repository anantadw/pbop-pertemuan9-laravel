@extends('adminlte::page')

@section('title', 'Transactions Menu')

@section('content_header')
    <h1 class="m-0 text-dark">Transactions Menu</h1>
@stop

@section('plugins.Sweetalert2', true)
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col">
                            <h3 class="d-inline-block mr-3">Data Transaksi</h3>
                            <a href="{{ route('transactions.create') }}" class="btn btn-success mr-2">
                                <i class="fas fa-plus mr-2"></i>
                                Buat Transaksi Peminjaman
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
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
@endpush