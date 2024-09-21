<div class="container-fluid py-4" style="margin-top: 60px;">
    <div class="row">
        <div class="col-12">
            <!-- Card dengan tab di dalamnya -->
            <div class="card mb-4" style="padding: 20px;">
                <!-- Tab navigation -->
                <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-bottom: 20px;">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="map-tab" data-bs-toggle="tab" data-bs-target="#mapTabContent" type="button" role="tab" aria-controls="mapTabContent" aria-selected="true">Peta dan Data</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="empty-tab" data-bs-toggle="tab" data-bs-target="#emptyTabContent" type="button" role="tab" aria-controls="emptyTabContent" aria-selected="false">Persetujuan</button>
                    </li>
                </ul>

                <!-- Konten tab -->
                <div class="tab-content" id="myTabContent">
                    <!-- Tab pertama: Peta dan Data -->
                    <div class="tab-pane fade show active" id="mapTabContent" role="tabpanel" aria-labelledby="map-tab">
                        <div class="row">
                            <!-- Kolom kiri: Peta -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>Peta Lokasi</h6>
                                    </div>
                                    <br>
                                    <div class="card-body px-0 pt-0 pb-2" style="height: 800px;">
                                        <div id="map" style="height: 800px;"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom kanan: Tabel -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>Data Alamat PKL</h6>
                                    </div>
                                    <br>
                                    <form class="filter-form" method="get" action="<?= site_url('home/data') ?>">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="nis" placeholder="NIS" value="<?= esc($nis) ?>" class="form-control">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="kelas" placeholder="Kelas" value="<?= esc($kelas) ?>" class="form-control">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="jurusan" placeholder="Jurusan" value="<?= esc($jurusan) ?>" class="form-control">
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary">Cari</button>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- Tabel dengan scroll horizontal -->
                                    <div style="overflow-x: auto;">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Kelas</th>
                                                    <th>Jurusan</th>
                                                    <th>Lokasi</th>
                                                    <th>Persetujuan</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($data as $key) {
                                                ?>
                                                    <tr>
                                                        <td><?= $key->username ?><br>
                                                            <p style="font-size: 12px;"><?= $key->nis ?></p>
                                                        </td>
                                                        <td><?= $key->kelas ?></td>
                                                        <td><?= $key->jurusan ?></td>
                                                        <td><?= $key->address ?></td>
                                                        <td><?= $key->persetujuan ?></td>
                                                        <td>
                                                            <button class="btn btn-primary btn-sm" onclick="showRoute([<?= $key->latitude ?>, <?= $key->longitude ?>])">Lihat Rute</button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab kedua: Kosong -->
                    <div class="tab-pane fade" id="emptyTabContent" role="tabpanel" aria-labelledby="empty-tab">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h6>Persetujuan</h6>
                            </div>
                            <br>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div style="overflow-x: auto;">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Kelas</th>
                                                <th>Jurusan</th>
                                                <th>Lokasi</th>
                                                <th>Persetujuan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($data as $key) {
                                            ?>
                                                <tr>
                                                    <td><?= $key->username ?><br>
                                                        <p style="font-size: 12px;"><?= $key->nis ?></p>
                                                    </td>
                                                    <td><?= $key->kelas ?></td>
                                                    <td><?= $key->jurusan ?></td>
                                                    <td><?= $key->address ?></td>
                                                    <td><?= $key->persetujuan ?></td>
                                                    <td>
                                                        <a href="<?= base_url('home/terima/' . $key->id) ?>">
                                                            <i class="ni ni-check-bold"></i>
                                                        </a>
                                                        <br>
                                                        <a href="<?= base_url('home/tolak/' . $key->id) ?>">
                                                            <i class="ni ni-fat-remove"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan dependency Bootstrap jika belum -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    // Inisialisasi peta
    const map = L.map('map').setView([1.1234363, 104.0156848], 13);

    // Tambahkan layer peta dasar
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Variabel untuk menyimpan rute dan marker
    let currentRoute = null;
    let markers = [];

    function showRoute(end) {
        if (currentRoute) {
            map.removeLayer(currentRoute);
            currentRoute = null;
        }

        markers.forEach(marker => map.removeLayer(marker));
        markers = [];

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const start = [position.coords.latitude, position.coords.longitude];

                fetch(`https://api.openrouteservice.org/v2/directions/driving-car?api_key=5b3ce3597851110001cf62480062fe5146374bd49a918004793249ce&start=${start[1]},${start[0]}&end=${end[1]},${end[0]}`)
                    .then(response => response.json())
                    .then(data => {
                        const routeCoordinates = data.features[0].geometry.coordinates;

                        currentRoute = L.polyline(routeCoordinates.map(coord => [coord[1], coord[0]]), {
                            color: 'blue'
                        }).addTo(map);
                        map.fitBounds(currentRoute.getBounds());

                        const startMarker = L.marker([start[0], start[1]]).addTo(map).bindPopup('Start').openPopup();
                        const endMarker = L.marker([end[0], end[1]]).addTo(map).bindPopup('End').openPopup();

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