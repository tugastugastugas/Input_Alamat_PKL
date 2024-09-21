<div class="container-fluid py-4" style="margin-top: 60px;">
    <!-- Form dimulai di sini, hanya satu form -->
    <form method="POST" action="<?= base_url('home/updatePembimbing_pkl') ?>">

        <!-- Input hidden untuk mengirim ID guru hanya satu kali -->
        <input type="hidden" name="guru_id" id="guru_id" value="">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4" style="padding: 20px;">
                    <div class="card-header pb-0">
                        <h6>Daftar Murid PKL</h6>
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
                                        <th></th>
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
                                                <a href="<?= base_url('home/agenda_murid/' . $key->murid_id_user . '?hari=' . ($selectedDay ?? 1)) ?>">
                                                    <button type="button" class="btn btn-primary mb-3">
                                                        Lihat Agenda
                                                    </button>
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
</form>