@extends('admin.layouts.navbar')

@section('content')
    <div class="container-fluid content-wrapper d-flex justify-content-center align-items-center pt-5"
        style="min-height: 60vh;">
        <div class="row w-100 justify-content-center">
            <div class="col-lg-7">
                <h1 class="mb-4">Data Pengambilan dan Pengembalian</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Kendaraan</th>
                                <th>Order ID</th>
                                <th>Tanggal Pengambilan</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->kendaraan->nama }}</td>
                                    <td>{{ $item->order_id }}</td>
                                    <td>{{ $item->tanggal_pengambilan }}</td>
                                    <td>{{ $item->tanggal_pengembalian }}</td>
                                    <td>
                                        @php
                                            $today = now();
                                            $tanggalPengambilan = \Carbon\Carbon::parse($item->tanggal_pengambilan);
                                            $tanggalPengembalian = \Carbon\Carbon::parse($item->tanggal_pengembalian);

                                            if ($today->greaterThan($tanggalPengembalian)) {
                                                echo 'Selesai';
                                            } elseif ($today->between($tanggalPengambilan, $tanggalPengembalian)) {
                                                echo 'On Process';
                                            } else {
                                                echo 'Belum Diambil';
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
