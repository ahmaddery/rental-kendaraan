<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembayaran</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

@include('admin.layouts.navbar')

<div class="container-fluid content-wrapper p-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card pl-20">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pembayaran</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive pl-15">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col">#</th>
                                    <th class="col">User</th>
                                    <th class="col">Kendaraan</th>
                                    <th class="col">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->user->name }}</td>
                                        <td>{{ $payment->kendaraan->nama }}</td>
                                        <td>
                                            <a href="{{ route('admin.payments.show', $payment->id) }}"
                                                class="btn btn-sm btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Tampilkan navigasi pagination -->
                <div class="card-footer">
                    <div class="float-left">
                        {{ $payments->links() }}
                    </div>
                    <div class="float-right">
                        <form method="GET" action="{{ route('admin.payments.index') }}">
                            <label for="perPage">Tampilkan per halaman:</label>
                            <select name="perPage" id="perPage" class="form-select" onchange="this.form.submit()">
                                <option value="5" {{ Request::get('perPage') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ Request::get('perPage') == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ Request::get('perPage') == 20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ Request::get('perPage') == 50 ? 'selected' : '' }}>50</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
