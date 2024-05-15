@extends('layouts.master')
@section('content')
            {{-- ini adalah komentar pada blade --}}
    <main class="container">
        <div class="bg-body-tertiary p-5 rounded">
            <h1 class="pt-5">{{config('app.name', 'SMK Gamelab Indonesia')}}​</h1>
            <p class="lead">Ini adalah halaman untuk profil {{ $user = "Admin" }}</p>
            <a class="btn btn-lg btn-primary" href="https://www.gamelab.id/" role="button">Link Gamelab</a>
        </div>
    </main>
    @endsection