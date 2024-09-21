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
                        <!-- Tombol untuk menampilkan modal -->
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#dailyReportModal">
                            Pilih Murid
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
                                            <td>
                                                <a href="<?= base_url('home/hapusPembimbing_pkl/' . $key->murid_id_user) ?>">
                                                    <button type="button" class="btn btn-danger mb-3">
                                                        Hapus Murid
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

<!-- Modal for Daily Report Edit -->
<div class="modal fade" id="dailyReportModal" tabindex="-1" aria-labelledby="dailyReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="dailyReportModalLabel" style="color: white">Daftar Murid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card p-3">
                    <!-- Search Box -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" id="searchName" class="form-control" placeholder="Cari Nama Murid">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="searchNIS" class="form-control" placeholder="Cari NIS">
                        </div>
                    </div>

                    <!-- Tabel Murid -->
                    <table class="table align-items-center mb-0" id="muridTable">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>NIS</th>
                                <th>Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($murid as $key) { ?>
                                <tr>
                                    <td class="murid-name"><?= $key->murid_name ?></td>
                                    <td><?= $key->jurusan ?></td>
                                    <td class="murid-nis"><?= $key->nis ?></td>
                                    <td>
                                        <input type="checkbox" name="approval[]" value="<?= $key->murid_id_user ?>">
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Pilih Murid</button>
            </div>
        </div>
    </div>
</div>
</form>

<!-- JavaScript for searching -->
<script>
    // Function to filter table rows based on search input
    function filterTable() {
        var inputName = document.getElementById('searchName').value.toLowerCase();
        var inputNIS = document.getElementById('searchNIS').value.toLowerCase();
        var table = document.getElementById('muridTable');
        var tr = table.getElementsByTagName('tr');

        for (var i = 1; i < tr.length; i++) { // Skip header row (index 0)
            var tdName = tr[i].getElementsByClassName('murid-name')[0];
            var tdNIS = tr[i].getElementsByClassName('murid-nis')[0];

            if (tdName && tdNIS) {
                var nameValue = tdName.textContent.toLowerCase();
                var nisValue = tdNIS.textContent.toLowerCase();

                if (nameValue.includes(inputName) && nisValue.includes(inputNIS)) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    }

    // Add event listeners to search fields
    document.getElementById('searchName').addEventListener('keyup', filterTable);
    document.getElementById('searchNIS').addEventListener('keyup', filterTable);
</script>