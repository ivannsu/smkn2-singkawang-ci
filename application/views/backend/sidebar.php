  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>
        <!-- DASHBOARD -->
        <li><a href="<?= site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <span>BERANDA</span></a></li>
        <!-- JURUSAN -->
        <li class="treeview">
          <a href="#"><i class="fa fa-list"></i> <span>JURUSAN</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('jurusan'); ?>">DATA JURUSAN</a></li>
            <li><a href="<?= site_url('jurusan/create'); ?>">TAMBAH BARU</a></li>
          </ul>
        </li>
        <!-- INFORMASI -->
        <li class="treeview">
          <a href="#"><i class="fa fa-edit"></i> <span>INFORMASI</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('information'); ?>">DATA INFORMASI</a></li>
            <li><a href="<?= site_url('information/create'); ?>">TAMBAH BARU</a></li>
          </ul>
        </li>
        <!-- ARTIKEL -->
        <li class="treeview">
          <a href="#"><i class="fa fa-edit"></i> <span>ARTIKEL</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('posts'); ?>">DATA ARTIKEL</a></li>
            <li><a href="<?= site_url('posts/create'); ?>">TAMBAH BARU</a></li>
          </ul>
        </li>
        <!-- PRESTASI -->
        <li class="treeview">
          <a href="#"><i class="fa fa-edit"></i> <span>PRESTASI</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('prestasi'); ?>">DATA PRESTASI</a></li>
            <li><a href="<?= site_url('prestasi/create'); ?>">TAMBAH BARU</a></li>
          </ul>
        </li>
        <!-- PROFIL -->
        <li class="treeview">
          <a href="#"><i class="fa fa-wrench"></i> <span>PROFIL</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('profile/detail'); ?>">SEKOLAH</a></li>
            <li><a href="<?= site_url('profile/edit'); ?>">EDIT SEKOLAH</a></li>
            <li>&nbsp;<li>
            <li><a href="<?= site_url('headmaster/detail'); ?>">KEPALA SEKOLAH</a></li>
            <li><a href="<?= site_url('headmaster/edit'); ?>">EDIT KEPALA SEKOLAH</a></li>
          </ul>
        </li>
        <!-- GALERI FOTO -->
        <li class="treeview">
          <a href="#"><i class="fa fa-image"></i> <span>GALERI FOTO</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('gallery/index_album'); ?>">DATA ALBUM</a></li>
            <li><a href="<?= site_url('gallery/create_album'); ?>">BUAT ALBUM</a></li>
            <li><a href="<?= site_url('photos/create'); ?>">TAMBAH FOTO</a></li>
          </ul>
        </li>
        <!-- NAVIGASI -->
        <li class="treeview">
          <a href="#"><i class="fa fa-file-o"></i> <span>NAVIGASI</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('navigations/'); ?>">DATA NAVIGASI</a></li>
            <li><a href="<?= site_url('navigations/create_page/'); ?>">HALAMAN TUNGGAL</a></li>
            <li><a href="<?= site_url('navigations/create_navigation'); ?>">BUAT DROPDOWN</a></li>
          </ul>
        </li>
        <!-- LINKS -->
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>LINKS</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('links'); ?>">DATA LINKS</a></li>
            <li><a href="<?= site_url('links/create'); ?>">TAMBAH BARU</a></li>
          </ul>
        </li>
        <!-- PPDB -->
        <li class="treeview">
          <a href="#"><i class="fa fa-address-book-o"></i> <span>PPDB</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('admission'); ?>">PENGATURAN ADMISI</a></li>
            <li><a href="<?= site_url('ppdb'); ?>">DATA PENDAFTAR</a></li>
            <li><a href="<?= site_url('ppdb/selection'); ?>">SELEKSI</a></li>
            <li><a href="<?= site_url('ppdb/passed_selection'); ?>">DITERIMA</a></li>
            <li><a href="<?= site_url('ppdb/not_passed_selection'); ?>">TIDAK DITERIMA</a></li>
          </ul>
        </li>
        <!-- DATA INDUK -->
        <li class="treeview">
          <a href="#"><i class="fa fa-address-book-o"></i> <span>DATA INDUK</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('alumni'); ?>">DATA ALUMNI</a></li>
            <li><a href="<?= site_url('alumni/create'); ?>">TAMBAH ALUMNI</a></li>
          </ul>
        </li>
        <!-- <li><a href=""><i class="fa fa-link"></i> <span>LINKS</span></a></li> -->
        <!-- <li><a href=""><i class="fa fa-link"></i> <span>DATA ALUMNI</span></a></li> -->
        <!-- <li><a href=""><i class="fa fa-link"></i> <span>KEPALA SEKOLAH</span></a></li> -->
        <!-- <li><a href=""><i class="fa fa-link"></i> <span>MEDIA SOSIAL</span></a></li> -->
        <!-- <li><a href=""><i class="fa fa-link"></i> <span>PROFIL</span></a></li> -->
      </ul>
    </section>
  </aside>