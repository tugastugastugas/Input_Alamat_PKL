<div class="container-fluid py-4" style="margin-top: 60px;">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 20px;">
                <div class="card-header pb-0">
                    <h6>Log Activity</h6>
                </div>
                <!-- Form Filter -->
                <form action="<?= base_url('ActivityLogController/filterActivities') ?>" method="get">
                    <div class="form-group">
                        <label for="user_filter">Filter by User</label>
                        <select class="form-control" name="user_filter" id="user_filter">
                            <option value="">-- Select User --</option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user['id_user'] ?>" <?= (isset($_GET['user_filter']) && $_GET['user_filter'] == $user['id_user']) ? 'selected' : '' ?>>
                                    <?= $user['id_user'] ?> / <?= $user['username'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" name="id_user" value="<?= $currentUserId ?>" />
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
                <br>
                <a href="<?= base_url('home/hapus_aktivitas') ?>">
                    <button class="btn btn-danger">
                        <i class="now-ui-icons ui-1_check"></i> Delete
                    </button>
                </a>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID User</th>
                                <th>Menu</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($activities as $activity): ?>
                                <tr>
                                    <td><?= $activity->id_user ?></td>
                                    <td><?= $activity->menu ?></td>
                                    <td><?= $activity->created_at ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>