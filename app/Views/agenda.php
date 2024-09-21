<style>
    #pilihHari {
        width: 150px;
        /* Atur lebar dropdown */
        text-align: center;
        /* Pusatkan teks dalam dropdown */
        display: inline-block;
    }

    /* Mengatur tombol panah agar berada di dekat dropdown */
    #prevDay,
    #nextDay {
        display: inline-block;
        margin: 0 10px;
        /* Atur jarak antara tombol dengan dropdown */
    }
</style>


<div class="container-fluid py-4" style="margin-top: 60px;">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 20px;">
                <div class="card-header pb-0">
                    <h6>Agenda PKL</h6>
                </div>
                <br>
                <!-- Tabs navigation -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Data PT</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Daily Report</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Weekly Report</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="absen_pt-tab" data-bs-toggle="tab" data-bs-target="#absen_pt" type="button" role="tab" aria-controls="absen_pt" aria-selected="false">Kehadiran Pada Perusahaan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="penilaian-tab" data-bs-toggle="tab" data-bs-target="#penilaian" type="button" role="tab" aria-controls="penilaian" aria-selected="false">Table Penilaian</button>
                    </li>
                </ul>

                <br>

                <!-- Tabs content -->
                <div class="tab-content" id="myTabContent" style="justify-content: center;">
                    <!-- Data PT Tab -->
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <!-- Button to trigger modal -->
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#editModal">
                            Edit Data PT
                        </button>

                        <!-- Display data (read-only) -->

                        <div class="form-group row">
                            <label for="namaPT" class="col-sm-2 col-form-label">Nama PT:</label>

                            <div class="col-sm-12">
                                <?php foreach ($pt as $pt_data): ?>
                                    <p><?= $pt_data->nama_pt ?></p>
                                <?php endforeach; ?>
                            </div>
                            <label for="namaPT" class="col-sm-2 col-form-label">Nomor Telepon PT:</label>
                            <div class="col-sm-12">
                                <?php foreach ($pt as $pt_data): ?>
                                    <p><?= $pt_data->nomor_pt ?></p>
                                <?php endforeach; ?>
                            </div>

                            <label for="namaPT" class="col-sm-2 col-form-label">Alamat PT:</label>
                            <div class="col-sm-12">
                                <?php foreach ($pt as $pt_data): ?>
                                    <p><?= $pt_data->address ?></p>
                                <?php endforeach; ?>
                            </div>

                            <label for="namaPT" class="col-sm-2 col-form-label">Nama Murid:</label>
                            <div class="col-sm-12">
                                <?php foreach ($pt as $pt_data): ?>
                                    <p><?= $pt_data->username ?></p>
                                <?php endforeach; ?>
                            </div>

                            <label for="namaPT" class="col-sm-2 col-form-label">NIS:</label>
                            <div class="col-sm-12">
                                <?php foreach ($pt as $pt_data): ?>
                                    <p><?= $pt_data->nis ?></p>
                                <?php endforeach; ?>
                            </div>

                            <label for="namaPT" class="col-sm-2 col-form-label">Kelas:</label>
                            <div class="col-sm-12">
                                <?php foreach ($pt as $pt_data): ?>
                                    <p><?= $pt_data->kelas ?></p>
                                <?php endforeach; ?>
                            </div>

                            <label for="namaPT" class="col-sm-2 col-form-label">Jurusan:</label>
                            <div class="col-sm-12">
                                <?php foreach ($pt as $pt_data): ?>
                                    <p><?= $pt_data->jurusan ?></p>
                                <?php endforeach; ?>
                            </div>

                        </div>

                        <!-- ... lainnya -->

                        <!-- Modal for Edit -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Data PT</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url('home/aksi_e_datapt') ?>" method="POST">
                                            <label for="namaPT" class="col-sm-2 col-form-label">Nama PT:</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="namaPT" name="namaPT" value="Contoh Nama PT">
                                            </div>
                                            <label for="namaPT" class="col-sm-2 col-form-label">No Telp PT:</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="nomorPT" name="nomorPT" value="Contoh Nomor PT">
                                            </div>
                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="Submit" class="btn btn-primary" onclick="saveChanges()">Simpan</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Daily Report Tab -->
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- Button to trigger modal for Daily Report -->
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#dailyReportModal">
                            Edit Daily Report
                        </button>

                        <a href="<?= base_url('home/hapus_agenda') ?>">
                            <button type="button" class="btn btn-danger mb-3">
                                Delete Daily Report
                            </button>
                        </a>

                        <!-- Display data (read-only) for Daily Report -->
                        <div class="form-group row">
                            <p style="font-size: 25px;"><?= $agenda->absen ?></p>
                        </div>

                        <div class="form-group row">
                            <label for="tanggalHari" class="col-sm-2 col-form-label">Tanggal Hari:</label>
                            <p><?= $agenda->tanggal ?></p>
                        </div>
                        <div class="form-group row">
                            <label for="jamMasuk" class="col-sm-2 col-form-label">Jam Masuk:</label>
                            <p><?= $agenda->jam_masuk ?></p>
                        </div>
                        <div class="form-group row">
                            <label for="jamPulang" class="col-sm-2 col-form-label">Jam Pulang:</label>
                            <p><?= $agenda->jam_pulang ?></p>
                        </div>
                        <div class="form-group row">
                            <label for="jamPulang" class="col-sm-2 col-form-label">Rencana Kerja :</label>
                            <div class="col-sm-5">
                                <textarea type="text" class="form-control" id="rencana" nama="rencana" readonly><?= $agenda->rencana ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jamPulang" class="col-sm-2 col-form-label">Realisasi Kerja :</label>
                            <div class="col-sm-5">
                                <textarea type="text" class="form-control" id="realisasi" nama="realisasi" readonly><?= $agenda->realisasi ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jamPulang" class="col-sm-2 col-form-label">Penugasan Atasan Dari:</label>
                            <div class="col-sm-5">
                                <textarea type="text" class="form-control" id="penugasan" nama="penugasan" readonly><?= $agenda->penugasan ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jamPulang" class="col-sm-2 col-form-label">Masalah Kerja :</label>
                            <div class="col-sm-5">
                                <textarea type="text" class="form-control" id="masalah" nama="masalah" readonly><?= $agenda->masalah ?></textarea>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Penilaian:</label><br>

                            <label for="exampleInputUsername1">Keramahan</label>
                            <div class="col-sm-5">
                                <p><?= $agenda->keramahan ?></p>
                            </div>
                            <label for="exampleInputUsername1">Penampilan</label>
                            <div class="col-sm-5">
                                <p><?= $agenda->penampilan ?></p>
                            </div>

                            <label for="exampleInputUsername1">Senyum</label>
                            <div class="col-sm-5">
                                <p><?= $agenda->senyum ?></p>
                            </div>

                            <label for="exampleInputUsername1">Komunikasi</label>
                            <div class="col-sm-5">
                                <p><?= $agenda->komunikasi ?></p>
                            </div>

                            <label for="exampleInputUsername1">Realisasi Kerja</label>
                            <div class="col-sm-5">
                                <p><?= $agenda->realisasi_kerja ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jamPulang" class="col-sm-2 col-form-label">Catatan Kerja :</label>
                            <div class="col-sm-5">
                                <textarea type="text" class="form-control" id="catatan_kerja" nama="catatan_kerja" readonly><?= $agenda->catatan_kerja ?></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="jamPulang" class="col-sm-2 col-form-label">Persetujuan Pembimbing PKL :</label>
                            <div class="col-sm-5">
                                <?php
                                if ($agenda->persetujuan_pkl == 'Belum Disetujui') {
                                ?>
                                    <button type="submit" class="btn btn-danger">Belum DiSetujui</button>
                                <?php
                                } else { ?>
                                    <button type="submit" class="btn btn-success">Telah DiSetujui</button>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jamPulang" class="col-sm-2 col-form-label">Persetujuan Pembimbing Sekolah :</label>
                            <div class="col-sm-5">
                                <?php
                                if ($agenda->persetujuan_pembimbing == 'Belum Disetujui') {
                                ?>
                                    <button type="submit" class="btn btn-danger">Belum DiSetujui</button>
                                <?php
                                } else { ?>
                                    <button type="submit" class="btn btn-success">Telah DiSetujui</button>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Modal for Daily Report Edit -->
                        <div class="modal fade" id="dailyReportModal" tabindex="-1" aria-labelledby="dailyReportModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="dailyReportModalLabel" style="color: white">Edit Daily Report</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card p-3">
                                            <form action="<?= base_url('home/aksi_t_agenda') ?>" method="POST">
                                                <div class="form-group mb-3">
                                                    <label for="editTanggalHari">Tanggal Hari:</label>
                                                    <input type="date" class="form-control" id="editTanggalHari" name="tanggal" value="<?= $agenda->tanggal ?>">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="editJamMasuk">Jam Masuk:</label>
                                                    <input type="time" class="form-control" id="editJamMasuk" name="jam_masuk" value="<?= $agenda->jam_masuk ?>">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="editJamPulang">Jam Pulang:</label>
                                                    <input type="time" class="form-control" id="editJamPulang" name="jam_pulang" value="<?= $agenda->jam_pulang ?>">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="rencanaPekerjaan">Rencana Pekerjaan:</label>
                                                    <textarea class="form-control" id="rencanaPekerjaan" rows="3" name="rencana" placeholder="Masukkan rencana pekerjaan"><?= $agenda->rencana ?></textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="realisasiPekerjaan">Realisasi Pekerjaan:</label>
                                                    <textarea class="form-control" id="realisasiPekerjaan" rows="3" name="realisasi" placeholder="Masukkan realisasi pekerjaan"><?= $agenda->realisasi ?></textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="penugasanAtasan">Penugasan dari Atasan:</label>
                                                    <textarea class="form-control" id="penugasanAtasan" rows="3" name="penugasan" placeholder="Masukkan penugasan dari atasan"><?= $agenda->penugasan ?></textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="masalahLapangan">Penemuan Masalah di Lapangan:</label>
                                                    <textarea class="form-control" id="masalahLapangan" rows="3" name="masalah" placeholder="Masukkan penemuan masalah"><?= $agenda->masalah ?></textarea>
                                                </div>

                                                <div class="form-group mb-3">

                                                    <label>Penilaian:</label><br>

                                                    <label for="exampleInputUsername1">Keramahan</label>
                                                    <select class="form-control" name="keramahan[]">
                                                        <option value="<?= $agenda->keramahan ?>"><?= $agenda->keramahan ?></option>
                                                        <option value="Baik">Baik</option>
                                                        <option value="Kurang">Kurang</option>
                                                    </select>

                                                    <label for="exampleInputUsername1">Penampilan</label>
                                                    <select class="form-control" name="penampilan[]">
                                                        <option value="<?= $agenda->penampilan ?>"><?= $agenda->penampilan ?></option>
                                                        <option value="Baik">Baik</option>
                                                        <option value="Kurang">Kurang</option>
                                                    </select>

                                                    <label for="exampleInputUsername1">Senyum</label>
                                                    <select class="form-control" name="senyum[]">
                                                        <option value="<?= $agenda->senyum ?>"><?= $agenda->senyum ?></option>
                                                        <option value="Baik">Baik</option>
                                                        <option value="Kurang">Kurang</option>
                                                    </select>

                                                    <label for="exampleInputUsername1">Komunikasi</label>
                                                    <select class="form-control" name="komunikasi[]">
                                                        <option value="<?= $agenda->komunikasi ?>"><?= $agenda->komunikasi ?></option>
                                                        <option value="Baik">Baik</option>
                                                        <option value="Kurang">Kurang</option>
                                                    </select>

                                                    <label for="exampleInputUsername1">Realisasi Kerja</label>
                                                    <select class="form-control" name="realisasi_kerja[]">
                                                        <option value="<?= $agenda->realisasi_kerja ?>"><?= $agenda->realisasi_kerja ?></option>
                                                        <option value="Baik">Baik</option>
                                                        <option value="Kurang">Kurang</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="catatan">Catatan yang Harus Diingat:</label>
                                                    <textarea class="form-control" id="catatan" rows="3" name="catatan_kerja" placeholder="Masukkan catatan"><?= $agenda->catatan_kerja ?></textarea>
                                                </div>

                                                <label>Kehadiran:</label><br>

                                                <select class="form-control" name="absen[]">
                                                    <option value="<?= $agenda->absen ?>"><?= $agenda->absen ?></option>
                                                    <option value="Hadir">Hadir</option>
                                                    <option value="Sakit">Sakit</option>
                                                    <option value="Izin">Izin</option>
                                                    <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                                                </select>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary" onclick="saveDailyReport()">Simpan</button>
                                                </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Pilih Hari dengan Tombol Panah -->
                        <div class="hari">
                            <input type="hidden" name="hari" id="selectedNumber" value="<?= $selectedDay; ?>">
                            <div>
                                <!-- Tombol Panah Kiri -->
                                <button type="button" class="btn btn-secondary" id="prevDay">←</button>

                                <!-- Dropdown Hari yang lebih kecil di tengah -->
                                <select class="form-control" id="pilihHari" name="hari">
                                    <?php
                                    // Loop untuk menampilkan opsi hari (misal 1-150)
                                    for ($i = 1; $i <= 150; $i++): ?>
                                        <option value="<?= $i ?>" <?= ($i == $selectedDay) ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>

                                <!-- Tombol Panah Kanan -->
                                <button type="button" class="btn btn-secondary" id="nextDay">→</button>
                            </div>
                        </div>

                        </form>
                    </div>


                    <!-- Tab 3 -->
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h6>Absensi Jumat</h6>
                            </div>
                            <br>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div style="overflow-x: auto;">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>KETIDAKHADIRAN</th>
                                                <th>HADIR</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($agenda2 as $key) {
                                            ?>
                                                <tr>
                                                    <td><?= $key->tanggal ?></td>
                                                    <td><?= $key->absen ?></td>
                                                    <td>
                                                        <?php
                                                        if ($key->absen_jumat == 'Hadir') {
                                                        ?>
                                                            <button type="submit" class="btn btn-success">Hadir</button>
                                                        <?php
                                                        } else { ?>
                                                            <button type="submit" class="btn btn-danger">Tidak Hadir</button>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 4 -->
                    <div class="tab-pane fade" id="absen_pt" role="tabpanel" aria-labelledby="absen_pt-tab">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h6>Kehadiran Pada PT</h6>
                            </div>
                            <br>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div style="overflow-x: auto;">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>KETIDAKHADIRAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($agenda3 as $key) {
                                            ?>
                                                <tr>
                                                    <td><?= $key->tanggal ?></td>
                                                    <td><?= $key->absen ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 5 -->
                    <div class="tab-pane fade" id="penilaian" role="tabpanel" aria-labelledby="penilaian-tab">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h6>Table Penilaian</h6>
                            </div>
                            <br>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div style="overflow-x: auto;">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Keramahan</th>
                                                <th>Penampilan</th>
                                                <th>Senyum</th>
                                                <th>Komunikasi</th>
                                                <th>Realisasi Kerja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($agenda3 as $key) {
                                            ?>
                                                <tr>
                                                    <td><?= $key->tanggal ?></td>
                                                    <td><?= $key->keramahan ?></td>
                                                    <td><?= $key->penampilan ?></td>
                                                    <td><?= $key->senyum ?></td>
                                                    <td><?= $key->komunikasi ?></td>
                                                    <td><?= $key->realisasi_kerja ?></td>
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

    <script>
        // Mendapatkan elemen-elemen dari DOM
        const selectHari = document.getElementById('pilihHari');
        const prevDayBtn = document.getElementById('prevDay');
        const nextDayBtn = document.getElementById('nextDay');

        // Fungsi untuk mengarahkan ke URL dengan parameter 'hari' yang diperbarui
        function updateURL(hari) {
            window.location.href = '<?= base_url('home/agenda') ?>?hari=' + hari;
        }

        // Event listener untuk tombol "Previous Day"
        prevDayBtn.addEventListener('click', function() {
            let currentHari = parseInt(selectHari.value); // Dapatkan nilai hari yang dipilih
            if (currentHari > 1) {
                currentHari -= 1; // Kurangi hari
                updateURL(currentHari); // Perbarui URL
            }
        });

        // Event listener untuk tombol "Next Day"
        nextDayBtn.addEventListener('click', function() {
            let currentHari = parseInt(selectHari.value); // Dapatkan nilai hari yang dipilih
            if (currentHari < 150) { // Sesuaikan batas hari (misal maksimal 150)
                currentHari += 1; // Tambah hari
                updateURL(currentHari); // Perbarui URL
            }
        });

        // Event listener untuk dropdown
        selectHari.addEventListener('change', function() {
            let selectedHari = selectHari.value; // Dapatkan nilai hari yang dipilih
            updateURL(selectedHari); // Perbarui URL
        });
    </script>