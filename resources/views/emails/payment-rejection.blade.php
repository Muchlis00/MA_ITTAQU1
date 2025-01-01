<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran PPDB Ditolak</title>
</head>
<body>
    <h2>Pembayaran PPDB Ditolak</h2>
    
    <p>Halo {{ $user->name }},</p>
    
    <p>Mohon maaf, pembayaran PPDB Anda telah ditolak dengan alasan berikut:</p>
    
    <p><strong>{{ $rejectionReason }}</strong></p>
    
    <p>Silakan melakukan pembayaran ulang dengan memperhatikan alasan penolakan di atas.</p>
    
    <p>Terima kasih.</p>
</body>
</html>