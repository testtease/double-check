<body class="bg-gradient-white">

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold align-middle text-primary text-center">Tambah User</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form id="form_adduser" class="user" method="post" action="<?= base_url('user/daftar') ?>">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="username" class="form-control form-control-user" id="username" placeholder="Username" onkeyup="this.value = this.value.toUpperCase();">
                                </div>
                                <div class="col-sm-6">
                                    <select name="section" id="section" class="form-control">
                                        <option value="EXIM" selected>EXIM</option>
                                        <option value="MPC">MPC</option>
                                        <option value="PPC">PPC</option>
                                        <option value="WAREHOUSE">WAREHOUSE</option>
                                    </select>
                                    <!-- <input type="text" name="section" class="form-control form-control-user" id="exampleLastName" placeholder="Section"> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Email Address">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="nik" id="nik" class="form-control form-control-user" placeholder="Nik">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <select name="level" id="level" class="form-control">
                                        <option value="SPV" selected>SPV</option>
                                        <option value="ESO - FOREMAN">ESO - FOREMAN</option>
                                        <option value="GL">GL</option>
                                        <option value="OPERATOR">OPERATOR</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    $(document).ready(function() {
        $("#username").val("");
        $("#section").val("EXIM");
        $("#email").val("");
        $("#nik").val("");
        $("#level").val("OPERATOR");
        $("#password").val("");
        $("#tableUser").dataTable();

        $('#form_adduser').on('submit', function(e) {
            e.preventDefault();
            if ($("#username").val() == "") {
                alert("USERNAME HARUS DIISI!!")
            } else if ($("#nik").val() == "") {
                alert("NIK HARUS DIISI!!")
            } else if ($("#password").val() == "") {
                alert("PASSWORD HARUS DIISI!!")
            } else {
                this.submit();
            }
        })
    })
</script>