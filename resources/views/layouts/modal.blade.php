<!-- Modal untuk Keranjang -->
<!-- Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<!-- Modal untuk Keranjang -->
<div class="modal fade" id="keranjangModal" tabindex="-1" role="dialog" aria-labelledby="keranjangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 rounded-lg shadow-lg">
            <div class="modal-header bg-blue-500 text-white relative">
                <h5 class="modal-title font-semibold" id="keranjangModalLabel">Keranjang Belanja</h5>
                <button type="button" class="close text-white absolute right-4 top-4" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-6">
                @if($keranjang)
                    <!-- Isi modal keranjang belanja disini -->
                    <div class="table-responsive">
                        <table class="table-auto w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="p-2 border-b text-left">#</th>
                                    <th class="p-2 border-b text-left">Nama Kendaraan</th>
                                    <th class="p-2 border-b text-left">Jumlah</th>
                                    <th class="p-2 border-b text-left">Harga</th>
                                    <th class="p-2 border-b text-left">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Tampilkan keranjang belanja disini -->
                                @foreach($keranjang as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="p-2 border-b">{{ $loop->iteration }}</td>
                                        <td class="p-2 border-b">{{ $item->kendaraan->nama }}</td>
                                        <td class="p-2 border-b">{{ $item->quantity }} Hari</td>
                                        <td class="p-2 border-b">{{ number_format($item->kendaraan->harga, 2) }}</td>
                                        <td class="p-2 border-b">{{ number_format($item->quantity * $item->kendaraan->harga, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning bg-yellow-100 text-yellow-700 p-4 rounded" role="alert">
                        Silahkan login untuk mengakses keranjang.
                    </div>
                @endif
            </div>
            <div class="modal-footer bg-gray-100 p-4">
                @if($keranjang)
                    <form method="POST" action="{{ route('checkout') }}" class="w-full">
                        @csrf
                        <div class="flex justify-between items-center w-full">
                            <a href="{{ route('product') }}" class="btn btn-secondary bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Lanjut Belanja</a>
                            <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Checkout</button>
                        </div>
                    </form>
                @else
                    <button type="button" class="btn btn-secondary bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" data-dismiss="modal">Tutup</button>
                @endif
            </div>
        </div>
    </div>
</div>



<!--modal untuk contact di bagian footer-->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color: rgba(0, 0, 0, 0.7); box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); color: white;">
        <div class="modal-header" style="background-color: #212529; border-bottom: none;">
          <h5 class="modal-title" id="contactModalLabel">Hubungi Kami</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="contactForm">
            <div class="mb-3">
              <label for="name" class="form-label">Nama <i class="bi bi-person-fill"></i></label>
              <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email <i class="bi bi-envelope-fill"></i></label>
              <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Pesan <i class="bi bi-chat-left-fill"></i></label>
              <textarea class="form-control" id="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-secondary">Kirim Pesan</button>
          </form>
        </div>
      </div>
    </div>
  </div>