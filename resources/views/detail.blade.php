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
    <!-- Custom CSS -->
    <style>
        .card {
            border: none;
            transition: transform 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .btn-1 {
            margin: 20px;
        }
        .btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .modal-content {
            background-color: #f8f9fa;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        img {
            padding: 15px;
            width: 100%;
            height: 85%;
            border-radius: 35px;
        }
        .harga {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .deskripsi {
            padding: 10px;
        }
        .detail {
            display: flex;
            align-items: center;
            border-bottom: 3px solid #ccc;
        }
        .detail-number {
            width: 50px;
            font-weight: bold;
            margin-right: 10px;
            padding: 10px;
        }
        .detail-content {
            flex-grow: 1;
            padding: 5px;
        }
        .keterangan {
            display: flex;
            justify-content: space-between;
        }
        .keterangan div {
            width: 50%;
        }
        .garis{
            border-top:3px solid black;
            margin-left: 30px;
            margin-right: 30px;
        }
        .btn-2{
            margin-left: 25px;
            margin-right: 25px;
        }
        .rating-box{
            background-color: #d6e7f8;
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin:25px;
        }
        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #90caf9;
            margin-right: 15px;
        }
        .user-name {
            font-weight: bold;
        }
        .car{
            font-size: 12px;
            color: #666;
        }
        .rating {
            display: flex;
            align-items: center;
            margin-left:65px;
        }
        .comment {
            margin-top: 10px;
        }
        .count-edit-rating{
            padding-right: 40px;
            position: absolute;
            bottom: 0;
            right: 0;
            margin: 0 10px 10px 0;
        }
    </style>
</head>
<body>
    <div class="container pt-5">
        <div class="card mt-5 rounded-5">
            <div class="row justify-content-between">
                <div class="col-lg-7">
                    <img src="{{ asset($kendaraan->image) }}" class="" alt="{{ $kendaraan->nama }}">
                </div>
                <div class="col-lg-5">
                    <div class="deskripsi">
                        <h3 class="text-primary">MOBIL</h3>
                        <h3 class="card-title"><b>{{ $kendaraan->nama }}</b></h3>
                        <div class="harga mt-4">
                            <h4><b>IDR</b></h4>
                            <h4 class="ml-auto">{{ number_format($kendaraan->harga, 0, ',', '.') }}</h4>
                        </div>
                        <hr style="border-top:3px solid black">
                        <div class="detail">
                            <div class="detail-number">
                                <h5>01.</h5>
                            </div>
                            <div class="detail-content">
                                <h4>DETAIL</h4>
                                <div class="keterangan">
                                    <div><b>Brand</b></div>
                                    <div>{{ $kendaraan->brand->kendaraan }}</div>
                                </div>
                                <div class="keterangan">
                                    <div><b>Warna</b></div>
                                    <div>{{ $kendaraan->warna }}</div>
                                </div>
                                <div class="keterangan">
                                    <div><b>Tahun</b></div>
                                    <div>{{ $kendaraan->tahun }}</div>
                                </div>
                                <div class="keterangan">
                                    <div><b>Plat Nomor</b></div>
                                    <div>{{ $kendaraan->plat_nomor }}</div>
                                </div>
                            </div>
                        </div>              
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <hr class="garis">
                </div>
            </div>
            <div class="row">
                <div class="detail">
                    <div class="detail-number">
                        <h5>02.</h5>
                    </div>
                    <div class="detail-content">
                        <h5><b>DESKRIPSI</b></h5>
                        <p>{!! $kendaraan->deskripsi !!}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <hr class="garis">
                </div>
            </div>
            <div class="row p-5">
                   <!-- Formulir Rating -->
                @if($payment && $payment->transaction_status === 'settlement' && !$userHasRated)
                <button type="button" class="btn btn-success btn-1 rounded-4" data-toggle="modal" data-target="#ratingModal">Berikan Rating</button>
                @endif
            </div>
        </div>
        
        <!-- Bagian Rating dan Komentar -->
        <div class="card mt-5 rounded-5">
            <h1 class="p-3">Rating dan Komentar</h1>
            @if($ratings->isEmpty())
                <p class="text-center text-primary">Belum ada rating dan komentar.</p>
            @else
                @foreach ($ratings as $rating )
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
