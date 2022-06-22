<?= $this->extend('layouts/components/template') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <!-- Content Row -->

    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="text-xs font-weight-bold text-primary text-uppercase col-md-4">
                            Periode
                        </div>
                        <form>
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
        </div>


    </div>
    <hr>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                total Nasabah
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalnasabah"><?= $totalnasabah->totalnasabah ?></div>
                            <hr>
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a href="<?= base_url('nasabah')?>">Lihat Detail</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-4x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total debit
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalDebit"><?= number_format($debit->debit, 2, ',', '.'); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Kredit
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="totalKredit"><?= number_format($kredit->kredit, 2, ',', '.'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Saldo
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalsaldo"><?= number_format($saldo->saldo, 2, ',', '.'); ?></div>
                            <hr>
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><button class="btn btn-xs btn-primary"  id="viewdetailsaldo">Lihat Detail</button></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-4x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('/assets/js/dashboard.js') ?>"></script>
<?= $this->endSection() ?>