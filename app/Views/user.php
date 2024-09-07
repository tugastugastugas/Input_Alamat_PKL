<div class="container-fluid py-4" style="margin-top: 60px;">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 20px;">
                <div class="col-6">
                    <a class="btn bg-gradient-dark mb-0" href="<?= base_url('home/t_user') ?>"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add New User</a>
                    <a class="btn bg-gradient-dark mb-0" href="<?= base_url('home/t_murid') ?>"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Tambah Murid</a>
                </div>
                <br>
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($yoga as $key) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $key->username ?></td>
                                <td><?= $key->level ?></td>

                                <td>
                                    <a href="<?= base_url('home/detail_user/' . $key->id_user) ?>">
                                        <button class="btn btn-danger">
                                            <i class="now-ui-icons ui-1_check"></i> Detail
                                        </button>
                                    </a>
                                    <a href="<?= base_url('home/hapus_user/' . $key->id_user) ?>">
                                        <button class="btn btn-danger">
                                            <i class="now-ui-icons ui-1_check"></i> Delete
                                        </button>
                                    </a>
                                <td>
                                    <a href="<?= base_url('home/resetpassword/' . $key->id_user) ?>" onclick="return confirm('Apakah Anda yakin ingin mereset password?');">
                                        <button class="btn btn-danger">
                                            <i class="now-ui-icons ui-1_check"></i> Reset Password
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