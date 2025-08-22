@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Lowongan</h2>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            <h4>{{ $job->posisi }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Deskripsi:</strong><br> {{ $job->deskripsi }}</p>
            <p><strong>Lokasi:</strong> {{ $job->lokasi }}</p>
            <p><strong>Gaji:</strong> {{ $job->gaji }}</p>
            <p><strong>Perusahaan:</strong> {{ $job->user->name ?? '-' }}</p>
            <p><strong>Dibuat pada:</strong> {{ $job->created_at->format('d M Y H:i') }}</p>
            <p><strong>Terakhir diupdate:</strong> {{ $job->updated_at->format('d M Y H:i') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('perusahaan.jobs.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('jobs.apply', $job->id) }}" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                <i class="bi bi-send me-2"></i>
                Lamar Sekarang
            </a>


        </div>
    </div>
</div>
@endsection