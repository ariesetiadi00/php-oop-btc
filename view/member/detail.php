<!-- Require Header -->
<?php
require_once '../../init.php';
$_SESSION['title'] = "BTC - Detail";
require_once '../layout/header.php';


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
                    <a class="btn btn-sm btn-primary d-flex mr-2" href="update.php?id=<?= $member_detail['id'] ?>">
                        <i class="fas fa-pen"></i>
                    </a>
                    <button class="btn btn-sm d-flex btn-danger" data-toggle="modal" data-target="#deleteModal">
                        <i class="fas fa-trash-alt"></i>
                    </button>
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
                            <table class="table w-75 mx-auto">
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
                                <?php if ($payment_model->get_debt($member_detail['id'])) : ?>
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
                                                <button id="btnBayar" type="button" class="btn btn-primary btn-block btn-sm btnBayar" data-toggle="modal" data-target="#payModal" data-bulan="<?= $d['month'] ?>">Bayar</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <hr>
                                    <h5 class="text-center text-secondary">Tidak Ada Tunggakan</h5>
                                    <hr>
                                <?php endif ?>
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
                        <?php if ($payment_model->get($member_detail['id'])) : ?>
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
                        <?php else : ?>
                            <h5 class="text-center text-secondary">Tidak Ada Riwayat Pembayaran</h5>
                        <?php endif; ?>
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

                    <!-- Detail Payment -->
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
                    <!-- HIdden Image -->
                    <input type="hidden" name="image" value="<?= $member_detail['image'] ?>">
                    <!-- HIdden Name -->
                    <input type="hidden" name="name" value="<?= $member_detail['name'] ?>">
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


<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= URL ?>/controller/delete.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus <strong><?= $member_detail['name'] ?></strong> ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- hidden ID untuk menghapus data member -->
                    <input type="hidden" name="id" value="<?= $member_detail['id'] ?>">
                    <!-- Checkbox hapus pembayaran -->
                    <div class="form-group form-check">
                        <input type="checkbox" name="delete_payment" class="form-check-input" id="delete_payment">
                        <label class="form-check-label" for="delete_payment">Hapus Semua Riwayat Pembayaran</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Body -->

<!-- Require Footer -->
<?php require_once '../layout/footer.php'; ?>