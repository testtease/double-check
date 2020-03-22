<body class="bg-gradient-white">

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 flex-row align-items-center justify-content-between">
                        <a href="<?= base_url('user') ?>" class="btn btn-sm btn-primary float-left">Back</a>
                        <h6 class="m-0 font-weight-bold text-primary text-center">Scan In</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="input-group mb-3 label">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><small>Scan JAI Label</small></span>
                            </div>
                            <input type="text" id="jai_label" class="form-control" name="jai_label" onkeyup="scan_label(this)" autofocus>
                        </div>
                        <div class="input-group mb-3 qr" style="display: none">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><small>Scan Case Label</small></span>
                            </div>
                            <input type="text" id="jai_qr" class="form-control" name="jai_qr" onkeyup="scan_qr(this)" autofocus>
                        </div>
                        <div class="alert alert-success text-center" role="alert" style="display: none">
                            <h5><strong id="label_valid">LABEL VALID !!!</strong></h5>
                        </div>
                        <div class="alert alert-danger text-center" role="alert" style="display: none">
                            <h5><strong id="label_tidak_valid">LABEL TIDAK VALID !!!</strong></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    $(document).ready(function() {})

    function scan_label(ini) {
        if (ini.value.length > 8) {
            if ($("#jai_label").val().substr(0, 3) == "JAI") {
                console.log(ini.value)
                $(".label").hide();
                $(".qr").show();
                $("#jai_qr").focus();
                $(".alert-danger").hide();
            } else {
                $("#jai_label").val("");
                $("#label_tidak_valid").html("SALAH SCAN, BUKAN JAI LABEL !!");
                $(".alert-danger").show(0).delay(3000).hide(500);
            }
        }
    }

    function scan_qr(ini) {
        if (ini.value.length > 8) {
            var jai_label = $("#jai_label").val();
            var jai_qr = $("#jai_qr").val();
            console.log(ini.value)
            if (jai_qr.substr(0, 3) == "SIJ") {
                $(".alert-danger").hide();

                $.ajax({
                    url: "<?= base_url("scan/insert_scan_in") ?>",
                    type: "POST",
                    data: {
                        tipe: "label",
                        jai_label: jai_label,
                        jai_qr: jai_qr,
                    },
                    cache: false,
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == "VALID") {
                            $("#label_valid").html("ASSY " + dataResult.assyCode + ", LABEL VALID !!");
                            $(".alert-danger").hide();
                            $(".alert-success").show(0).delay(3000).hide(500);
                        } else if (dataResult.statusCode == "TIDAK VALID") {
                            $("#label_tidak_valid").html("ASSY " + dataResult.assyCode + ", LABEL TIDAK VALID !!");
                            $(".alert-success").hide();
                            $(".alert-danger").show(0).delay(3000).hide(500);
                        }
                    }
                });
                $("#jai_label").val("");
                $("#jai_qr").val("");
                $(".label").show();
                $("#jai_label").focus();
                $(".qr").hide();
            } else {
                $("#jai_qr").val("");
                $("#label_tidak_valid").html("SALAH SCAN, BUKAN CASE LABEL !!");
                $(".alert-danger").show(0).delay(3000).hide(500);
            }
        }
    }
</script>