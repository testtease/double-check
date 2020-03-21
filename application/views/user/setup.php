<style>
    @-webkit-keyframes fadeOut {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }

    .fadeOut {
        -webkit-animation-name: fadeOut;
        animation-name: fadeOut;
    }
</style>

<body class="bg-gradient-white">

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold align-middle text-primary text-center">Setup User <a href="<?= base_url('user/add_user') ?>" class="btn btn-sm btn-primary float-right">Tambah User</a></h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="alert alert-success" role="alert" style="display: none"> User Berhasil Terdaftar!</div>
                        <div class="table-responsive">
                            <table id="tableUser" class="table table-hover table-bordered" width="100%" style="font-size: 12px;">
                                <thead class="text-center">
                                    <tr>
                                        <th>NO</th>
                                        <th>USERNAME</th>
                                        <th>EMAIL</th>
                                        <th>NIK</th>
                                        <th>SECTION</th>
                                        <th>LEVEL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($mst_user as $key) { ?>
                                        <tr>
                                            <td class="text-center"><?= $no ?></td>
                                            <td><?= $key->username ?></td>
                                            <td><?= $key->email ?></td>
                                            <td><?= $key->nik ?></td>
                                            <td><?= $key->section ?></td>
                                            <td><?= $key->level ?></td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    $(document).ready(function() {
        <?= $this->session->flashdata('message') ?>
        $("#tableUser").dataTable();
    })
</script>