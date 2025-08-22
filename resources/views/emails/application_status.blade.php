<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Status Lamaran</title>
</head>
<body>
    <h2>Halo, {{ $application->user->name }}</h2>
    <p>Lamaran Anda untuk posisi <strong>{{ $application->job->posisi ?? '-' }}</strong> telah diperbarui.</p>
 
    @if($status == 'diterima')
        <p style="color: green;">🎉 Selamat! Lamaran Anda <b>DITERIMA</b>.</p>
    @elseif($status == 'ditolak')
        <p style="color: red;">😔 Mohon maaf, lamaran Anda <b>DITOLAK</b>.</p>
    @else
        <p>Status lamaran Anda masih dalam proses.</p>
    @endif
 
    <br>
    <p>Terima kasih,<br>Tim Recruitment</p>
</body>
</html>
