<div class="container-fluid py-4" style="margin-top: 60px;">
    <!-- Form dimulai di sini, hanya satu form -->
    <form method="POST" action="<?= base_url('home/updatePembimbing') ?>">

        <!-- Input hidden untuk mengirim ID guru hanya satu kali -->
        <input type="hidden" name="guru_id" id="guru_id" value="">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4" style="padding: 20px;">
                    <div class="card-header pb-0">
                        <h6>Persetujuan</h6>
                        <!-- Tombol untuk menampilkan modal -->
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#dailyReportModal">
                            Pilih Pembimbing
                        </button>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div style="overflow-x: auto;">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Lokasi</th>
                                        <th>Nama PT</th>
                                        <th>Nama Pembimbing</th>
                                        <th>Pilih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $key) { ?>
                                        <tr>
                                            <td><?= $key->murid_name ?><br>
                                                <p style="font-size: 12px;"><?= $key->nis ?></p>
                                            </td>
                                            <td><?= $key->kelas ?></td>
                                            <td><?= $key->jurusan ?></td>
                                            <td><?= $key->address ?></td>
                                            <td><?= $key->nama_pt ?></td>
                                            <td><?= $key->pembimbing_name ?></td>
                                            <td>
                                                <input type="checkbox" name="approval[]" value="<?= $key->murid_id_user ?>">
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

<!-- Modal for Daily Report Edit -->
<div class="modal fade" id="dailyReportModal" tabindex="-1" aria-labelledby="dailyReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="dailyReportModalLabel" style="color: white">Pilih Pembimbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card p-3">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($guru as $key) { ?>
                                <tr>
                                    <td><?= $key->username ?></td>
                                    <td><?= $key->jurusan ?></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary" onclick="setGuruId(<?= $key->id_user ?>)">Pilih Sebagai Pembimbing</button>
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
</form>

<script>
    function setGuruId(guruId) {
        document.getElementById('guru_id').value = guruId;
    }
</script>