<?php
$artikels = [
    1 => ["jdl" => "Belajar HTML", "tgl" => "01-01-2024", "isi" => "HTML itu gampang-gampang susah."],
    2 => ["jdl" => "Error PHP", "tgl" => "02-02-2025", "isi" => "Pusing gara-gara kurang titik koma."]
];

$quotes = ["Tetap semangat!", "Jangan lupa tidur.", "Coding itu seni.", "Error adalah kawan."];
$q_acak = $quotes[array_rand($quotes)];

$id = $_GET['id'] ?? null;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="p-5 flex gap-5">
    <div class="w-1/4 border p-3">
        <h3 class="font-bold">Daftar Blog</h3>
        <?php foreach($artikels as $k => $v): ?>
            <a href="?id=<?= $k ?>" class="block text-blue-500 underline mb-1"><?= $v['jdl'] ?></a>
        <?php endforeach; ?>
        <hr class="my-2">
        <a href="timeline.php" class="text-xs">Balik</a>
    </div>

    <div class="w-3/4 border p-5 bg-white">
        <?php if($id && isset($artikels[$id])): $c = $artikels[$id]; ?>
            <h2 class="font-bold text-xl"><?= $c['jdl'] ?></h2>
            <small><?= $c['tgl'] ?></small>
            <div class="my-4 p-5 bg-gray-200">[Gambar: img/blog.jpg]</div>
            <p><?= $c['isi'] ?></p>
            <a href="#" class="text-blue-400 text-xs italic">Link Sumber</a>
        <?php else: ?>
            <p class="text-gray-400 italic">Pilih judul di kiri.</p>
        <?php endif; ?>
        
        <div class="mt-10 p-2 border-t italic text-sm text-gray-600">
            Quote: "<?= $q_acak ?>"
        </div>
    </div>
</body>
</html>