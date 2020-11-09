<!-- Call Member Class -->
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/ci3-btc/application/controllers/Member.php';

?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold">Anggota Club Tennis Badung</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
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
                        <?php foreach ($members as $i => $m) : ?>
                            <tr>
                                <!-- Nomor -->
                                <td><?= ++$i ?></td>
                                <td>
                                    <img width="30" src="<?= base_url('resources/img/profile/' . $m['image']) ?>" alt="Profile">
                                </td>
                                <!-- Nama -->
                                <td><?= $m['name'] ?></td>
                                <!-- Alamat -->
                                <td><?= $m['address'] ?></td>
                                <!-- Nomor Telepon -->
                                <td><?= $m['phone'] ?></td>
                                <!-- Usia -->
                                <td><?= Member::age($m['birth_date']) ?></td>
                                <!-- Status -->
                                <td><?= Member::status($m['id']) ?></td>
                                <!-- Option -->
                                <td>
                                    <a class="btn btn-primary btn-sm" href="">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->