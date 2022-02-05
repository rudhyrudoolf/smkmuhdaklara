<?= $this->extend('layouts/components/template') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Master Data</h1>
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
    <div class="card-header py-3">
      <div style="display: flex; justify-content: space-between;">
        <h6 class="m-0 font-weight-bold text-primary">Data Nasabah</h6>
        <button type="button" class="btn btn-primary" id="btnAddModal" data-target="#modalNasabah">
          <i class="fas fa-plus"></i>
        </button>
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="tblnasabah" class="display" style="width:100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>NIS</th>
              <th>Jenis Tabungan</th>
              <th>NomorRekening</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Jenis Kelamin</th>
              <th>Tahun Masuk</th>
              <th>Aksi</th>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($listNasabah as $row) : ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nis'] ?></td>
                <td><?= $row['jenis_tabungan'] ?></td>
                <td><?= $row['nomor_rekening'] ?></td>
                <td><?= $row['Nama'] ?></td>
                <td><?= $row['Alamat'] ?></td>
                <td><?= $row['jenis_kelamin'] ?></td>
                <td><?= $row['tahunMasuk'] ?></td>
                <td></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalNasabah" tabindex="-1" role="dialog" aria-labelledby="nasabahlabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nasabahlabel">Tambah Nasabah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="selectJenistab">Jenis Tabungan</label>
            <select class="form-select form-control " id="selectJenistab" name="txtjenistabungan" aria-label="Default select example">
              <option selected>Pilih</option>
              <?php foreach ($jenistabungan as $row) : ?>
                <option value="<?= $row['systemCode'] ?>"><?= $row['systemDesc'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputnnis">NIS</label>
            <input type="text" class="form-control" id="inputnis" name="txtnis" placeholder="NIS" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="inputNorek">Nomor Rekening</label>
            <input type="password" class="form-control" id="inputnorek" name="txtnorek" placeholder="Nomor Rekening" disabled>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="inputnnis">Nama</label>
            <input type="email" class="form-control" id="inputnama" name="txtnama" placeholder="Nama">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="inputAlamat">Alamat</label>
            <textarea class="form-control" name="txtalamat" id="inputAlamat" rows="3" placeholder="Alamat"></textarea>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputJenisKelamin">Jenis Kelamin</label>
            <select class="form-select form-control " id="inputJenisKelamin" name="txtjenisKelamin" aria-label="Default select example">
              <option selected>Pilih</option>
              <?php foreach ($jeniskelamin as $row) : ?>
                <option value="<?= $row['systemCode'] ?>"><?= $row['systemDesc'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="inputthnmasuk">Tahun Masuk</label>
            <input type="text" class="form-control" id="inputthnmasuk" name="txtthnMasuk" placeholder="Tahun Masuk">
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