
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .modal-content {
            border-radius: 10px;
        }
        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        .modal-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }
        .payment-detail {
            border-bottom: 1px solid #dee2e6;
            padding: 10px 0;
        }
        .payment-detail:last-child {
            border-bottom: none;
        }
        .icon {
            margin-right: 10px;
            color: #007bff;
        }
    </style>
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
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#paymentDetailModal{{ $payment->id }}">Detail</button>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="paymentDetailModal{{ $payment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Pembayaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <div class="row payment-detail">
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-person-fill icon"></i><strong>User:</strong></h6>
                                                                <p>{{ $payment->user->name }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-truck icon"></i><strong>Kendaraan:</strong></h6>
                                                                <p>{{ $payment->kendaraan->nama }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row payment-detail">
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-receipt icon"></i><strong>Order ID:</strong></h6>
                                                                <p>{{ $payment->order_id }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-calendar-date icon"></i><strong>Tanggal Pembelian:</strong></h6>
                                                                <p>{{ $payment->purchase_date }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row payment-detail">
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-clock icon"></i><strong>Waktu Transaksi:</strong></h6>
                                                                <p>{{ $payment->transaction_time }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-info-circle icon"></i><strong>Status Transaksi:</strong></h6>
                                                                <p>{{ $payment->transaction_status }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row payment-detail">
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-arrow-left-right icon"></i><strong>ID Transaksi:</strong></h6>
                                                                <p>{{ $payment->transaction_id }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-chat-left-text icon"></i><strong>Pesan Status:</strong></h6>
                                                                <p>{{ $payment->status_message }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row payment-detail">
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-check-circle icon"></i><strong>Code Status:</strong></h6>
                                                                <p>{{ $payment->status_code }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-hourglass-split icon"></i><strong>Jam Pembayaran:</strong></h6>
                                                                <p>{{ $payment->settlement_time }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row payment-detail">
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-credit-card icon"></i><strong>Tipe Transaksi:</strong></h6>
                                                                <p>{{ $payment->payment_type }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-currency-exchange icon"></i><strong>Jumlah Pembayaran:</strong></h6>
                                                                <p>Rp {{ number_format($payment->gross_amount, 2, ',', '.') }}</p>
                                                            </div>                                                            
                                                        </div>
                                                        <div class="row payment-detail">
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-shield-fill-exclamation icon"></i><strong>Fraud Status:</strong></h6>
                                                                <p>{{ $payment->fraud_status }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-cash-coin icon"></i><strong>Mata Uang:</strong></h6>
                                                                <p>{{ $payment->currency }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row payment-detail">
                                                            <div class="col-md-6">
                                                                <h6><i class="bi bi-shop icon"></i><strong>ID Merchant:</strong></h6>
                                                                <p>{{ $payment->merchant_id }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

