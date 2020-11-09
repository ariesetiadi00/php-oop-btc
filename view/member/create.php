<!-- Require Header -->
<?php
require_once '../layout/header.php';
require_once '../../init.php';
?>

<!-- Create form -->
<div class="container-fluid w-75">

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
                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th>Deskripsi</th>
                                    <th>Bulan</th>
                                    <th>Action</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Require Footer -->
<?php require_once '../layout/footer.php'; ?>