@extends('layouts.admin')

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
                            <td>{{ $app->job->posisi ?? '-' }}</td>
                            <td>{{ $app->nama }}</td>
                            <td>{{ $app->email }}</td>
                            <td>{{ $app->telepon }}</td>
                            <td>{{ $app->alamat }}</td>
                            <td>
                            @if ($app->cv_path)
                                <a href="{{ route('jobs.download.cv', $app->id) }}" target="_blank" class="btn btn-sm btn-primary">
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

{{-- Footer --}}
@section('footer')
<footer class="text-center py-3 bg-light mt-5 border-top">
    <small>© 2025 Job Portal. All rights reserved.</small>
</footer>
@endsection

{{-- DataTables CSS & JS --}}
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

