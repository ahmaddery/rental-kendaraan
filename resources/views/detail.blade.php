@extends('layouts.navbar')

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <style>
        /* Detail Kendaraan */
        .detail {
            margin-top: 6rem;
        }

        .detail img {
            height: 400px;
            width: 550px;
            object-fit: cover;
        }

        .detail .nav button {
            padding-right: 3rem;
        }

        .detail .category {
            font-size: 1rem;
            color: var(--blue);
            text-transform: uppercase;
            font-weight: bold;
        }

        .detail .name {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .detail .card-price {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .detail .detail-desc {
            max-height: 200px; /* Set the maximum height */
            overflow-y: auto;  /* Enable vertical scrolling */
        }

        @media (max-width: 992px) {
            .detail .detail-right-info {
                margin-top: 1rem;
            }
        }

        /* Rating Section */
        .rating-box {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .rating-box .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .rating-box .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ccc;
            margin-right: 10px;
        }

        .rating-box .rating i {
            color: #ffcc00;
        }

        .rating-box .comment p {
            margin: 0;
        }

        .count-edit-rating {
            margin-top: 10px;
            font-style: italic;
        }

        body {
            padding-top: 70px; /* Adjust based on your navbar height */
        }
    </style>
</head>
<body>
    <div class="container mt-5 pt-5">
        <div class="detail section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <img class="img-fluid" src="{{ asset($kendaraan->image) }}" alt="foto {{ $kendaraan->nama }}">
                    </div>
                    <div class="col-xl-6 detail-right-info">
                        <div class="detail-top">
                            <div class="category"><h1>{{ $kendaraan->nama }}</h1></div>
                            <div class="name text-md"><p>Tahun Kendaraan : {{ $kendaraan->tahun }}</p></div>
                            <div class="card-price mb-2">
                                <ul>
                                    <li class="idr">IDR : {{ number_format($kendaraan->harga, 2, ',', '.') }}</li>
                                </ul>
                            </div>
                        </div>
                        <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home-tab-pane" role="tab" aria-controls="home-tab-pane" aria-selected="true">01. Detail</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-tab-pane" role="tab" aria-controls="profile-tab-pane" aria-selected="false">02. Deskripsi</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <div class="detail-info">
                                    <div class="row">
                                        <div class="col-6">
                                            <p>Tipe</p>
                                            <p>Brand</p>
                                            <p>Tahun</p>
                                            <p>Warna</p>
                                            <p>Plat nomor</p>
                                        </div>
                                        <div class="col-6">
                                            <p>: {{ $kendaraan->type->typekendaraan }}</p>
                                            <p>: {{ $kendaraan->brand->kendaraan }}</p>
                                            <p>: {{ $kendaraan->tahun }}</p>
                                            <p>: {{ $kendaraan->warna }}</p>
                                            <p>: {{ $kendaraan->plat_nomor }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                <p class="detail-desc">
                                    {!! $kendaraan->deskripsi !!}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="btn-card mt-3">
                            @if($payment && $payment->transaction_status === 'settlement' && !$userHasRated)
                                <button type="button" class="btn btn-success btn-1 rounded-4" data-toggle="modal" data-target="#ratingModal">Berikan Rating</button>
                            @endif
                            <a href="{{ route('tambah.keranjang', $kendaraan->id) }}" class="btn"><i class="bi bi-cart2"></i></a>
                        </div>
                    </div>
                </div>
            </div>  
        </div>

        <!-- Bagian Rating dan Komentar -->
        <div class="card mt-5 rounded-5">
            <h1 class="p-3">Rating dan Komentar</h1>
            @if($ratings->isEmpty())
                <p class="text-center text-primary">Belum ada rating dan komentar.</p>
            @else
                @foreach ($ratings as $rating)
                    @if($rating->user_id == Auth::id())
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-primary btn-2 rounded-5" data-toggle="modal" data-target="#editRatingModal" data-rating="{{ $rating->rating }}" data-komentar="{{ $rating->komentar }}" data-url="{{ route('rating.update', ['id' => $rating->kendaraan_id]) }}">
                            Edit
                        </button>
                    @endif
                    <div class="rating-box">
                        <div class="user-info">
                            <div class="user-avatar"></div>
                            <div>
                                <div class="user-name">
                                    <p class="card-text">{{ $rating->user->name }}</p>
                                </div>
                                <div class="car">
                                    <p>{{ $rating->kendaraan->nama }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="rating text-warning">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rating->rating)
                                    <i class="fas fa-star"></i> <!-- Filled star -->
                                @else
                                    <i class="far fa-star"></i> <!-- Empty star -->
                                @endif
                            @endfor
                        </div>
                        <div class="comment">
                            <p class="card-text">"{{ $rating->komentar }}"</p>
                            <p class="card-text"><small class="text-muted">Oleh: {{ $rating->user->name }} pada {{ $rating->created_at->format('d M Y') }}</small></p>
                        </div>
                        <div class="count-edit-rating">
                            <!-- Display Edit Count -->
                            <p>
                                Total Komentar di edit: {{ Cache::get('total_edited_count_' . $rating->kendaraan_id, 0) }}
                            </p>
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
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit-rating">Rating</label>
                            <input type="number" name="rating" id="edit-rating" class="form-control" min="1" max="5" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-komentar">Komentar</label>
                            <textarea name="komentar" id="edit-komentar" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#editRatingModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var rating = button.data('rating');
                var komentar = button.data('komentar');
                var url = button.data('url');
                
                var modal = $(this);
                modal.find('#edit-rating').val(rating);
                modal.find('#edit-komentar').val(komentar);
                modal.find('#editRatingForm').attr('action', url);
            });
        });
    </script>
</body>
</html>
