<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta dengan Satu Pin dan Pencarian Alamat</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }

        .button-container {
            margin-top: 10px;
            position: relative;
        }

        .autocomplete-list {
            border: 1px solid #ccc;
            border-top: none;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            background: white;
            width: 100%;
            z-index: 1000;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .autocomplete-list div {
            padding: 10px;
            cursor: pointer;
        }

        .autocomplete-list div:hover {
            background-color: #e9e9e9;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-4" style="margin-top: 60px;">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4" style="padding: 20px;">
                    <div class=" card-header pb-0">
                        <h6>Input Alamat PKL</h6>
                    </div>
                    <br>
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Persetujuan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $key) {
                                $persetujuan = $key->persetujuan
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $key->username ?></td>
                                    <td><?= $key->address ?></td>
                                    <td><?= $key->persetujuan ?></td>
                                    <td>
                                        <a>
                                            <button class="btn btn-primary btn-sm" onclick="showRoute([<?= $key->latitude ?>, <?= $key->longitude ?>])">Lihat Rute</button>
                                            <a href="<?= base_url('home/hapus_lokasi/' . $key->id) ?>">
                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                            </a>
                                            <?php if ($persetujuan == 'Setuju') { ?>
                                                <a href="<?= base_url('home/surat/' . $key->id) ?>">
                                                    <button class="btn btn-success btn-sm">Lihat Surat</button>
                                                </a>
                                            <?php } else {
                                            } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <br>

                    <div class=" card-body px-0 pt-0 pb-2">
                        <div class="button-container">
                            <input type="text" id="addressInput" class="form-control" placeholder="Masukkan alamat atau koordinat">
                            <div id="autocomplete-list" class="autocomplete-list"></div>
                        </div>
                        <br>
                        <div id="map"></div>
                        <br>
                        <form id="locationForm" action="<?= base_url('home/simpan_lokasi'); ?>" method="POST" style="display:none;">
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            <input type="hidden" name="address" id="address">
                            <button type="submit" class="btn btn-dark btn-sm w-100 mb-3">Simpan Lokasi</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Peringatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= session()->getFlashdata('error') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Alamat -->
    <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAddressModalLabel">Edit Alamat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAddressForm">
                        <input type="hidden" id="editLatitude">
                        <input type="hidden" id="editLongitude">
                        <div class="mb-3">
                            <label for="editAddressInput" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="editAddressInput" required>
                        </div>
                        <div id="editMap" style="height: 400px;"></div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Inisialisasi peta
        const map = L.map('map').setView([1.12343630, 104.01568480], 13);

        // Tambahkan layer tile ke peta
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Variabel untuk menyimpan marker
        let currentMarker = null;

        // Fungsi untuk menambahkan atau memindahkan pin ke peta
        $(document).ready(function() {
            // Jika ada pesan error, tampilkan modal
            <?php if (session()->getFlashdata('error')): ?>
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            <?php endif; ?>

            // Event listener untuk checkbox edit lokasi
            $('.edit-location-checkbox').change(function() {
                const isChecked = $(this).is(':checked');
                const id = $(this).data('id');

                if (isChecked) {
                    // Simpan ID lokasi yang akan diedit di hidden input atau gunakan sesuai kebutuhan
                    $('#locationForm').append(`<input type="hidden" name="id" id="locationId" value="${id}">`);
                } else {
                    // Hapus hidden input jika checkbox tidak dipilih
                    $('#locationId').remove();
                }
            });
        });

        // Fungsi untuk menambahkan atau memindahkan pin ke peta
        function addMarker(lat, lon, address) {
            if (currentMarker) {
                map.removeLayer(currentMarker); // Hapus marker lama jika ada
            }

            currentMarker = L.marker([lat, lon]).addTo(map)
                .bindPopup('Lokasi: ' + address)
                .openPopup();

            // Simpan data ke dalam form
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lon;
            document.getElementById('address').value = address;

            // Tampilkan form simpan lokasi
            document.getElementById('locationForm').style.display = 'block';
        }
        // Fungsi untuk menangani input dan menampilkan hasil pencarian
        function onAddressInput() {
            const address = document.getElementById('addressInput').value;
            if (address) {
                fetch(`https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(address)}&key=94f61fd952d9498a8d7fd7a3858e7599`)
                    .then(response => response.json())
                    .then(data => {
                        const autocompleteList = document.getElementById('autocomplete-list');
                        autocompleteList.innerHTML = '';
                        if (data.results.length > 0) {
                            data.results.forEach((result, index) => {
                                const itemDiv = document.createElement('div');
                                itemDiv.innerHTML = result.formatted;
                                itemDiv.addEventListener('click', () => {
                                    const lat = result.geometry.lat;
                                    const lon = result.geometry.lng;
                                    const address = result.formatted;
                                    addMarker(lat, lon, address);
                                    autocompleteList.innerHTML = ''; // Hapus daftar autocomplete
                                    document.getElementById('addressInput').value = address; // Tampilkan alamat yang dipilih di input
                                });
                                autocompleteList.appendChild(itemDiv);
                            });
                        } else {
                            autocompleteList.innerHTML = '<div>Alamat tidak ditemukan</div>';
                        }
                    });
            }
        }

        // Event listener untuk input alamat
        document.getElementById('addressInput').addEventListener('input', onAddressInput);

        // Event listener untuk klik pada peta
        map.on('click', function(e) {
            fetch(`https://api.opencagedata.com/geocode/v1/json?q=${e.latlng.lat}+${e.latlng.lng}&key=94f61fd952d9498a8d7fd7a3858e7599`)
                .then(response => response.json())
                .then(data => {
                    if (data.results.length > 0) {
                        const address = data.results[0].formatted;
                        addMarker(e.latlng.lat, e.latlng.lng, address);
                    }
                });
        });

        $(document).ready(function() {
            // Jika ada pesan error, tampilkan modal
            <?php if (session()->getFlashdata('error')): ?>
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            <?php endif; ?>
        });

        // Tambahkan layer peta dasar
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Variabel untuk menyimpan rute dan marker
        let currentRoute = null;
        let markers = [];

        function showRoute(end) {
            // Hapus rute lama jika ada
            if (currentRoute) {
                map.removeLayer(currentRoute);
                currentRoute = null; // Reset currentRoute
            }

            // Hapus marker lama
            markers.forEach(marker => map.removeLayer(marker));
            markers = []; // Reset markers array

            // Mengambil lokasi saat ini menggunakan API Geolocation
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const start = [position.coords.latitude, position.coords.longitude];

                    fetch(`https://api.openrouteservice.org/v2/directions/driving-car?api_key=5b3ce3597851110001cf62480062fe5146374bd49a918004793249ce&start=${start[1]},${start[0]}&end=${end[1]},${end[0]}`)
                        .then(response => response.json())
                        .then(data => {
                            const routeCoordinates = data.features[0].geometry.coordinates;

                            // Buat rute baru dan tambahkan ke peta
                            currentRoute = L.polyline(routeCoordinates.map(coord => [coord[1], coord[0]]), {
                                color: 'blue'
                            }).addTo(map);
                            map.fitBounds(currentRoute.getBounds());

                            // Tambahkan marker di lokasi awal dan akhir
                            const startMarker = L.marker([start[0], start[1]]).addTo(map).bindPopup('Start').openPopup();
                            const endMarker = L.marker([end[0], end[1]]).addTo(map).bindPopup('End').openPopup();

                            // Simpan marker di array untuk dihapus nantinya
                            markers.push(startMarker, endMarker);
                        })
                        .catch(error => console.error('Error:', error));
                }, function(error) {
                    console.error('Error getting location:', error);
                    alert('Tidak dapat mengambil lokasi Anda. Pastikan fitur lokasi aktif.');
                });
            } else {
                alert('Geolocation tidak didukung oleh browser ini.');
            }
        }
    </script>
</body>

</html>