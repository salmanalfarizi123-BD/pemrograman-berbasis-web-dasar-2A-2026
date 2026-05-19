<?php
include 'auth_check.php';
include 'koneksi.php';


if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_POST['tambah'])) {
    $nama   = $_POST['nama_barang'];
    $kat    = $_POST['kategori'];
    $stok   = $_POST['stok'];
    $harga  = $_POST['harga_satuan'];

    $stmt = $conn->prepare("INSERT INTO barang (nama_barang, kategori, stok, harga_satuan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssid", $nama, $kat, $stok, $harga);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        $error = "Gagal menambah barang!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tambah Barang</title>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-blue-600">Tambah Barang Baru</h2>
        <form method="POST">
            <div class="mb-4">
                <label class="block mb-1">Nama Barang</label>
                <input type="text" name="nama_barang" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Kategori</label>
                <input type="text" name="kategori" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Stok</label>
                <input type="number" name="stok" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-6">
                <label class="block mb-1">Harga Satuan</label>
                <input type="number" name="harga_satuan" class="w-full border p-2 rounded" required>
            </div>
            <button type="submit" name="tambah" class="w-full bg-green-600 text-white p-2 rounded font-bold">Simpan Barang</button>
            <a href="index.php" class="block text-center mt-4 text-gray-600">Batal</a>
        </form>
    </div>
</body>
</html>