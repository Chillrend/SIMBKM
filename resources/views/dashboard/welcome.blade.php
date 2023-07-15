@extends('layout.dashboard')
@section('container')
    <h1>Selamat Datang Kembali, {{ auth()->user()->name }}</h1>
@endsection