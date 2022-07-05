<?= $this->extend('layouts/components/template') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Info Saldo </h1>
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
            <div class="row no-gutters align-items-center">
                <div class="text-xs font-weight-bold text-primary text-uppercase col-md-1">
                    Periode
                </div>
                <div class="form-row align-items-center">
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
                    <div class="col-auto">
                        <button type="button" id="searchData" class="btn btn-primary">cari</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Saldo</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tblInfosaldo" data-auto-responsive="true">
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
                    <tfoot>
                        <tr class="nk-tb-foot">
                            <td style="border-color: black !important; border-width: 1px 0px 1px 0px !important; border-style: solid !important; background-color: #E8E8E8" colspan="3">Total</td>
                            <td style="border-color: black !important; border-width: 1px 0px 1px 0px !important; border-style: solid !important; background-color: #E8E8E8"><span id="totaldebit"></span></td>
                            <td style="border-color: black !important; border-width: 1px 0px 1px 0px !important; border-style: solid !important; background-color: #E8E8E8"><span id="totalkredit"></span></td>
                            <td style="border-color: black !important; border-width: 1px 0px 1px 0px !important; border-style: solid !important; background-color: #E8E8E8"><span style="font-weight: bold;" id="totalsaldo"></span></td>
                            <td style="border-color: black !important; border-width: 1px 0px 1px 0px !important; border-style: solid !important; background-color: #E8E8E8" colspan="3"><span></span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('/assets/js/infosaldo.js') ?>"></script>
<?= $this->endSection() ?>