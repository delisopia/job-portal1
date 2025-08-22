@extends('layouts.admin')

@section('content')
<div class="container my-4">

    <div class="d-flex justify-content-between align-items-center mb-4 pb-2">
        <h2 class="text-primary m-0">📄 Daftar Lowongan</h2>
        <a href="{{ route('admin.jobs.create') }}" class="btn btn-success">
            + Tambah Lowongan
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-jobs" class="table table-bordered table-striped table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Posisi</th>
                            <th>Perusahaan</th>
                            <th>Lokasi</th>
                            <th>Tanggal Tutup</th>
                            <th>Deskripsi</th>
                            <th>Gaji_Min</th>
                            <th>Gaji_Max</th>
                            <th>tipe_kerja</th>
                            <th>Pengalaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $index => $job)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-primary fw-semibold">{{ $job->posisi }}</td>
                            <td>{{ $job->perusahaan }}</td>
                            <td>{{ $job->lokasi }}</td>
                            <td>{{ \Carbon\Carbon::parse($job->tanggal_tutup)->format('d M Y') }}</td>
                            <td class="text-start">{{ Str::limit($job->deskripsi, 80) }}</td>
                            <td><span class="badge bg-info text-dark">Rp {{ number_format($job->gaji_min, 0, ',', '.') }}</span></td>
                            <td><span class="badge bg-info text-dark">Rp {{ number_format($job->gaji_max, 0, ',', '.') }}</span></td>
                            <td><span class="badge bg-secondary">{{ $job->tipe_kerja }}</span></td>
                            <td><span class="badge bg-light text-dark">{{ $job->pengalaman }}</span></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus lowongan ini?')" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- DataTables Style --}}
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
@endpush

{{-- DataTables Script --}}
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table-jobs').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Awal",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                },
            }
        });
        $('.dataTables_length, .dataTables_filter').addClass('mb-5');
    });
</script>
@endpush