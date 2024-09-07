<div class="container-fluid py-4" style="margin-top: 60px;">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 20px;">
                <h4 class="card-title">Tambah User</h4>

                <form action="<?= base_url('home/aksi_t_murid') ?>" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama User</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">NIS</label>
                        <input type="nis" class="form-control" id="exampleInputEmail1" name="nis">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kelas</label>
                        <input type="kelas" class="form-control" id="exampleInputEmail1" name="kelas">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jurusan</label>
                        <input type="jurusan" class="form-control" id="exampleInputEmail1" name="jurusan">
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