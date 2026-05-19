<?php
include 'auth_check.php';
include 'koneksi.php';

// TANDA TAMBAHAN: Ambil data barang berdasarkan ID dari URL
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM barang WHERE id = $id");
$data = $result->fetch_assoc();


if (!$data) {
    die("Error: Data tidak ditemukan di database. Data manual (ID 99/100) tidak bisa diedit via DB.");
}

if (isset($_POST['update'])) {
    $nama   = $_POST['nama_barang'];
    $kat    = $_POST['kategori'];
    $stok   = $_POST['stok'];
    $harga  = $_POST['harga_satuan'];

    // TANDA TAMBAHAN: Query Update ke Database
    $stmt = $conn->prepare("UPDATE barang SET nama_barang=?, kategori=?, stok=?, harga_satuan=? WHERE id=?");
    $stmt->bind_param("ssidi", $nama, $kat, $stok, $harga, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        $error = "Gagal memperbarui data!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Barang</title>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-orange-500">Edit Data Barang</h2>
        <form method="POST">
            <div class="mb-4">
                <label class="block mb-1">Nama Barang</label>
                <input type="text" name="nama_barang" value="<?= $data['nama_barang'] ?>" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Kategori</label>
                <input type="text" name="kategori" value="<?= $data['kategori'] ?>" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Stok</label>
                <input type="number" name="stok" value="<?= $data['stok'] ?>" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-6">
                <label class="block mb-1">Harga Satuan</label>
                <input type="number" name="harga_satuan" value="<?= $data['harga_satuan'] ?>" class="w-full border p-2 rounded" required>
            </div>
            <button type="submit" name="update" class="w-full bg-blue-600 text-white p-2 rounded font-bold">Update Data</button>
            <a href="index.php" class="block text-center mt-4 text-gray-600">Batal</a>
        </form>
    </div>
</body>
</html>