<?= $this->extend('layouts/components/template') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mutasi</h1>
    </div>
    <div class="alert alert-success" role="alert" id="add-alert-success" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong> <span id="alert-text-success"> </span>
    </div>
    <div class="alert alert-danger" role="alert" id="show-alert-danger" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Oops!</strong> <span id="alert-text-danger"></span>
    </div>

    <!-- <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="form-label font-weight-bold  ">Nomor Rekening</label>
                    <div class="form-control-wrap">
                        <select class="form-select form-control-lg dest-select2 " id="inputNorek" name="txtNorek">`</select>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="row no-gutters align-items-center col-md-6 form-group">
                    <div class="font-weight-bold  col-md-4   ">
                        Periode harian
                    </div>
                    <div class="form-row align-items-center ">
                        <div class="col-auto">
                            <label class="sr-only" for="periodFrom">Period From</label>
                            <input class="form-control mb-2 datepicker" id="periodFrom" name="txtperiodFrom" value="<?= $periodFrom ?>">
                        </div>
                        <span>-</span>
                        <div class="col-auto">
                            <label class="sr-only" for="periodTo">Period To</label>
                            <div class="input-group mb-2">
                                <input class="form-control datepicker" id="periodTo" name="txtperidoTo" value="<?= $periodTo ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div id="btnsubmit" style="display: inline-block;">
                <button type="button" class="btn btn-primary" id="savedata">Cari</button>
                <button type="button" class="btn btn-info" id="savedata">Export</button>
                <button type="button" class="btn btn-success" id="savedata">Print</button>
            </div>
        </div>
    </div> -->

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="inputNorek">Nomor rekening</label>
                        <input class="form-control" id="inputNorek" placeholder="First name" required>
                        <div class="valid-feedback ">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">Nis</label>
                        <input type="text" class="form-control" id="validationCustom02" disabled required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustomUsername">Nama</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="validationCustomUsername" disabled aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">

                    <div class="col-md-3 mb-3">
                        <label for="validationCustom04">Period Harian</label>
                        <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom05">Period Harian</label>
                        <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
                        <div class="invalid-feedback">
                            Please provide a valid zip.
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                        <label class="form-check-label" for="invalidCheck">
                            Agree to terms and conditions
                        </label>
                        <div class="invalid-feedback">
                            You must agree before submitting.
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-search"></i>
                    </span>
                    <span class="text">Cari</span>
                </button>
                <button class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Cetak</span>
                </button>
                <button class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-file"></i>
                    </span>
                    <span class="text">Export</span>
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tblmutasi" class="display" style="width:100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th>Sandi</th>
                            <th>Petugas</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('/assets/js/mutasi.js') ?>"></script>
<?= $this->endSection() ?>