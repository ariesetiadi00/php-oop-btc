<!-- Require Header -->
<?php
require_once '../../init.php';
$_SESSION['title'] = "BTC - New Member";
require_once '../layout/header.php';
?>

<!-- Create form -->
<div class="container-fluid w-50">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-9">
                    <h5 class="text-secondary">Tambah Member Baru</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="container">
                    <!-- BODy -->
                    <div class="row">
                        <div class="col">
                            <form action="<?= URL ?>/controller/create.php" method="POST">

                                <!-- Nama lengkap -->
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap" required>
                                </div>

                                <!-- Nama lengkap -->
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                                </div>

                                <!-- Kelahiran -->
                                <label for="tmp_lahir">Kelahiran</label>
                                <div class="row">
                                    <div class="col-5">
                                        <!--Tempat lahir -->
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" placeholder="Tempat lahir" required>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <!--Tanggal lahir -->
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal lahir" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Religion -->
                                <div class="form-group">
                                    <label for="">Agama</label>
                                    <select id="agama" name="agama" class="custom-select" required>
                                        <option selected hidden>Pilih agama</option>
                                        <?php foreach ($member_model->get_religion() as $r) : ?>
                                            <option value="<?= $r['religion'] ?>">Agama <?= $r['religion'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>


                                <!-- Gender -->
                                <div class="form-group">
                                    <label class="d-block">Jenis Kelamin</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="pria" name="gender" class="custom-control-input" value="m" required>
                                        <label class="custom-control-label" for="pria">Pria</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="wanita" name="gender" class="custom-control-input" value="f" required>
                                        <label class="custom-control-label" for="wanita">Wanita</label>
                                    </div>
                                </div>

                                <!-- Teleponn -->
                                <div class="form-group">
                                    <label for="telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Nomor telepon" required>
                                </div>

                                <hr>

                                <button type="reset" class="btn btn-block btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-block btn-primary">Tambah</button>

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