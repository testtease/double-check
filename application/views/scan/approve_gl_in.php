<body class="bg-gradient-white">

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 flex-row align-items-center justify-content-between">
                        <a href="<?= base_url('user') ?>" class="btn btn-sm btn-primary float-left">Back</a>
                        <h6 class="m-0 font-weight-bold text-danger text-center">LABEL TIDAK VALID, SCAN NIK GL UNTUK LANJUT</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="<?= base_url("scan/approve_gl_in") ?>" method="POST">
                            <div class="input-group mb-3 label">
                                <input type="text" id="nik" class="form-control" name="nik" onkeyup="cek_nik(this)" autofocus>
                            </div>
                        </form>
                        <?= $this->session->flashdata('message') ?>
                        <div class="alert alert-danger text-center" role="alert" style="display: none">
                            <h5><strong id="label_tidak_valid"></strong></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    $(document).ready(function() {})

    function cek_nik(ini) {
        if (ini.value.length > 5) {
            if ($("#nik").val().substr(0, 3) == "000") {
                // alert(ini.value);
                ini.form.submit();
            } else {
                $("#nik").val("");
                $("#label_tidak_valid").html("SALAH SCAN, BUKAN NIK !!");
                $(".alert-danger").show(0).delay(3000).hide(500);
            }
        }
    }
</script>