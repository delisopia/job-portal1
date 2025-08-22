@extends('layouts.perusahaan')

@section('content')
<div class="container py-4">
    <h1 class="h4 mb-4"><i class="fas fa-file-alt"></i> Laporan Pelamar</h1>

    <div class="card shadow">
        <div class="card-body">
            @if($applications->count())
                <div class="table-responsive">
                    <table id="table-pelamar" class="table table-striped table-bordered table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Nama Pelamar</th>
                                <th>Email</th>
                                <th>Posisi</th>
                                <th>Perusahaan</th>
                                <th>Status Lamaran</th>
                                <th>Tanggal Lamar</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($applications as $index => $application)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $application->user->name }}</td>
                                <td>{{ $application->user->email }}</td>
                                <td>{{ $application->job->posisi }}</td>
                                <td>{{ $application->job->perusahaan }}</td>
                                <td>
                                    <form action="{{ route('perusahaan.lamaran.updateStatus', $application->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                            <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="diterima" {{ $application->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                            <option value="ditolak" {{ $application->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </form>
                                </td>
                                <td>{{ $application->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Belum ada pelamar.</p>
            @endif
        </div>
    </div>
</div>
@endsection
