<!DOCTYPE html>
<html lang="id">
<head>
    <title>Profil Dev</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="p-5 bg-gray-100 text-sm">
    <div class="max-w-xl mx-auto bg-white p-5 border">
        <h2 class="font-bold text-lg mb-2">Profil Interaktif Developer Pemula</h2>
        <table class="w-full border mb-5">
            <tr><td class="border p-1 bg-gray-50">Nama</td><td class="border p-1">Salman Al Farizi</td></tr>
            <tr><td class="border p-1 bg-gray-50">ID</td><td class="border p-1">DEV001</td></tr>
            <tr><td class="border p-1 bg-gray-50">Tempat, tanggal lahir</td><td class="border p-1">Jombang, 13-Mei-2006</td></tr>
            <tr><td class="border p-1 bg-gray-50">No WA</td><td class="border p-1">087761027015</td></tr>
        </table>

        <form method="POST" class="space-y-3 border-t pt-4">
            <div>Framework: <input type="text" name="fw" class="border w-full p-1" required placeholder="Contoh: React, Vue, Laravel"></div>
            <div>Cerita: <textarea name="cerita" class="border w-full p-1" required></textarea></div>
            <div>
                Tools: 
                <input type="checkbox" name="tools[]" value="VS Code"> VS Code
                <input type="checkbox" name="tools[]" value="GitHub"> GitHub
            </div>
            <div>
                Minat: 
                <input type="radio" name="bidang" value="Frontend" required> backend
                <input type="radio" name="bidang" value="Backend"> frontend
            </div>
            <div>
                Skill: 
                <select name="level" class="border">
                    <option value="Dasar">Dasar</option>
                    <option value="Cukup">Cukup</option>
                </select>
            </div>
            <button name="gas" class="bg-blue-500 text-white px-4 py-1">PROSES</button>
        </form>

        <?php
        if(isset($_POST['gas'])){
            function cetak($d) {
                $fw_arr = explode(",", $d['fw']);
                echo "<div class='mt-5 p-3 bg-yellow-100 border'>";
                if(count($fw_arr) > 2) echo "<b>Skill Anda cukup luas di bidang development!</b><br>";
                echo "Bidang: ".$d['bidang']." | Level: ".$d['level']."<br>";
                echo "Pengalaman: ".$d['cerita'];
                echo "</div>";
            }
            if(!empty($_POST['fw']) && !empty($_POST['cerita'])) cetak($_POST);
        }
        ?>
        <br><a href="timeline.php" class="text-blue-600 underline">Ke Halaman Timeline</a>
    </div>
</body>
</html>