@extends('layouts.perusahaan')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Data Pelamar</h2>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-pelamar" class="table table-striped table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Posisi</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>CV</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    @forelse ($applications as $index => $app)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                            <td>{{ $app->posisi ?? '-' }}</td>
                            <td>{{ $app->nama }}</td>
                            <td>{{ $app->email }}</td>
                            <td>{{ $app->telepon }}</td>
                            <td>{{ $app->alamat }}</td>
                            <td>
                                @if ($app->cv_path)
                                <a href="{{ route('perusahaan.applications.download.cv', $app->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                    Lihat CV
                                </a>
                                @else
                                <span class="text-muted">Belum upload</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada pelamar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection