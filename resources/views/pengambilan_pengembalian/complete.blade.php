@extends('layouts.navbar')

<div class="container p-5">
    <h1 class="mb-4 mt-5">Lengkapi Data Pengambilan Pengembalian</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengambilan_pengembalian.storeComplete') }}" method="POST">
        @csrf
        <input type="hidden" name="order_id" value="{{ $payment->order_id }}">
        <input type="hidden" name="user_id" value="{{ $payment->user_id }}">

        <div class="form-group">
            <label for="kendaraan_id">Kendaraan ID</label>
            <input type="text" class="form-control" id="kendaraan_id" name="kendaraan_id" value="{{ $payment->kendaraan_id }}" readonly>
        </div>

        <div class="form-group">
            <label for="nama_kendaraan">Nama Kendaraan</label>
            <input type="text" class="form-control" id="nama_kendaraan" value="{{ $kendaraan->nama }}" readonly>
        </div>

        <div class="form-group">
            <label for="tanggal_pengambilan">Tanggal Pengambilan</label>
            <input type="date" class="form-control" id="tanggal_pengambilan" name="tanggal_pengambilan" required min="{{ date('Y-m-d') }}">
        </div>

        <div class="form-group">
            <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
            <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" value="{{ $tanggalPengembalian }}" required>
        </div>

        <!-- Display the calculated result below the tanggal_pengembalian input -->
        <div class="form-group">
            <label for="result">Hasil Hitung</label>
            <p id="hasil_hitung">{{ $days }} hari</p>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    document.getElementById('tanggal_pengambilan').addEventListener('change', function() {
        var selectedDate = new Date(this.value);
        var days = {{ $days }};
        var newDate = new Date(selectedDate.getTime() + days * 24 * 60 * 60 * 1000);
        var newDateString = newDate.toISOString().split('T')[0];
        document.getElementById('tanggal_pengembalian').value = newDateString;
    });
</script>
