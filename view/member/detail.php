<!-- Require Header -->
<?php
require_once '../layout/header.php';
require_once '../../init.php';


// Get member detail from database
$member_detail = $member_model->get($_GET['id']);

// Cek debt
$payment_model->debt($member_model->status($member_detail['id']), $member_detail['id']);
?>

<!-- Body -->

<!-- Detail -->
<div class="container-fluid w-75">

    <!-- Alert payment -->
    <div class="row">
        <div class="col">
            <?php if (isset($_SESSION['message'])) : ?>
                <div class="alert alert-primary" role="alert">
                    <?= $_SESSION['message'] ?>
                </div>
            <?php
                unset($_SESSION['message']);
            endif;
            ?>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-1 pt-2">
            <div class="row">
                <div class="col-9">
                    <h5 class="text-secondary">Detail</h5>
                </div>
                <div class="col-3 my-auto d-flex justify-content-end">
                    <a class="btn btn-sm btn-primary d-flex mr-2" href="">
                        <i class="fas fa-pen"></i>
                    </a>
                    <a class="btn btn-sm d-flex btn-danger" href="">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="container">
                    <!-- image profile -->
                    <div class="row">
                        <div class="col">
                            <img width="300" class="d-block mx-auto" src="<?= URL ?>/resource/img/profile/<?= $member_detail['image'] ?>" alt="Profile">
                        </div>
                    </div>

                    <!-- Detail -->
                    <div class="row mt-4">
                        <div class="col">
                            <table class="table mx-auto">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><?= $member_detail['name'] ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><?= $member_detail['address'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tempat Tanggal Lahir</td>
                                    <td>:</td>
                                    <td><?= $member_detail['birth_place'] ?>, <?= $member_model->parse_date($member_detail['birth_date']) ?></td>
                                </tr>
                                <tr>
                                    <td>Usia</td>
                                    <td>:</td>
                                    <td><?= $member_model->age($member_detail['birth_date']) ?> Tahun</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td><?= $member_model->gender($member_detail['gender']) ?></td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>:</td>
                                    <td><?= $member_detail['phone'] ?></td>
                                </tr>
                                <tr>
                                    <td>Bergabung pada</td>
                                    <td>:</td>
                                    <td><?= $member_model->parse_date($member_detail['created_at']) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Option -->
                    <div class="row">
                        <div class="col">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Debt -->
<div class="container-fluid w-75">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-9">
                    <h5 class="text-secondary">Daftar Tunggakan</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="container">
                    <!-- BODy -->
                    <div class="row">
                        <div class="col">
                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th>Deskripsi</th>
                                    <th>Bulan</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                                <?php foreach ($payment_model->get_debt($member_detail['id']) as $i => $d) : ?>
                                    <tr>
                                        <td><?= ++$i ?></td>
                                        <td>Pembayaran Bulanan</td>
                                        <td><?= $member_model->month($d['month']) ?></td>
                                        <td>Rp. <?= number_format($price) ?></td>
                                        <td>
                                            <?php if ($member_model->status_pay($member_detail['id'], $d['month'])) : ?>
                                                <button class="btn btn-primary btn-block btn-sm" disabled>Bayar</button>
                                            <?php else : ?>
                                                <button id="btnBayar" type="button" class="btn btn-primary btn-block btn-sm btnBayar" data-toggle="modal" data-target="#payModal" data-bulan="<?= $d['month'] ?>">Bayar</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Payment History -->
<div class="container-fluid w-75">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-9">
                    <h5 class="text-secondary">Riwayat Pembayaran</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="container">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>ID Pembayaran</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Jumlah</th>
                        </tr>
                        <?php foreach ($payment_model->get($member_detail['id']) as $i => $h) : ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= $id_pay . $h['id'] ?></td>
                                <td>Pembayaran <?= $member_model->month($h['month']) ?></td>
                                <td><?= $member_model->parse_date($h['created_at']) ?></td>
                                <td>Rp. <?= number_format($h['amount']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payModalLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= URL ?>/controller/pay.php" method="POST">
                <div class="modal-body">

                    <!-- Detail PAyment -->
                    <h6>Detail Pembayaran</h6>
                    <table class="table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $member_detail['name'] ?></td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>:</td>
                            <td id="month">Bulan</td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>:</td>
                            <td>Rp. <?= number_format($price) ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Pembayaran</td>
                            <td>:</td>
                            <td><?= date('j  F  Y') ?></td>
                        </tr>
                    </table>

                    <!-- HIdden ID -->
                    <input type="hidden" name="id" value="<?= $member_detail['id'] ?>">
                    <!-- Bulan -->
                    <input type="hidden" id="bulan" name="bulan" value="">
                    <!-- Tanggal -->
                    <input type="hidden" name="tanggal" value="<?= date('Y-m-d H:i:s') ?>">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- End Body -->

<!-- Require Footer -->
<?php require_once '../layout/footer.php'; ?>