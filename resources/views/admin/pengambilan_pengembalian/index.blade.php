@extends('admin.layouts.navbar')

@section('content')
    <div class="container-fluid content-wrapper pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->kendaraan->nama }}</td>
                                    <td>{{ $item->order_id }}</td>
                                    <td>{{ $item->tanggal_pengambilan }}</td>
                                    <td>{{ $item->tanggal_pengembalian }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
