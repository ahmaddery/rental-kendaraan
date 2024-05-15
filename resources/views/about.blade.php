@extends('layouts.master')
@section('content')
    <main class="container">
        <div class="bg-body-tertiary p-5 rounded">
            <h1 class="pt-5">Selamat Datang di {{ config('app.name') }}​</h1>
            <p class="lead">Ini adalah halaman untuk About</p>
            <a class="btn btn-lg btn-primary" href="https://www.gamelab.id/" role="button">Link Gamelab</a>
        </div>
    </main>
@endsection