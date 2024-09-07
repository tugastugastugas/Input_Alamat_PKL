<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($setting) ? $setting->nama_website : 'Update Setting' ?></title>
    <!-- Sertakan CSS dan JavaScript di sini -->
</head>

<body>

    <div class="container-fluid py-4" style="margin-top: 60px;">
        <div class="row">
            <div class="col-6">
                <div class="card mb-4" style="padding: 20px;">
                    <form action="<?= base_url('home/aksi_e_setting') ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= isset($setting) ? $setting->id_setting : '' ?>">
                        <div class="form-group">
                            <label for="siteName">Nama Website</label>
                            <input type="text" class="form-control" id="siteName" name="namawebsite" placeholder="Masukkan Nama Website" value="<?= isset($setting) ? $setting->nama_website : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="favicon">Upload Favicon</label>
                            <input type="file" id="img" name="img" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="favicon">Logo Website</label>
                            <input type="file" id="logo" name="logo" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>