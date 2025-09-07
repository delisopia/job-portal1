@extends('layouts.admin')

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
                            <td>{{ $application->nama }}</td>
                            <td>{{ $application->email }}</td>
                            <td>{{ $application->job->posisi }}</td>
                            <td>{{ $application->job->perusahaan }}</td>
                            <td>
                                <form action="{{ route('admin.lamaran.updateStatus', $application->id) }}" method="POST">
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

{{-- Panggil CSS & JS DataTables --}}
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table-pelamar').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(difilter dari total _MAX_ data)",
                paginate: {
                    first: "Pertama",
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