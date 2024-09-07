<div class="container-fluid py-4" style="margin-top: 60px;">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 20px;">
                <h4 class="card-title">Tambah User</h4>

                <form action="<?= base_url('home/aksi_t_user2') ?>" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama User</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" name="password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">Level</label>
                        <select class="form-control" name="level">
                            <!-- Loop through the $level array to create other options -->
                            <?php foreach ($yoga as $item): ?>
                                <option value="<?= $item ?>"><?= $item ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>