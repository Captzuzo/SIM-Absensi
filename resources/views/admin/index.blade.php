@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard Admin</h1>
@endsection

@section('content')
<p>Selamat datang, {{ Auth::user()->name }} ({{ Auth::user()->role->name }})</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="btn btn-danger">Logout</button>
</form>
@endsection