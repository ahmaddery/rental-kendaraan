<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating Kendaraan</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Rating Kendaraan</h1>
        <form action="{{ route('rating.store', ['id' => $kendaraan->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="rating">Rating:</label>
                <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
            </div>
            <div class="form-group">
                <label for="comment">Komentar:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <hr>
        <h2>Riwayat Rating</h2>
        @if($ratings->isEmpty())
            <p>Belum ada rating untuk kendaraan ini.</p>
        @else
            <ul class="list-group">
                @foreach($ratings as $rating)
                    <li class="list-group-item">
                        <p>Rating: {{ $rating->rating }}</p>
                        <p>Komentar: {{ $rating->comment }}</p>
                        <small>Dibuat pada: {{ $rating->created_at }}</small>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Script Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
