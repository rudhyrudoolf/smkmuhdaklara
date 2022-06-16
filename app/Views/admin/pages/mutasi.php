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

    <div class="card shadow mb-4">
        <div class="card-body">
            <form>
                <div class="form-row align-items-center">
                    <div class="text-xs font-weight-bold text-primary text-uppercase col-md-1">
                        <p class="text-center">rekening</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input class="form-control" id="inputNorek" required>
                    </div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase col-md-1">
                        <p class="text-center">NIS</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" id="inputnis" disabled required>
                    </div>
                    <div class="text-xs font-weight-bold text-primary pull-right text-uppercase col-md-1">
                        <p class="text-center">nama</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputnama" disabled aria-describedby="inputGroupPrepend" required>
                        </div>
                    </div>
                </div>
                <div class="form-row align-items-center">
                    <div class="text-xs font-weight-bold text-primary text-uppercase col-md-1">
                        <p class="text-center"> Periode </p>
                    </div>
                    <div class="col-auto">
                        <label class="sr-only" for="periodFrom">Period From</label>
                        <input class="form-control mb-2 datepicker" id="periodFrom" name="txtperiodFrom" value="<?= $period ?>">
                    </div>
                    <span>-</span>
                    <div class="col-auto">
                        <label class="sr-only" for="periodTo">Period To</label>
                        <div class="input-group mb-2">
                            <input class="form-control datepicker" id="periodTo" name="txtperidoTo" value="<?= $period ?>">
                        </div>
                    </div>

                    <div class="text-xs font-weight-bold text-primary text-uppercase col-md-2">
                        <p class="text-center"> Kode Transaksi Terakhir </p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" id="kodetransaksi">
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>
                </div>
                <br>
                <button type="button" id="searchData" class="btn btn-primary btn-icon-split">
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
                <!-- <button class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-file"></i>
                    </span>
                    <span class="text">Export</span>
                </button> -->
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