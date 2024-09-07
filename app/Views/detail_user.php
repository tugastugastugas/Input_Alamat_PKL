<div class="container-fluid py-4" style="margin-top: 60px;">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 20px;">
                <h4 class="card-title">Detail User</h4>

                <form action="<?= base_url('home/aksi_e_user') ?>" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama User</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="username" value="<?= $dua->username ?>">
                    </div>

                    <?php
                    if ($level = $dua->level === 'Murid') {
                    ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIS</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="nis" value="<?= $dua->nis ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kelas</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="kelas" value="<?= $dua->kelas ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jurusan</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="jurusan" value="<?= $dua->jurusan ?>">
                        </div>
                    <?php } else {
                    } ?>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Level</label>
                        <select class="form-control" name="level">
                            <!-- Option for the current level -->
                            <option value="<?= $dua->level ?>" selected><?= $dua->level ?></option>
                            <!-- Loop through the $level array to create other options -->
                            <?php foreach ($yoga as $item): ?>
                                <option value="<?= $item ?>"><?= $item ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?= $dua->id_user ?>">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>