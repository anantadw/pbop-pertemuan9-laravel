@extends('adminlte::page')

@section('title', 'Transaksi')

@section('content_header')
    <h1 class="m-0 text-dark text-center">Detail Transaksi</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="peminjam">Nama Peminjam</label>
                        <input type="text" class="form-control" id="peminjam" name="peminjam" readonly value="{{ $transaction->borrower->nama_peminjam }}">
                    </div>
                    <div class="form-group">
                        <label>Buku yang dipinjam</label>
                        @foreach ($transaction->books as $book)
                            <input type='text' class='form-control mb-2' id='buku{{ $loop->index }} name='buku[]' readonly value='{{ $book->id . ' | ' . $book->judul }}'>
                        @endforeach
                    </div>
                    <div class="form-group mt-3" id="book-input"></div>
                    <div class="form-group">
                        <label for="tgl_pinjam">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" readonly value="{{ $transaction->tanggal_pinjam }}">
                    </div>
                    <div class="form-group">
                        <label for="tgl_kembali">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" readonly  value="{{ $transaction->tanggal_kembali }}">
                    </div>
                    <div class="form-group">
                        <label for="tgl_kembali">Status</label>
                        <input type="text" class="form-control" id="status" name="status" readonly  value="{{ ($transaction->status == true) ? 'Dikembalikan' : 'Dalam peminjaman' }}">
                    </div>
                    <div class="form-group">
                        <label for="denda">Denda</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control" readonly id="denda">
                            <div class="invalid-feedback" id="error-denda"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('transactions.index')}}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        $('#error-denda').hide()
        let tanggal_pinjam = new Date($('#tgl_pinjam').val())
        let tanggal_kembali = new Date((new Date($('#tgl_pinjam').val())).setDate((new Date($('#tgl_pinjam').val())).getDate() + 7))
        let lama_pinjam = (new Date().getTime() - tanggal_pinjam.getTime()) / (1000 * 3600 * 24)
        
        let value = 0
        if (lama_pinjam > 7) {
            value = Math.floor(lama_pinjam) * 5000
            $('#error-denda').show()
            $('#error-denda').html('Terlambat ' + Math.floor(lama_pinjam) + ' hari')
        }
        $('#denda').val(value)
    </script>
@endpush