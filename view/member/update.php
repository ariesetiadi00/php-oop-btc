<!-- Require Header -->
<?php
require_once '../../init.php';
$_SESSION['title'] = "BTC - Update Member";
require_once '../layout/header.php';

// Ambil data satu member berdasarkan ID
$member = $member_model->get($_GET['id']);
$gender = $member_model->get_gender();
?>



<!-- Create form -->
<div class="container-fluid w-50">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-9">
                    <h5 class="text-secondary">Ubah Data Member</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="container">
                    <!-- BODy -->
                    <div class="row">
                        <div class="col">
                            <form action="<?= URL ?>/controller/update.php" method="POST">
                                <!-- Kirim ID untuk update -->
                                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">

                                <!-- Nama lengkap -->
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap" required value="<?= $member['name'] ?>">
                                </div>

                                <!-- Nama lengkap -->
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required value="<?= $member['address'] ?>">
                                </div>

                                <!-- Kelahiran -->
                                <label for="tmp_lahir">Kelahiran</label>
                                <div class="row">
                                    <div class="col-5">
                                        <!--Tempat lahir -->
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" placeholder="Tempat lahir" required value="<?= $member['birth_place'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <!--Tanggal lahir -->
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal lahir" required value="<?= $member['birth_date'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <!-- Religion -->
                                <div class="form-group">
                                    <label for="">Agama</label>
                                    <select id="agama" name="agama" class="custom-select" required>
                                        <option selected hidden>Pilih agama</option>
                                        <?php foreach ($member_model->get_religion() as $r) : ?>

                                            <?php if ($r['religion'] == $member['religion']) : ?>
                                                <option selected value="<?= $r['religion'] ?>">Agama <?= $r['religion'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $r['religion'] ?>">Agama <?= $r['religion'] ?></option>
                                            <?php endif; ?>


                                        <?php endforeach ?>
                                    </select>
                                </div>


                                <!-- Gender -->
                                <div class="form-group">
                                    <label class="d-block">Jenis Kelamin</label>
                                    <?php foreach ($gender as $g) : ?>
                                        <?php if ($g['value'] == $member['gender']) : ?>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="<?= $g['gender'] ?>" name="gender" class="custom-control-input" value="<?= $g['value'] ?>" checked>
                                                <label class="custom-control-label" for="<?= $g['gender'] ?>"><?= $g['gender'] ?></label>
                                            </div>
                                        <?php else : ?>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="<?= $g['gender'] ?>" name="gender" class="custom-control-input" value="<?= $g['value'] ?>">
                                                <label class="custom-control-label" for="<?= $g['gender'] ?>"><?= $g['gender'] ?></label>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <!-- <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="pria" name="gender" class="custom-control-input" value="m" required>
                                        <label class="custom-control-label" for="pria">Pria</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="wanita" name="gender" class="custom-control-input" value="f" required>
                                        <label class="custom-control-label" for="wanita">Wanita</label>
                                    </div> -->

                                </div>

                                <!-- Teleponn -->
                                <div class="form-group">
                                    <label for="telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Nomor telepon" value="<?= $member['phone'] ?>" required>
                                </div>

                                <hr>

                                <button type="reset" class="btn btn-block btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-block btn-primary">Ubah</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Require Footer -->
<?php require_once '../layout/footer.php'; ?>