@extends('admin.layouts.navbar')

@section('content')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center pt-5" style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
            <h1 class="mb-4">Data Pengambilan dan Pengembalian</h1>

            <!-- Dropdown for items per page -->
            <div class="mb-3">
                <form action="{{ url()->current() }}" method="GET" id="itemsPerPageForm">
                    <label for="per_page">Items per page:</label>
                    <select name="per_page" id="per_page" class="form-select w-auto" onchange="document.getElementById('itemsPerPageForm').submit()">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
            </div>

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

            <!-- Pagination links -->
            <div class="d-flex justify-content-center">
                {{ $data->appends(['per_page' => $perPage])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
