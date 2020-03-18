<body class="bg-gradient-white">

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 flex-row align-items-center justify-content-between">
                        <a href="<?= base_url('user') ?>" class="btn btn-sm btn-primary float-left">Back</a>
                        <h6 class="m-0 font-weight-bold align-middle text-primary text-center">Log Scan In</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="history" class="table table-hover table-striped table-bordered" width="100%" style="font-size: 12px;">
                                <thead class="text-center">
                                    <tr>
                                        <th rowspan="2" class="align-middle">NO</th>
                                        <th rowspan="2" class="align-middle">NIK</th>
                                        <th rowspan="2" class="align-middle">NAMA</th>
                                        <th colspan="4">JAI LABEL</th>
                                        <th colspan="3">JAI QR</th>
                                        <th rowspan="2" class="align-middle">STATUS</th>
                                    </tr>
                                    <tr>
                                        <th>LABEL</th>
                                        <th>ASSY CODE</th>
                                        <th>CARTON 1</th>
                                        <th>CARTON 2</th>
                                        <th>LABEL</th>
                                        <th>ASSY CODE</th>
                                        <th>CARTON</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($history_in as $key) { ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $key->nik ?></td>
                                            <td><?= $key->nama ?></td>
                                            <td><?= $key->jai_label ?></td>
                                            <td><?= $key->assy_code_label ?></td>
                                            <td class="text-center"><?= $key->ctn_no1 ?></td>
                                            <td class="text-center"><?= $key->ctn_no2 ?></td>
                                            <td><?= $key->jai_qr ?></td>
                                            <td><?= $key->assy_code_qr ?></td>
                                            <td class="text-center"><?= $key->ctn_no_qr ?></td>
                                            <td class="text-center"><?= $key->status ?></td>
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
        $("#history").dataTable();
    })
</script>