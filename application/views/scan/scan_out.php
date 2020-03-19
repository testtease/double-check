<body class="bg-gradient-white">

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 flex-row align-items-center justify-content-between">
                        <a href="<?= base_url('user') ?>" class="btn btn-sm btn-primary float-left">Back</a>
                        <h6 class="m-0 font-weight-bold text-primary text-center">Scan Out</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="input-group mb-3 label">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><small>JAI Label</small></span>
                            </div>
                            <input type="text" id="jai_label" class="form-control" name="jai_label" onkeyup="scan_label(this)" autofocus>
                        </div>
                        <div class="input-group mb-3 qr" style="display: none">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><small>Case Label</small></span>
                            </div>
                            <input type="text" id="jai_qr" class="form-control" name="jai_qr" onkeyup="scan_qr(this)">
                        </div>
                        <div class="input-group mb-3 pallet" style="display: none">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><small>Master Pallet</small></span>
                            </div>
                            <input type="text" id="jai_pallet" class="form-control" name="jai_pallet" onkeyup="scan_pallet(this)">
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
        if (ini.value.length > 3) {
            if (ini.value.substr(0, 3) == "JAI") {
                var jai_label = $("#jai_label").val();
                $.ajax({
                    url: "<?= base_url("scan/check_scan_in") ?>",
                    type: "POST",
                    data: {
                        jai_label: jai_label,
                    },
                    cache: false,
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == "ADA") {
                            $(".label").hide();
                            $(".pallet").hide();
                            $(".qr").show();
                            $("#jai_qr").focus();
                        } else if (dataResult.statusCode == "TIDAK ADA") {
                            $("#jai_label").val("");
                            $("#label_tidak_valid").html("LABEL " + dataResult.jai_label + " TIDAK CHECK SCAN IN !!");
                            $(".alert-danger").show(0).delay(3000).hide(500);
                        }
                    }
                });
            } else {
                $("#jai_label").val("");
                $("#label_tidak_valid").html("SALAH SCAN, BUKAN JAI LABEL !!");
                $(".alert-danger").show(0).delay(3000).hide(500);
            }
        }
    }

    function scan_qr(ini) {
        if (ini.value.length > 3) {
            if (ini.value.substr(0, 3) == "SIJ") {
                $(".label").hide();
                $(".qr").hide();
                $(".pallet").show();
                $("#jai_pallet").focus();
            } else {
                $("#jai_qr").val("");
                $("#jai_qr").focus();
                $("#label_tidak_valid").html("SALAH SCAN, BUKAN CASE LABEL !!");
                $(".alert-danger").show(0).delay(3000).hide(500);
            }
        } else {
            $("#jai_qr").val("");
        }
    }

    function scan_pallet(ini) {
        if (ini.value.length > 3) {
            if (ini.value.substr(0, 3) == "SIJ") {
                var jai_label = $("#jai_label").val();
                var jai_qr = $("#jai_qr").val();
                var jai_pallet = $("#jai_pallet").val();
                console.log(ini.value)

                $.ajax({
                    url: "<?= base_url("scan/insert_scan_out") ?>",
                    type: "POST",
                    data: {
                        tipe: "label",
                        jai_label: jai_label,
                        jai_qr: jai_qr,
                        jai_pallet: jai_pallet,
                    },
                    cache: false,
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == "VALID") {
                            $(".alert-danger").hide();
                            $("#label_valid").html("LABEL VALID !!");
                            $(".alert-success").show(0).delay(3000).hide(500);
                        } else if (dataResult.statusCode == "TIDAK VALID") {
                            $(".alert-success").hide();
                            $("#label_tidak_valid").html("LABEL TIDAK VALID !!");
                            $(".alert-danger").show(0).delay(3000).hide(500);
                        }
                    }
                });
                $("#jai_label").val("");
                $("#jai_qr").val("");
                $("#jai_pallet").val("");
                $(".qr").hide();
                $(".pallet").hide();
                $(".label").show(0).delay(3000).hide(500);
                $("#jai_label").focus();
            } else {
                $("#jai_pallet").val("");
                $("#jai_pallet").focus();
                $("#label_tidak_valid").html("SALAH SCAN, BUKAN MASTER PALLET !!");
                $(".alert-danger").show(0).delay(3000).hide(500);
            }
        } else {
            $("#jai_pallet").val("");
            $("#jai_pallet").focus();
            $("#label_tidak_valid").html("SALAH SCAN, BUKAN MASTER PALLET !!");
            $(".alert-danger").show(0).delay(3000).hide(500);
        }
    }
</script>