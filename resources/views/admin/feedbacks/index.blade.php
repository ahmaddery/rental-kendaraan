@include('admin.layouts.navbar')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center pt-5"
    style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
            <h1>Feedback List</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pengguna</th>
                        <th>Kendaraan</th>
                        <th>Komentar</th>
                        <th>Rating</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->id }}</td>
                            <td>{{ $feedback->user->name }}</td>
                            <td>{{ $feedback->kendaraan->nama }}</td>
                            <td>{{ $feedback->komentar }}</td>
                            <td>
                                @php
                                    $stars = '';
                                    for ($i = 0; $i < $feedback->rating; $i++) {
                                        $stars .= '<span style="color: gold;">&#9733;</span>'; // Simbol bintang unicode dengan warna emas
                                    }
                                @endphp
                                {!! $stars !!}
                            </td>
                            <td>
                                <form action="{{ route('admin.feedbacks.destroy', $feedback) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
