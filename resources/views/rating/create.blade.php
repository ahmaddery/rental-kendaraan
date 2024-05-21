
<div class="container">
    <h1>Berikan Rating untuk {{ $kendaraan->nama }}</h1>
    <form action="{{ route('rating.store', ['id' => $kendaraan->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="rating">Rating</label>
            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
        </div>
        <div class="form-group">
            <label for="komentar">Komentar</label>
            <textarea name="komentar" id="komentar" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>

