<div class="container-fluid py-4" style="margin-top: 60px;">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 20px;">
                <div class=" card-header pb-0">
                    <h6>Pengaturan Hak Akses</h6>
                </div>
                <form action="<?= base_url('home/update_hak_akses/' . $level) ?>" method="post">
                    <label>
                        <input type="checkbox" name="permissions[]" value="dashboard"
                            <?= in_array('dashboard', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                        Dashboard
                    </label>
                    <br>
                    <label>
                        <input type="checkbox" name="permissions[]" value="data"
                            <?= in_array('data', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                        Data PKL
                    </label>
                    <br>
                    <label>
                        <input type="checkbox" name="permissions[]" value="input_alamat"
                            <?= in_array('input_alamat', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                        Input Alamat PKL
                    </label>
                    <br>
                    <label>
                        <input type="checkbox" name="permissions[]" value="user"
                            <?= in_array('user', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                        User
                    </label>
                    <br>
                    <label>
                        <input type="checkbox" name="permissions[]" value="setting"
                            <?= in_array('setting', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                        Setting
                    </label>
                    <br>
                    <label>
                        <input type="checkbox" name="permissions[]" value="log_activity"
                            <?= in_array('log_activity', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                        Log Activity
                    </label>
                    <br>
                    <label>
                        <input type="checkbox" name="permissions[]" value="restore_data"
                            <?= in_array('restore_data', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                        Restore Data
                    </label>
                    <br>
                    <label>
                        <input type="checkbox" name="permissions[]" value="level"
                            <?= in_array('level', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                        Permission
                    </label>
                    <br>
                    <label>
                        <input type="checkbox" name="permissions[]" value="restore_edit"
                            <?= in_array('restore_edit', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                        Restore Edit
                    </label>
                    <br>
                    <button type="submit" class="btn btn-primary">Simpan Hak Akses</button>
                </form>


            </div>
        </div>

    </div>
</div>
</div>
</div>
</div>