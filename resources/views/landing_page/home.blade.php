@extends('layout.main')

@section('container')

<main>

    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">Sistem Informasi MBKM</h1>
          <p class="lead text-body-secondary">Selamat Datang di Sistem Informasi MBKM Politeknik Negeri Jakarta</p>
          <p>
            {{-- <a href="#" class="btn btn-primary my-2">Main call to action</a> --}}
            <a href="#" class="btn btn-secondary my-2">selengkapnya</a>
            {{-- <button type="button" class="btn btn-secondary btn-lg btn-block">Block level button</button> --}}
          </p>
        </div>
      </div>
    </section>
  
    <div class="album py-5 bg-body-tertiary">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

          <div class="col-md-4">
            <div class="card h-100 shadow-sm" >
                <img src="img/kampus_mengajar.JPG" width="100" height="200" class="card-img-top" alt="kampus_mengajar_logo">
              <div class="card-body">
                <h3 class="card-title">Kampus Mengajar</h3>
                <p class="card-text ">Kampus Mengajar merupakan kanal pembelajaran yang memberikan kesempatan kepada mahasiswa untuk belajar di luar kampus selama satu semester guna melatih kemampuan menyelesaikan permasalahan yang kompleks dengan menjadi mitra guru untuk berinovasi dalam pembelajaran, pengembangan strategi, dan model pembelajaran yang kreatif, inovatif, dan menyenangkan.</p>
              </div>
              <div class="d-flex justify-content-between align-items-end p-3">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="img/msib.JPG" width="100" height="200"  class="card-img-top" alt="kampus_mengajar_logo">
              <div class="card-body">
                <h3 class="card-title">MSIB (Magang)</h3>
                <p class="card-text">Magang Bersertifikat adalah bagian dari program kampus merdeka yang bertujuan untuk memberikan kesempatan kepada mahasiswa belajar dan mengembangkan diri melalui aktivitas diluar kelas perkuliahan. Di program ini, mahasiswa akan mendapatkan pengalaman kerja di industri/dunia profesi selama 1 hingga 2 semester. Dengan pembelajaran langsung di tempat kerja mitra magang, mahasiswa akan mendapatkan hard skills maupun soft skills yang akan menyiapkan mahasiswa agar lebih siap untuk memasuki dunia kerja dan karirnya</p>
              </div>
              <div class="d-flex justify-content-between align-items-center p-3">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="img/msib.JPG" width="100" height="200"  class="card-img-top" alt="kampus_mengajar_logo">
              <div class="card-body">
                <h3 class="card-title">MSIB (Studi Independent)</h3>
                <p class="card-text">Studi Independen Bersertifikat adalah bagian dari program kampus merdeka yang bertujuan untuk memberikan kesempatan kepada mahasiswa untuk belajar dan mengembangkan diri melalui aktivitas diluar kelas perkuliahan, namun tetap diakui sebagai bagian dari perkuliahan. Program ini diperuntukan bag mahasiswa yang ingin memperlengkapi dirinya dengan menguasai kompetensi spesifik dan praktis yang juga dicari oleh dunia usaha maupun dunia industri 
                </p>
              </div>
              <div class="d-flex justify-content-between align-items-center p-3">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>
  
          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="img/pmm.JPG" width="100" height="200"  class="card-img-top" alt="kampus_mengajar_logo">
              <div class="card-body">
                <h3 class="card-title">Pertukaran Mahasiswa Merdeka</h3>
                <p class="card-text">Pertukaran Mahasiswa Merdeka merupakan sebuah program mobilitas mahasiswa selama satu semester untuk mendapatkan pengalaman belajar di perguruan tinggi di Indonesia sekaligus memperkuat persatuan dalam keberagaman.</p>
              </div>
              <div class="d-flex justify-content-between align-items-center p-3">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="img/wirausaha.JPG" width="100" height="200"  class="card-img-top" alt="kampus_mengajar_logo">
              <div class="card-body">
                <h3 class="card-title">Wirausaha Merdeka</h3>
                <p class="card-text">WIrausaha Merdeka merupakan program bermanfaat yang akan mengantarkan para mahasiswa untuk menjadi wirausahawan dan wirausahawati yang handal dan akan dibantu oleh perguruan tinggi terbaik yang sudah melalui proses seleksi
                </p>
              </div>
              <div class="d-flex justify-content-between align-items-center p-3">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="img/iisma.JPG" width="100" height="200"  class="card-img-top" alt="kampus_mengajar_logo">
              <div class="card-body">
                <h3 class="card-title">IISMA (Indonesian International Student Mobility Awards)</h3>
                <p class="card-text">IISMA merupakan bagian dari program Kampus Merdeka atau MBKM dari Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi Republik Indonesia (Kemendikbudristek RI). Tujuannya untuk membiayai mahasiswa Indonesia dalam program mobilitas internasional ke perguruan tinggi dan industri terbaik dunia
                </p>
              </div>
              <div class="d-flex justify-content-between align-items-center p-3">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>
  
          <div class="col-md-4">
            <div class="card h-100shadow-sm">
                <img src="img/praktisi.JPG" width="100" height="200"  class="card-img-top" alt="kampus_mengajar_logo">
              <div class="card-body">
                <h3 class="card-title">Praktisi Mengajar</h3>
                <p class="card-text">Praktisi Mengajar adalah Program yang diinisiasi oleh Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi Republik Indonesia agar lulusan perguruan tinggi lebih siap untuk masuk ke dunia kerja. Program ini mendorong kolaborasi aktif praktisi ahli dengan dosen juara agar tercipta pertukaran ilmu dan keahlian yang mendalam dan bermakna antar sivitas akademika di perguruan tinggi dan profesional di dunia kerja. Kolaborasi ini dilakukan dalam mata kuliah yang disampaikan di ruang kelas baik secara luring maupun daring.
                </p>
              </div>
              <div class="d-flex justify-content-between align-items-center p-3">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="img/bangkit.JPG" width="100" height="200"  class="card-img-top" alt="kampus_mengajar_logo">
              <div class="card-body">
                <h3 class="card-title">Bangkit</h3>
                <p class="card-text">Bangkit adalah program kesiapan karier yang didesain oleh Google untuk memberikan mahasiswa Indonesia paparan langsung dengan praktisi industri, serta mempersiapkan mahasiswa dengan keterampilan yang relevan untuk karir sukses di perusahaan teknologi terkemuka
                </p>
              </div>
              <div class="d-flex justify-content-between align-items-center p-3">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="img/gerilya.JPG" width="100" height="200"  class="card-img-top" alt="kampus_mengajar_logo">
              <div class="card-body">
                <h3 class="card-title">Gerilya</h3>
                <p class="card-text">Gerilya merupakan program yang disiapkan oleh Kementerian Energi dan Sumber Daya Mineral untuk diimplementasikan pada Merdeka Belajar Kampus Merdeka Kementerian Pendidikan Kebudayaan, Riset dan Teknologi. MSIB Gerilya adalah program magang yang diakselerasikan dengan pengalaman belajar yang dirancang dan dibuat khusus berdasarkan tantangan nyata yang dihadapi oleh mitra/industri.
                </p>
              </div>
              <div class="d-flex justify-content-between align-items-center p-3">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
  </main>
@endsection