<nav class="sidebar sidebar-offcanvas shadow" style="background-color: rgb(3, 164, 237);" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='./'">
        <i class="mdi mdi-view-dashboard menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <?php if ($_SESSION['data-user']['role'] == 1) { ?>
      <!-- <li class="nav-item nav-category">Kelola Pengguna</li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='users'">
          <i class="mdi mdi-account-multiple-outline menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li> -->
    <?php } ?>
    <li class="nav-item nav-category">Data Desa</li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='dusun'">
        <i class="mdi mdi-map-marker-radius menu-icon"></i>
        <span class="menu-title">Dusun</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='rw'">
        <i class="mdi mdi-home-modern menu-icon"></i>
        <span class="menu-title">RW</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='rt'">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">RT</span>
      </a>
    </li>
    <li class="nav-item nav-category">Data Kependudukan</li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='kartu-keluarga'">
        <i class="mdi mdi-file-multiple menu-icon"></i>
        <span class="menu-title">Kartu Keluarga</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='penduduk'">
        <i class="mdi mdi-account-card-details menu-icon"></i>
        <span class="menu-title">Penduduk</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='kelahiran'">
        <i class="mdi mdi-baby menu-icon"></i>
        <span class="menu-title">Kelahiran</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='kematian'">
        <i class="mdi mdi-account-minus menu-icon"></i>
        <span class="menu-title">Kematian</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='pendatang'">
        <i class="mdi mdi-account-multiple-plus menu-icon"></i>
        <span class="menu-title">Pendatang</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='pindah'">
        <i class="mdi mdi-account-multiple-minus menu-icon"></i>
        <span class="menu-title">Pindah</span>
      </a>
    </li>
    <li class="nav-item nav-category"></li>
    <!-- <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='icons'">
        <i class="mdi mdi-face-profile menu-icon"></i>
        <span class="menu-title">Icons</span>
      </a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='../auth/signout'">
        <i class="mdi mdi-logout-variant menu-icon"></i>
        <span class="menu-title">Keluar</span>
      </a>
    </li>
  </ul>
</nav>