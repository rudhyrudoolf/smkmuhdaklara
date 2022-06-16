<?= $this->extend('layouts/components/template') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi </h1>
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
                <form>
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label class="sr-only" for="periodFrom">Period From</label>
                            <input class="form-control mb-2 datepicker" id="periodFrom" name="txtperiodFrom">
                        </div>
                        <span>-</span>
                        <div class="col-auto">
                            <label class="sr-only" for="periodTo">Period To</label>
                            <div class="input-group mb-2">
                                <input class="form-control datepicker" id="periodTo" name="txtperidoTo">
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
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
            <div style="display: flex; justify-content: end;">
                <div id="btnsubmit" style="display: inline-block;">
                    <button type="button" class="btn btn-danger" id="btnTarikTunaiModal">
                        <span>Tarik Tunai</span>
                    </button>
                    <button type="button" class="btn btn-primary" id="btnSetorTunaiModal">
                        <span>Setor Tunai</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tbltransaksi" class="display" style="width:100%" cellspacing="0">
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
                            <th style="display: none;">norek</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($listTransaksi as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nis'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= number_format($row['debit'], 2, ',', '.') ?></td>
                                <td><?= number_format($row['kredit'], 2, ',', '.') ?></td>
                                <td><?= number_format($row['saldo'], 2, ',', '.') ?></td>
                                <td><?= $row['sandi'] ?></td>
                                <td><?= $row['created_by'] ?></td>
                                <td><?= $row['created_dt'] ?></td>
                                <td style="display: none;"><?= $row['norek'] ?></td>

                                <td>
                                    <button type="button" id="btnEdit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modaltransaksi" tabindex="-1" role="dialog" aria-labelledby="transaksilabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transaksilabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="form-label">Nomor Rekening</label>
                        <div class="form-control-wrap w-300px">
                            <select class="form-select form-control-lg dest-select2" id="inputNorek" name="txtNorek">`</select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputnnis">NIS</label>
                        <input type="text" class="form-control" id="inputnis" name="txtnis" placeholder="NIS" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputnnis">Nama</label>
                        <input type="email" class="form-control" id="inputnama" name="txtnama" placeholder="Nama" disabled>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputjenistabungan">Jenis Tabungan</label>
                        <input type="text" class="form-control" id="inputjenistabungan" name="txtjenisTabungan" placeholder="Jenis Tabungan" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputnominal" id="lblnominal"></label>
                        <input type="text" onkeypress="return onlyNumber(event)" class="form-control was-validated" id="inputnominal" name="txtjmlnominal" placeholder="Jumlah" required>

                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputsandi">Sandi</label>
                        <select class="form-select form-control " id="inputsandi" name="txtsandi" aria-label="Default select example">
                            <option selected>Pilih</option>
                            <?php foreach ($sandi as $row) : ?>
                                <option value="<?= $row['systemCode'] ?>"><?= $row['systemDesc'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="btnsubmit" style="display: inline-block;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="button" class="btn btn-primary" id="savedata">Simpan</button>
                </div>
                <div id="btnloading" style="display: none;">
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>



<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('/assets/js/transaksi.js') ?>"></script>
<?= $this->endSection() ?>