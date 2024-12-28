 <!-- ======= Hero Section ======= -->
 <section id="hero">

     <div class="container">
         <div class="row">
             <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center"
                 data-aos="fade-up">
                 <div>
                     <h1>Selamat Datang Di Website PPDB Online</h1>
                     <h2>Pondok pesantren tahfizhul qur'an iphi surakarta
                         {{ $period ? $period->nama_periode : 'Tahun Pelajaran 2024/2025' }}
                     </h2>
                     <a href="{{ route('registration.index') }}" class="btn-get-started scrollto">Daftar Sekarang</a>
                 </div>
             </div>
             <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
                 <img src="assets/img/logo.jpg" class="img-fluid" alt="">
             </div>
         </div>
     </div>

 </section><!-- End Hero -->
