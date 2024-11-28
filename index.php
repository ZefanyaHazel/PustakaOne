<?php 
session_start();

if (isset($_SESSION["level"])) {
    header("location: login.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="assets/css/header.css">
</head>

<body>

    <!-- Navigation Header -->
    <nav>
        <div class="box-content">
            <h1 class="logo">Pustaka<span>ONE.</span></h1>
            <ul class="nav-links">
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </div>
    </nav>

    <!-- Header Section -->
    <header id="header">
        <div class="box-content">
            <h1>Selamat Datang di PustakaONE.</h1>
            <p>Pinjam berbagai buku dengan mudah dan aman lewat PerpusNet.</p>
            <button onclick="scrollToSection('about')">Lihat Fiturnya ></button>
        </div>
    </header>

    <!-- About Section -->
    <section id="about">
        <div class="box-content">
            <h2>Tentang Kami</h2>
            <hr>
            <p>PerpusNet. merupakan aplikasi portal/penghubung perpustakaan dengan para anggota peminjam buku. Dengan aplikasi ini, Anda bisa mencari dan mengakses buku secara online dengan mudah.</p>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features">
        <div class="box-content">
            <h2>Fitur Aplikasi</h2>
            <hr>
            <div class="cards">
                <div class="card">
                    <div class="card-content">
                        <h3>Beragam Koleksi Buku</h3>
                        <p>Koleksi buku yang dapat kamu lihat mencakup banyak sekali genre, kamu juga dapat mengoleksi bukumu disini.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h3>Daftar lengkap Peminjaman</h3>
                        <p>Tinjau seluruh buku-buku yang sedang dipinjam saat ini, termasuk pinjamanmu sendiri.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h3>Riwayat Peminjaman</h3>
                        <p>Lihat semua daftar riwayat buku-buku yang telah dipinjam, termasuk yang dipinjam kamu juga.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="box-content">
            <h2>Kontak kami</h2>
            <hr>
            <div class="contact-form">
                <div class="text-title">
                    <h3>Tulis <span>Kesan</span> dan <span>Pesanmu</span> Disini!</h3>
                </div>
                <form onsubmit="sendMessage()">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Write your message" required></textarea>
                    </div>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="box-content">
            <p>&copy; <?php echo date("Y") ?> PerpusNet. Made with 💕 by <strong><a href="https://instagram.com/zefanya_hazel" target="_blank">Hazel</a></strong>.</p>
        </div>
    </footer>

    <script src="script.js"></script>
    <script>
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            section.scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Form submission handling

        function sendMessage() {

            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const message = document.getElementById("message").value;

            const url = "https://api.whatsapp.com/send?phone=6289630307517&text=Nama%20%3A%20*" + name + "*%0AEmail%20%3A%20*" + email + "*%0A%0APesan%20%3A%20" + message ;

            window.open(url);
        }
    </script>
</body>

</html>