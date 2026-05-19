<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role     = isset($_POST['role']) ? $_POST['role'] : 'user'; 

   
    $cek = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $res = $cek->get_result();

    if ($res->num_rows > 0) {
        $error = "Username sudah digunakan, cari yang lain!";
    } else {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $role);

        if ($stmt->execute()) {
            $success = "Registrasi berhasil! Silakan <a href='login.php' class='font-bold underline'>Login</a>";
        } else {
            $error = "Terjadi kesalahan saat mendaftar.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register Sistem</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Daftar Akun</h2>
        
        <?php if(isset($error)) echo "<p class='text-red-500 mb-4 bg-red-100 p-2 rounded'>$error</p>"; ?>
        <?php if(isset($success)) echo "<p class='text-green-500 mb-4 bg-green-100 p-2 rounded'>$success</p>"; ?>
        
        <form method="POST">
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Username</label>
                <input type="text" name="username" class="w-full border p-2 rounded" placeholder="Masukkan username" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" placeholder="Masukkan password" required>
            </div>
            <div class="mb-6">
            </div>
            <button type="submit" name="register" class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-700 font-bold transition">Daftar Sekarang</button>
            
            <p class="mt-4 text-center text-sm text-gray-600">
                Sudah punya akun? <a href="login.php" class="text-blue-600 hover:underline">Login di sini</a>
            </p>
        </form>
    </div>
</body>
</html>