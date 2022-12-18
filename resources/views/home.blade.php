@extends('adminlte::page')

@section('title', 'Admin APM')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Selamat datang, {{ Auth::user()->name }}!</p>
                </div>
            </div>
        </div>
    </div>
@stop
