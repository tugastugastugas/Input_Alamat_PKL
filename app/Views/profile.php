<div class="container-fluid py-4" style="margin-top: 60px;">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 20px;">
                <div class="card-header pb-0">
                    <h6>Profile</h6>
                </div>
                <div class="row mt-5 align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <?php
                        $foto_profil = ($darren->foto) ? base_url('img/' . $darren->foto) : base_url('img/user.png');
                        ?>
                        <img src="<?= $foto_profil ?>" class="rounded-circle" style="width: 200px; height: 200px;" alt="Foto Profile"><br><br>
                        <form action="<?= base_url('home/editfoto') ?>" method="post" enctype="multipart/form-data">
                            <label for="foto" class="btn btn-primary px-3">Pilih Foto Profil Baru</label><br>
                            <input class="file-input" type="file" id="foto" name="foto" accept="image/*" style="display: none;">
                            <span id="file-name"></span>
                            <br>
                            <button id="saveButton" class="btn btn-primary px-3" style="height: 40px; display: none;">Save</button>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <form action="<?= base_url('home/aksi_e_profile') ?>" method="POST">
                            <input type="hidden" name="id" value="<?= $darren->id_user ?>">
                            <div class="form-row">
                                <div class="form-group col-md-6 offset-md-4">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" class="form-control" name="username" value="<?= esc($darren->username) ?>">
                                </div>
                                <?php
                                if (session()->get('level') == 'Murid') {
                                ?>
                                    <div class="form-group col-md-6 offset-md-4">
                                        <label for="nis">NIS</label>
                                        <input type="text" id="nis" class="form-control" name="nis" value="<?= esc($darren->nis) ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-6 offset-md-4">
                                        <label for="kelas">Kelas</label>
                                        <input type="text" id="kelas" class="form-control" name="kelas" value="<?= esc($darren->kelas) ?>">
                                    </div>
                                    <div class="form-group col-md-6 offset-md-4">
                                        <label for="jurusan">Jurusan</label>
                                        <input type="text" id="jurusan" class="form-control" name="jurusan" value="<?= esc($darren->jurusan) ?>">
                                    </div>
                                <?php } else {
                                } ?>
                                <div class="form-group col-md-6 offset-md-4">
                                    <label for="level">Level</label>
                                    <input type="text" id="level" class="form-control" value="<?= esc($darren->level) ?>" readonly>
                                </div>
                                <div class="form-group col-md-12 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                        <div class="form-group col-md-12 offset-md-4 mt-4">
                            <a href="<?= base_url('home/changepassword') ?>" class="btn btn-sm btn-primary">
                                Change Password
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Script untuk menampilkan nama file yang di-upload
    document.getElementById('foto').onchange = function() {
        var fileName = this.value.split('\\').pop();
        document.getElementById('file-name').innerText = 'File : ' + fileName;
        document.getElementById('saveButton').style.display = 'inline-block';
    };

    // Script untuk toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleButton.innerHTML = '<i class="mdi mdi-eye-off"></i>'; // Ubah ikon mata jika password terlihat
        } else {
            passwordField.type = 'password';
            toggleButton.innerHTML = '<i class="mdi mdi-eye"></i>'; // Ubah ikon mata jika password tersembunyi
        }
    });
</script>