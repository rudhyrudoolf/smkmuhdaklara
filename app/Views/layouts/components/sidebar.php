<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="">
            <img class="img-fluid" src="<?= base_url('assets/img/logo_smk_apik.png') ?>" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">SMUHDAKLARA</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active" id="barDashboard">
        <a class="nav-link" href="<?= base_url('home') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" id="sideDropdown" href="#" data-toggle="collapse" data-target="#collapseNasabah" aria-expanded="true" aria-controls="collapseNasabah">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master data</span>
        </a>
        <div id="collapseNasabah" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('nasabah') ?>">Nasabah</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" id="sideDropdown2" href="#" data-toggle="collapse" data-target="#collapseTabungan" aria-expanded="true" aria-controls="collapseNasabah">
            <i class="fas fa-fw fa-cog"></i>
            <span>Tabungan</span>
        </a>
        <div id="collapseTabungan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" id="barInfoSaldo" href="<?= base_url('infosaldo') ?>">Info Saldo</a>
                <a class="collapse-item" id="barTransaksi" href="<?= base_url('transaksi') ?>">Transaksi</a>
                <a class="collapse-item" id="barMutasi" href="<?= base_url('mutasi') ?>">Mutasi</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>