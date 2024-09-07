    <div class="container-fluid py-4" style="margin-top: 60px;">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4" style="padding: 20px;">
                    <div class=" card-header pb-0">
                        <h6>Restore Data</h6>
                    </div>
                    <br>
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $key) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $key->username ?></td>
                                    <td><?= $key->address ?></td>
                                    <td>
                                        <a href="<?= base_url('home/restore/' . $key->id) ?>">
                                            <button class="btn btn-primary btn-sm">Restore</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <br>



                </div>
            </div>
        </div>
    </div>
    </div>