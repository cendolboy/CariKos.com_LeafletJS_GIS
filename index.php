<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CariKos adalah aplikasi web inovatif untuk pencarian properti kos dengan peta interaktif dan daftar lengkap properti. Temukan kos terbaik di berbagai lokasi dengan mudah!">
    <meta name="keywords" content="CariKos, properti kos, peta interaktif, daftar properti, sewa kos, aplikasi pencarian kos, lokasi kos, pengalaman pengguna, desain responsif">
    <meta name="author" content="Amos Duan Nugroho, S.Kom">
    <meta property="og:title" content="CariKos - Temukan Kos Terbaik di Lokasi Anda">
    <meta property="og:description" content="CariKos memudahkan pencarian kos dengan peta interaktif dan daftar lengkap properti. Dapatkan informasi lengkap dan pengalaman pengguna yang intuitif.">
    <meta property="og:image" content="https://avatars.githubusercontent.com/u/81355109?v=4">
    <meta property="og:url" content="https://www.carikos.com">
    <meta property="og:site_name" content="CariKos">
    <meta property="og:author" content="Amos Duan Nugroho, S.Kom">
    <meta property="og:profile" content="https://id.linkedin.com/in/amosduan">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="CariKos - Temukan Kos Terbaik di Lokasi Anda">
    <meta name="twitter:description" content="Pencarian kos yang efisien dan intuitif dengan peta interaktif dan daftar properti yang menarik.">
    <meta name="twitter:image" content="https://avatars.githubusercontent.com/u/81355109?v=4">
    <title>CariKos.com</title>
    <link rel="shortcut icon" href="board.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet"> <!-- Link Google Font -->
    <style>
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif; /* Menggunakan font Montserrat */
        }
        .top-bar {
            background-color: #f8f8f8;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            position: fixed;
            width: 100%;
            z-index: 1000;
            top: 0;
        }
        .top-bar a {
            color: #333; /* Warna default untuk tulisan */
            text-decoration: none;
            margin-left: 20px;
            font-weight:bold;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        .top-bar a:hover {
            color: #4CAF50; /* Warna hijau saat hover */
            font-weight:bold;
            transform: scale(1.1); /* Efek skala saat hover */
        }
        .header {
            background-color: #28a745;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e8e8e8;
            position: fixed;
            width: 100%;
            z-index: 999;
            top: 40px;
        }
        .content {
            margin-top: 100px; /* Adjust based on height of top-bar and header */
        }
        .header a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            position: relative; /* Untuk posisi garis bawah */
            padding-bottom: 5px; /* Spasi untuk garis bawah */
        }
        .header a:hover {
            color: #fff; /* Ubah warna teks saat hover */
        }
        .header a::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px; /* Tinggi garis bawah */
            background-color: #fff; /* Warna garis bawah */
            transform: scaleX(0); /* Awalnya tidak terlihat */
            transition: transform 0.3s ease; /* Transisi lembut */
        }
        .header a:hover::after {
            transform: scaleX(1); /* Tampilkan saat hover */
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo img {
            height: 40px;
            margin-right: 10px;
        }
        .logo span {
            font-size: 24px;
            color: #fff; /* Color hijau untuk 'mamikos' */
            font-weight: bold;
        }
        .list-group-item:hover {
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        .list-group-item.active-item {
            background-color: #28a745; /* Green background */
            color: white; /* White text */
        }
        .active-item {
            background-color: #28a745;
            color: white;
        }
        #map {
            height: 600px; /* Height of the map */
            border-radius: 15px; /* Border radius */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Shadow effect */
        }
        /* Tambahkan efek hover untuk logo */
        .footer img:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }
        .balloon {
            display: inline-block; /* Keeps the background wrapping around the text */
            background-color: #28a745; /* Green background */
            color: white; /* White text color */
            padding: 5px 15px; /* Reduced spacing for a smaller appearance */
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow */
            font-size: 1.2em; /* Adjust font size for better proportion */
            margin-bottom: 10px; /* Spacing below the balloon */
        }
        #propertyList {
            max-height: 600px; /* Set a maximum height */
            overflow-y: auto; /* Enable vertical scrolling */
            overflow-x: hidden; /* Hide horizontal overflow */
            border: 1px solid #ddd; /* Optional: Add a border for better visibility */
            border-radius: 5px; /* Optional: Rounded corners for the list */
        }
        .footer {
            background-color: #f8f8f8; /* Warna latar belakang yang lembut */
            padding: 20px;
            text-align: center; /* Menyelaraskan teks ke tengah */
        }

        .footer .divider {
            height: 4px;
            background-color: #4CAF50; /* Warna hijau */
            margin: 10px 0; /* Spasi di atas dan bawah garis */
        }

        .footer-content {
            max-width: 1200px; /* Mengatur lebar maksimal untuk responsivitas */
            margin: 0 auto; /* Menjaga footer tetap di tengah */
        }

        .footer-logo {
            display: flex;
            align-items: center; /* Menyelaraskan logo dan teks */
            justify-content: center;
            margin-bottom: 15px; /* Jarak antara logo dan deskripsi */
        }

        .footer-logo img {
            margin-right: 10px; /* Jarak antara logo dan teks */
        }

        .footer-logo p {
            margin: 0; /* Menghapus margin pada paragraf */
            font-size: 14px; /* Ukuran font untuk teks copyright */
            color: #555; /* Warna teks */
        }

        .footer-description p {
            color: #555; /* Warna teks yang lebih gelap untuk kontras */
            font-size: 14px; /* Ukuran font yang lebih kecil */
            line-height: 1.5; /* Jarak antar baris yang lebih baik */
            margin: 0 0 15px; /* Jarak bawah */
        }

        .footer-icons img {
            height: 30px; /* Ukuran ikon */
            margin: 0 10px; /* Jarak antar ikon */
            vertical-align: middle; /* Menjaga ikon sejajar dengan teks */
        }
    </style>
