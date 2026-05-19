<?php
$riwayat_belajar = [
     ["tahun" => 2022, "kegiatan" => "Masuk SMK Muhammadiyah 3 Mojoagung"],
    ["tahun" => 2023, "kegiatan" => "belajar terkait jaringan"],
    ["tahun" => 2024, "kegiatan" => "Magang di provider layanan internet PT. Aufa Berkah Media"],
    ["tahun" => 2025, "kegiatan" => "Masuk kuliah jurusan Sistem Informasi Universitas Trunodjoyo Madura"],
    ["tahun" => 2026, "kegiatan" => "semester 2 dengan praktikum PBWD, dan PBD"],
    
];

function formatTahun($tahun, $target) {
    if ($tahun == $target) {
        return "<b style='color: #2ecc71; font-size: 1.2em;'>$tahun (Tahun Ini)</b>";
    }
    return "<b>$tahun</b>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Timeline Belajar</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 50px; }
        .timeline { border-left: 3px solid #3498db; padding: 0 20px; position: relative; }
        .item { margin-bottom: 30px; position: relative; }
        .item::before { 
            content: ''; background: #3498db; width: 15px; height: 15px; 
            border-radius: 50%; position: absolute; left: -29px; top: 5px;
        }
        .nav { margin-top: 30px; }
    </style>
</head>
<body>
    <h2>Timeline Perjalanan Belajar Coding</h2>
    <div class="timeline">
        <?php foreach ($riwayat_belajar as $item): ?>
            <div class="item">
                <div class="year"><?php echo formatTahun($item['tahun'], 2026); ?></div>
                <div class="desc"><?php echo $item['kegiatan']; ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="nav">
        <a href="index.php">Kembali ke Profil</a> | 
        <a href="blog.php">Menuju Blog Developer</a>
    </div>
</body>
</html>