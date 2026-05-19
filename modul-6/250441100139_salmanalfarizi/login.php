<?php
session_start();

if (!file_exists('koneksi.php')) {
    die("Error: File koneksi.php tidak ditemukan!");
}
include 'koneksi.php';

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
    
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id,username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['username'] =$row['username'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login Sistem</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Login Inventaris</h2>
        <?php if(isset($error)) echo "<p class='text-red-500 mb-4'>$error</p>"; ?>
        <form method="POST">
            <div class="mb-4">
                <label class="block mb-2">Username</label>
                <input type="text" name="username" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-6">
                <label class="block mb-2">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>
            <button type="submit" name="login" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Masuk</button>
            <p class="mt-4 text-center text-sm">
    Belum punya akun? <a href="register.php" class="text-blue-600 underline">Daftar di sini</a>
</p>
        </form>
    </div>
</body>
</html>