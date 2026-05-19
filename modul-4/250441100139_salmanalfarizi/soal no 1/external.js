// Mengambil elemen dari HTML
const tombolLogin = document.getElementById('submit');
const inputEmail = document.getElementById('email');
const inputPassword = document.getElementById('password');

// Fungsi yang dijalankan saat tombol diklik
tombolLogin.onclick = function() {
        
    // Mengambil teks yang diketik user
    const userEmail = inputEmail.value;
    const userPass = inputPassword.value;

    // Logika Validasi
    if (userEmail === " " || userPass === "") {
        // Jika salah satu atau keduanya kosong
        alert("Gagal Login! Anda harus memasukkan Username dan Password terlebih dahulu.");
    } else {
        // Jika keduanya sudah terisi
        alert("Login Berhasil! Selamat datang, " + userEmail);
    }
};