</head>
<body class="bg-light">

    <div class="top-bar">
        <div class="left-links">
            <a href="#">
                <img src="https://cdn-icons-png.flaticon.com/512/154/154870.png" alt="App Store" style="height: 20px; margin-right: 5px;">
                App Store
            </a>
            <a href="#">
                <img src="https://www.svgrepo.com/show/223032/playstore.svg" alt="Play Store" style="height: 20px; margin-right: 5px;">
                Playstore
            </a>
        </div>
        <div class="right-links">
            <a href="#"><i class="fas fa-bullhorn"></i> Promosikan Iklan Anda</a>
        </div>
    </div>
    
    <div class="header">
        <div class="logo">
            <img alt="Logo" height="40" src="board.png" width="40"/>
            <span>CariKos.com</span>
        </div>
        <div class="nav-links">
            <a href="#">Cari Apa? <i class="fas fa-caret-down"></i></a>
            <a href="#">Pusat Bantuan</a>
            <a href="#">Syarat dan Ketentuan</a>
            <a class="login-button" href="#">Masuk</a>
        </div>
    </div>
    
    <div class="content">
        <div class="container mt-5">
            <br/>
            <div class="row">
                <!-- Kolom Peta -->
                <div class="col-md-8">
                    <h3 class="mb-4 balloon">Peta Lokasi Kos</h3>
                    <div id="map" class="mb-5"></div>
                </div>

                <!-- Kolom Daftar Properti -->
                <div class="col-md-4">
                    <h3 class="mb-4 balloon">Daftar Properti</h3>
                    <ul id="propertyList" class="list-group"></ul>
                </div>
            </div>

            <!-- Modal untuk menampilkan detail properti -->
            <div class="modal fade" id="propertyModal" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 id="propertyModalLabel" class="modal-title">Detail Properti</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img id="propertyImage" src="" alt="Gambar Properti" class="img-fluid">
                            <h5 id="propertyName" class="mt-2"></h5>
                            <p id="propertyDescription" class="mt-1"></p>
                            <p><strong>Alamat:</strong> <span id="propertyAddress"></span></p>
                            <p><strong>Kontak WhatsApp:</strong> <a id="propertyWhatsApp" href="#" target="_blank">Hubungi</a></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="divider"></div> <!-- Menyisipkan divider -->
        <div class="footer-content">
            <div class="footer-logo">
                <img src="board.png" width="42" alt="Logo" />
                <p>Copyright © 2024 | carikos.com - Amos Duan Nugroho</p>
            </div>
            <div class="footer-description">
                <p>CariKos adalah aplikasi web inovatif yang dirancang untuk memudahkan pencarian properti kos di berbagai lokasi. Menggabungkan peta interaktif dan daftar properti yang menarik, proyek ini menawarkan pengalaman pengguna yang intuitif dan efisien.</p>
            </div>
            <div class="footer-icons">
                <img src="https://cdn-icons-png.flaticon.com/512/154/154870.png" alt="App Store" />
                <img src="https://www.svgrepo.com/show/223032/playstore.svg" alt="Play Store" />
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var propertyData = [];

        // Mengambil data dari server menggunakan PHP
        fetch('get_properties.php')
            .then(response => response.json())
            .then(data => {
                propertyData = data;
                initializeMap(data);
                populatePropertyList(data);
            });

        function initializeMap(data) {
            // Inisialisasi peta
            var map = L.map('map').setView([-6.9687745, 107.5517056], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);
            data.forEach(property => {
                var marker = L.marker([property.latitude, property.longitude]).addTo(map)
                    .bindTooltip(property.nama_kos, { permanent: true, direction: 'top', className: 'my-tooltip' })
                    .openTooltip();
                marker.on('click', function() {
                    showPropertyDetails(property);
                });
            });
        }

        function populatePropertyList(data) {
            var propertyList = document.getElementById('propertyList');
            propertyList.innerHTML = '';
            data.forEach(property => {
                var listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex align-items-center'; // Gunakan align-items-center

                // Membuat elemen media
                listItem.innerHTML = `
                    <img src="${property.gambar}" alt="${property.nama_kos}" class="mr-3" style="width: 80px; height: 80px; border-radius: 5px; object-fit: cover;">
                    <div class="media-body" style="padding-left: 10px;"> <!-- Menambahkan padding kiri -->
                        <h5 class="mt-0 mb-1">${property.nama_kos}</h5>
                        <p class="mb-0 text-muted" style="font-size: 0.9em;">${property.deskripsi.substring(0, 50)}...</p> <!-- Mengurangi ukuran deskripsi -->
                    </div>
                `;

                listItem.onclick = function() {
                    showPropertyDetails(property);
                };
                propertyList.appendChild(listItem);
            });
        }

        function showPropertyDetails(property) {
            // Remove active class from all items
            var items = document.querySelectorAll('.list-group-item');
            items.forEach(item => {
                item.classList.remove('active-item');
            });

            // Find the selected item based on property name
            var selectedItem = Array.from(document.querySelectorAll('.list-group-item')).find(item => {
                return item.querySelector('h5').innerText === property.nama_kos; // Check innerText of h5
            });

            // Add active class to the selected item
            if (selectedItem) {
                selectedItem.classList.add('active-item');
            }

            // Populate the modal with property details
            document.getElementById('propertyImage').src = property.gambar;
            document.getElementById('propertyName').innerText = property.nama_kos;
            document.getElementById('propertyDescription').innerText = property.deskripsi;
            document.getElementById('propertyAddress').innerText = property.alamat;
            document.getElementById('propertyWhatsApp').href = `https://wa.me/${property.kontak_whatsapp}`;

            // Show the modal
            var modal = new bootstrap.Modal(document.getElementById('propertyModal'));
            modal.show();

            // Clean up when modal is closed
            modal._element.addEventListener('hidden.bs.modal', function () {
                // Optionally remove the active state if desired
                selectedItem.classList.remove('active-item');
            });
        }
    </script>
</body>
</html>
