<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-4 fixed-start ms-4 pb-2" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ env('APP_URL') }}" target="_blank">
      <img src="/img/logopnj.png" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold">SIMBKM</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  {{-- <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main"> --}}
  <div class="w-auto mb-4" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      
      {{-- MAHASISWA SIDEBAR VIEW --}}
      @if(auth()->user()->roles->name == "Mahasiswa" || auth()->user()->role == "1")
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Mahasiswa Pages</h6>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($active == 'Forum') active @endif" href="/dashboard/forum">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Forum</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if($active == 'Informasi MBKM') active @endif" href="/dashboard/informasi-mbkm">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-ruler-pencil text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Informasi MBKM</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if($active == 'Upload Kurikulum') active @endif" href="/dashboard/upload-kurikulum">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Upload Kurikulum</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if($active == 'Hasil Konversi') active @endif" href="/dashboard/hasil-konversi">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-paper-diploma text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Hasil Konversi</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if($active == 'Logbook') active @endif" href="/dashboard/logbook">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-book-bookmark text-secondary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Logbook</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if($active == 'Laporan') active @endif" href="/dashboard/laporan">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-books text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Laporan</span>
          </a>
        </li>
      @endif

      {{-- Dosbing SIDEBAR VIEW --}}
      @if(auth()->user()->roles->name == "Dosen Pembimbing" || auth()->user()->role_kedua == "4" || auth()->user()->role_ketiga == "4" || auth()->user()->role == "1")
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Dosen Pembimbing Pages</h6>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($active == 'Dashboard Dosbing') active @endif" href="/dashboard/dosbing/">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-building text-primary text-sm"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($active == 'Logbook Dosbing') active @endif" href="/logbook/dosbing/">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-book-bookmark text-secondary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Logbook</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($active == 'Laporan Dosbing') active @endif" href="/laporan/dosbing">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-books text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Laporan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($active == 'Forum') active @endif" href="/dashboard/forum">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-world text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Forum</span>
        </a>
      </li>
      @endif

       {{-- Pembimbing Industri SIDEBAR VIEW --}}
       @if(auth()->user()->roles->name == "Pembimbing Industri" || auth()->user()->role_kedua == "6" || auth()->user()->role_ketiga == "6" || auth()->user()->role == "1")
       <li class="nav-item mt-3">
         <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pembimbing Industri Pages</h6>
       </li>
       <li class="nav-item">
           <a class="nav-link @if($active == 'Dashboard Pembimbing Industri') active @endif" href="/dashboard/pi">
             <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
               <i class="ni ni-building text-primary text-sm"></i>
             </div>
             <span class="nav-link-text ms-1">Dashboard</span>
           </a>
       </li>
       <li class="nav-item">
        <a class="nav-link @if($active == 'Logbook Pembimbing Industri') active @endif" href="/logbook/pi">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-book-bookmark text-secondary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Logbook</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($active == 'Laporan Pembimbing Industri') active @endif" href="/laporan/pi">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-books text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Laporan</span>
        </a>
      </li>
       @endif


      {{-- KPS SIDEBAR VIEW --}}
      @if(auth()->user()->roles->name == "KPS" || auth()->user()->role_kedua == "3" || auth()->user()->role_ketiga == "3" || auth()->user()->role == "1")
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">KPS Pages</h6>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($active == 'Dashboard KPS') active @endif" href="/dashboard/kps">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-building text-primary text-sm"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($active == 'Logbook KPS') active @endif" href="/logbook/kps">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-book-bookmark text-secondary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Logbook</span>
        </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if($active == 'Laporan KPS') active @endif" href="/laporan/kps">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
          <i class="ni ni-books text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Laporan</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if($active == 'Konversi KPS') active @endif" href="/konversi/kps">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
          <i class="ni ni-paper-diploma text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Konversi Kurikulum</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if($active == 'Forum') active @endif" href="/dashboard/forum">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
          <i class="ni ni-world text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Forum</span>
      </a>
    </li>
      @endif

       {{-- Pembimbing Akademik SIDEBAR VIEW --}}
       @if(auth()->user()->roles->name == "Pembimbing Akademik" || auth()->user()->role_kedua == "5" || auth()->user()->role_ketiga == "5" || auth()->user()->role == "1")
       <li class="nav-item mt-3">
         <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pembimbing Akademik Pages</h6>
       </li>
       <li class="nav-item">
           <a class="nav-link @if($active == 'Dashboard Pembimbing Akademik') active @endif" href="/dashboard/pa">
             <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
               <i class="ni ni-building text-primary text-sm"></i>
             </div>
             <span class="nav-link-text ms-1">Dashboard</span>
           </a>
       </li>
       <li class="nav-item">
        <a class="nav-link @if($active == 'Forum') active @endif" href="/dashboard/forum">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-world text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Forum</span>
        </a>
      </li>
       @endif

       {{-- Wadir SIDEBAR VIEW --}}
       @if(auth()->user()->roles->name == "Wadir" || auth()->user()->role_kedua == "2" || auth()->user()->role_ketiga == "2" || auth()->user()->role == "1")
       <li class="nav-item mt-3">
         <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Wadir Pages</h6>
       </li>
       <li class="nav-item">
           <a class="nav-link @if($active == 'Dashboard Wadir') active @endif" href="/dashboard/wadir">
             <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
               <i class="ni ni-building text-primary text-sm"></i>
             </div>
             <span class="nav-link-text ms-1">Dashboard</span>
           </a>
       </li>
       <li class="nav-item">
        <a class="nav-link @if($active == 'Forum') active @endif" href="/dashboard/forum">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-world text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Forum</span>
        </a>
      </li>
       @endif

      {{-- ADMIN SIDEBAR VIEW --}}
      @if(auth()->user()->role == "1")
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Admin pages</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($active == 'Buat Akun') active @endif" href="/dashboard/register">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Buat Akun</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($active == 'Fakultas') active @endif" href="/dashboard/fakultas">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-building text-secondary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Jurusan</span>
        </a>
      </li>        
      <li class="nav-item">
        <a class="nav-link @if($active == 'Jurusan') active @endif" href="/dashboard/jurusan">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-archive-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Prodi</span>
        </a>
      </li>        
      <li class="nav-item">
        <a class="nav-link @if($active == 'Role') active @endif" href="/dashboard/role">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-badge text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Role</span>
        </a>
      </li>        
      <li class="nav-item">
        <a class="nav-link @if($active == 'Program Mbkm') active @endif" href="/dashboard/program-mbkm">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-square-pin text-secondary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Program Mbkm</span>
        </a>
      </li>        
      @endif
    </ul>
  </div>
</aside>