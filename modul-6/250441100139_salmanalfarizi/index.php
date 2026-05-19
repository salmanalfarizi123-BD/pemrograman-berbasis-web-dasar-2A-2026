<?php 
include 'auth_check.php'; 
include 'koneksi.php';

$query = "SELECT * FROM barang";
$result = mysqli_query($conn, $query);

$barang_list = [];
while($row = mysqli_fetch_assoc($result)) {
    $barang_list[] = $row;
}

$is_admin = (isset($_SESSION['role']) && $_SESSION['role'] == 'admin');
$username_aktif = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
$role_aktif = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard Inventaris</title>
</head>
<body class="bg-gray-50">
    <nav class="bg-blue-600 p-4 text-white flex justify-between ">
        <span class="font-bold">Sistem Inventaris</span>
        <div>
            <span class="mr-2 text-sm">
                Halo, <strong class="font-semibold"><?= htmlspecialchars($username_aktif); ?></strong> 
                (<span class="capitalize text-xs opacity-90"><?= htmlspecialchars($role_aktif); ?></span>)
            </span>
            <a href="logout.php" class="ml-4 bg-red-500 px-3 py-1 rounded">Logout</a>
        </div>
    </nav>

    <div class="container mx-auto mt-8 p-4 bg-white rounded shadow">
        <div class="flex justify-between mb-4">
            <h1 class="text-xl font-bold">Daftar Barang</h1>
            <?php if($is_admin): ?>
                <a href="tambah.php" class="bg-green-500 text-white px-4 py-2 rounded">+ Tambah Barang</a>
            <?php endif; ?>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 border">Nama</th>
                    <th class="p-3 border">Kategori</th>
                    <th class="p-3 border">Stok</th>
                    <th class="p-3 border">Harga</th>
                    <!-- Judul Kolom Aksi hanya muncul jika Admin -->
                    <?php if($is_admin): ?>
                        <th class="p-3 border">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($barang_list as $row): ?>
                <tr>
                    <td class="p-3 border"><?= htmlspecialchars($row['nama_barang']); ?></td>
                    <td class="p-3 border"><?= htmlspecialchars($row['kategori']); ?></td>
                    <td class="p-3 border"><?= $row['stok']; ?></td>
                    <td class="p-3 border">Rp <?= number_format($row['harga_satuan'], 0, ',', '.'); ?></td>
                    <?php if($is_admin): ?>
                    <td class="p-3 border">
                        <a href="edit.php?id=<?= $row['id']; ?>" class="text-blue-600">Edit</a> |
                        <a href="hapus.php?id=<?= $row['id']; ?>" class="text-red-600" onclick="return confirm('Hapus data?')">Hapus</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
</html>