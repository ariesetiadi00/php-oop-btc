<?php
require_once '../../init.php';
$_SESSION['title'] = "BTC - Dashboard";
require_once '../layout/header.php';
?>

<!-- Alert -->
<?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-primary" role="alert">
        <?= $_SESSION['message'] ?>
    </div>
<?php
    unset($_SESSION['message']);
endif;
?>

<!-- Start Body -->
<table class="table">
    <tr>
        <th>
            <i class="fas fa-money-check-alt"></i>
            Harga (Rp)
        </th>
        <th>
            <i class="fas fa-users"></i>
            Jumlah Member
        </th>
        <th>
            <i class="fas fa-venus"></i>
            Member Wanita
        </th>
        <th>
            <i class="fas fa-mars"></i>
            Member Pria
        </th>
    </tr>
    <tr>
        <td>
            <button type="button" class="btn" data-toggle="modal" data-target="#priceModal">
                <h2><?= number_format($price, 0) ?></h2>
            </button>
        </td>
        <td>
            <button id="total-button" type="button" class="btn">
                <h2><?= count($member[0])  ?></h2>
            </button>
        </td>
        <td>
            <button id="female-button" type="button" class="btn">
                <h2><?= count($member[1]) ?></h2>
            </button>
        </td>
        <td>
            <button id="male-button" type="button" class="btn">
                <h2><?= count($member[2]) ?></h2>
            </button>
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>

<div class=" text-center mb-3">
    <i class="fas fa-list-alt"></i>
    Riwayat Pembayaran
</div>

<table class="table">
    <?php if ($payment) : ?>
        <tr>
            <th>#</th>
            <th>ID Pembayaran</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Bulan</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
        </tr>
        <?php foreach ($payment as $i => $p) : ?>
            <tr>
                <td><?= ++$i ?></td>
                <td><?= $id_pay . $p['id'] ?></td>
                <td><img width="30" class="rounded-circle" src="/btc-pay/resource/img/profile/<?= $p['image'] ?>" alt="Profile"></td>
                <td><?= $p['name'] ?></td>
                <td><?= $member_model->month($p['month']) ?></td>
                <td><?= $member_model->parse_date($p['created_at']) ?></td>
                <td>Rp. <?= number_format($p['amount'], 0) ?>
                <td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <hr>
        <h5 class="text-center text-secondary">Tidak Ada Riwayat Pembayaran</h5>
        <hr>
    <?php endif; ?>
</table>
<!-- End Body -->

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="priceModal" tabindex="-1" aria-labelledby="priceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= URL ?>/controller/price.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="priceModalLabel">Ubah Harga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control" type="number" name="harga" placeholder="Masukan Harga Terbaru">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Require Footer -->
<?php require_once '../layout/footer.php'; ?>