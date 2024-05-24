
@include('layouts.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kendaraan</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        .card {
            border: none;
            transition: transform 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .card-img-top {
            transition: transform 0.3s;
        }
        .card-img-top:hover {
            transform: scale(1.05);
        }
        .btn {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .text-muted {
            color: #6c757d;
        }
        .modal-content {
            background-color: #f8f9fa;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-5">Detail Kendaraan</h1>
        <div class="card">
            <img src="{{ asset($kendaraan->image) }}" class="card-img-top" alt="{{ $kendaraan->nama }}">
            <div class="card-body">
                <h5 class="card-title">{{ $kendaraan->nama }}</h5>
                <p class="card-text">Tipe: {{ $kendaraan->type->typekendaraan }}</p>
                <p class="card-text">Brand: {{ $kendaraan->brand->kendaraan }}</p>
                <p class="card-text">Kategori: {{ $kendaraan->category->kendaraan }}</p>
                <p class="card-text">Tahun: {{ $kendaraan->tahun }}</p>
                <p class="card-text">Warna: {{ $kendaraan->warna }}</p>
                <p class="card-text">Stok: {{ $kendaraan->stok }}</p>
                <p class="card-text">Harga: {{ number_format($kendaraan->harga, 0, ',', '.') }} IDR</p>
                <p class="card-text">Deskripsi: {!! $kendaraan->deskripsi !!}</p>
                <p class="card-text">Plat Nomor: {{ $kendaraan->plat_nomor }}</p>
                <a href="{{ route('index') }}" class="btn btn-primary">Kembali</a>

                <!-- Formulir Rating -->
                @if($payment && $payment->transaction_status === 'settlement' && !$userHasRated)
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ratingModal">Berikan Rating</button>
                @endif
            </div>
        </div>
        <!-- Bagian Rating dan Komentar -->
        <div class="mt-5">
            <h2 class="text-center mb-4">Rating dan Komentar</h2>
            @if($ratings->isEmpty())
                <p class="text-center">Belum ada rating dan komentar.</p>
            @else
                @foreach($ratings as $rating)
                    <div class="card mb-3">
                        @if($rating->user_id == Auth::id())
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editRatingModal" data-rating="{{ $rating->rating }}" data-komentar="{{ $rating->komentar }}" data-url="{{ route('rating.update', ['id' => $rating->kendaraan_id]) }}">
                                Edit
                            </button>
                        @endif
                        <!-- Display Rating -->
                        <div class="rating-display" style="position: absolute; top: 10px; right: 10px; margin: 0;">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rating->rating)
                                    <i class="fas fa-star"></i> <!-- Filled star -->
                                @else
                                    <i class="far fa-star"></i> <!-- Empty star -->
                                @endif
                            @endfor
                        </div>
                        <!-- Display Edit Count -->
                        <p style="position: absolute; bottom: 0; right: 0; margin: 0 10px 10px 0;">
                            Total Komentar di edit: {{ Cache::get('total_edited_count_' . $rating->kendaraan_id, 0) }}
                        </p>
                        <div class="card-body">
                            <h5 class="card-title">Rating:
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating->rating)
                                        <i class="fas fa-star"></i> <!-- Filled star -->
                                    @else
                                        <i class="far fa-star"></i> <!-- Empty star -->
                                    @endif
                                @endfor
                            </h5>
                            <p class="card-text">{{ $rating->komentar }}</p>
                            <p class="card-text"><small class="text-muted">Oleh: {{ $rating->user->name }} pada {{ $rating->created_at->format('d M Y') }}</small></p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Rating Modal -->
    <div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">Berikan Rating</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('rating.store', ['id' => $kendaraan->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
                        </div>
                        <div class="form-group">
                            <label for="komentar">Komentar</label>
                            <textarea name="komentar" id="komentar" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Rating Modal -->
    <div class="modal fade" id="editRatingModal" tabindex="-1" role="dialog" aria-labelledby="editRatingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRatingModalLabel">Edit Rating</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editRatingForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                        </div>
                        <div class="form-group">
                            <label for="komentar">Komentar</label>
                            <textarea class="form-control" id="komentar" name="komentar" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#editRatingModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var rating = button.data('rating');
            var komentar = button.data('komentar');
            var url = button.data('url');

            var modal = $(this);
            modal.find('.modal-body #rating').val(rating);
            modal.find('.modal-body #komentar').val(komentar);
            modal.find('#editRatingForm').attr('action', url);
        });
    </script>
</body>
</html>
