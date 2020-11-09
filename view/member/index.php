<!-- Require Header -->
<?php
require_once '../layout/header.php';
require_once '../../init.php';
?>

<!-- Start Body -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-1 pt-2">
            <div class="row">
                <div class="col-9">
                    <h5 class="text-secondary">Anggota</h5>
                </div>
                <div class="col-3 my-auto d-flex justify-content-end">
                    <a class="btn btn-sm btn-primary d-flex mr-2" href="create.php">
                        <i class="fas fa-user-plus"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Usia</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($member_model->get_all() as $i => $m) : ?>
                            <tr>
                                <!-- No -->
                                <td><?= ++$i ?></td>
                                <!-- Profile -->
                                <td><img width="30" src="<?= URL ?>/resource/img/profile/<?= $m['image'] ?>" alt="Profile"></td>
                                <!-- Nama -->
                                <td><?= $m['name'] ?></td>
                                <!-- Alamat -->
                                <td><?= $m['address'] ?></td>
                                <!-- Telepon -->
                                <td><?= $m['phone'] ?></td>
                                <!-- Usia -->
                                <td><?= $member_model->age($m['birth_date']) ?></td>
                                <!-- Status -->
                                <?php if ($member_model->status($m['id'])) : ?>
                                    <td>
                                        <button class="btn btn-sm btn-primary"><?= $date->format('F') ?></button>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <button class="btn btn-sm btn-secondary"><?= $date->format('F') ?></button>
                                    </td>
                                <?php endif; ?>

                                <!-- Option -->
                                <td>
                                    <a class="btn btn-sm btn-block" href="<?= URL ?>/view/member/detail.php?id=<?= $m['id'] ?>">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- End Body -->

<!-- Require Footer -->
<?php require_once '../layout/footer.php'; ?>