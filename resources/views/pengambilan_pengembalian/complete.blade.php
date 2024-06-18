@extends('layouts.navbar')


<div class="container mt-5">
    <h1 class="mb-4 text-center text-primary">Lengkapi Data Pengambilan Pengembalian</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengambilan_pengembalian.storeComplete') }}" method="POST" class="shadow p-4 rounded bg-light">
        @csrf
        <input type="hidden" name="order_id" value="{{ $payment->order_id }}">
        <input type="hidden" name="user_id" value="{{ $payment->user_id }}">

        <div class="form-group mb-3">
            <label for="kendaraan_id" class="form-label">Kendaraan ID</label>
            <input type="text" class="form-control" id="kendaraan_id" name="kendaraan_id" value="{{ $payment->kendaraan_id }}" readonly>
        </div>

        <div class="form-group mb-3">
            <label for="nama_kendaraan" class="form-label">Nama Kendaraan</label>
            <input type="text" class="form-control" id="nama_kendaraan" value="{{ $kendaraan->nama }}" readonly>
        </div>

        <div class="form-group mb-3">
            <label for="tanggal_pengambilan" class="form-label">Tanggal Pengambilan</label>
            <input type="date" class="form-control" id="tanggal_pengambilan" name="tanggal_pengambilan" required min="{{ date('Y-m-d') }}">
        </div>

        <div class="form-group mb-3">
            <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
            <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" value="{{ $tanggalPengembalian ?? '' }}" readonly required>
        </div>

        <div class="form-group mb-4">
            <label for="result" class="form-label">Durasi penyewaan</label>
            <p id="hasil_hitung" class="form-control-plaintext">{{ $days ?? '' }} hari</p>
        </div>

        <button type="submit" class="btn btn-primary w-100">Simpan</button>
    </form>
</div>

<script>
    document.getElementById('tanggal_pengambilan').addEventListener('change', function() {
        var selectedDate = new Date(this.value);
        var days = {{ $days ?? 0 }};
        var newDate = new Date(selectedDate.getTime() + days * 24 * 60 * 60 * 1000);
        var newDateString = newDate.toISOString().split('T')[0];
        document.getElementById('tanggal_pengembalian').value = newDateString;
    });
</script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>