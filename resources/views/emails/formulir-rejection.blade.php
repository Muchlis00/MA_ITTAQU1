<!DOCTYPE html>
<html>
<head>
    <title>Formulir PPDB Ditolak</title>
</head>
<body>
    <h2>Formulir PPDB Ditolak</h2>
    
    <p>Halo {{ $user->name }},</p>
    
    <p>Mohon maaf, Formulir PPDB Anda telah ditolak dengan alasan berikut:</p>
    
    <p><strong>{{ $rejectionReason }}</strong></p>
    
    <p>Silakan melakukan perbaikan formulir dengan memperhatikan alasan penolakan di atas.</p>
    
    <p>Terima kasih.</p>
</body>
</html>