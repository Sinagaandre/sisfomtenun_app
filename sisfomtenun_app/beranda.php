<?php
session_start();
include 'header_fe.php';
?>

<!-- History Section -->
<section class="py-5" style="background-color: #fcfcfc; min-height: 80vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted">Beranda</a></li>
                        <li class="breadcrumb-item active text-maroon fw-bold" aria-current="page">Sejarah Tenun</li>
                    </ol>
                </nav>

                <div class="card border-0 shadow-soft rounded-4 overflow-hidden mb-5">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <div class="h-100" style="background: url('https://images.unsplash.com/photo-1544967082-d9d25d867d66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; min-height: 300px;">
                                <div class="w-100 h-100" style="background: linear-gradient(to right, rgba(128, 0, 0, 0.4), transparent);"></div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4 p-lg-5">
                                <div class="badge px-3 py-2 rounded-pill mb-3" style="background-color: rgba(128, 0, 0, 0.1); color: var(--primary-color); border: 1px solid rgba(128, 0, 0, 0.2);">
                                    <i class="fas fa-history me-2"></i>Warisan Budaya
                                </div>
                                <h2 class="display-6 fw-bold mb-4" style="color: var(--dark-color);">Sejarah Tenun Tumtuman Tarutung</h2>
                                <p class="lead text-muted mb-4">Mengenal lebih dekat asal-usul dan filosofi dibalik keindahan kain tenun khas Tarutung.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-text" style="line-height: 1.8; color: #444; font-size: 1.1rem;">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <h4 class="fw-bold text-maroon mb-3 border-start border-4 border-primary ps-3">Asal-Usul Tumtuman</h4>
                            <p>Tenun Tumtuman merupakan salah satu jenis Ulos yang paling prestisius dari wilayah Tarutung, Tapanuli Utara. Nama "Tumtuman" sendiri merujuk pada teknik kerapatan tenunan dan motif yang melambangkan kebulatan tekad serta harapan yang tak terputus. Secara historis, motif ini dikembangkan oleh para pengrajin lokal Tarutung yang terinspirasi dari keindahan alam dan struktur sosial masyarakat Batak yang harmonis.</p>
                        </div>
                        
                        <div class="col-md-12 mb-4">
                            <h4 class="fw-bold text-maroon mb-3 border-start border-4 border-primary ps-3">Makna dan Filosofi</h4>
                            <p>Bagi masyarakat Batak, Tumtuman bukan sekadar kain. Ia adalah doa yang dipintal menjadi benang. Motifnya yang simetris menggambarkan keseimbangan hidup antara hubungan manusia dengan Sang Pencipta, sesama manusia, dan alam semesta. Penggunaan warna Maroon (Merah Hati) yang dominan melambangkan keberanian dan semangat hidup, sementara aksen Gold (Emas) mencerminkan kemuliaan dan kejayaan.</p>
                        </div>

                        <div class="col-md-12 mb-5">
                            <h4 class="fw-bold text-maroon mb-3 border-start border-4 border-primary ps-3">Perkembangan di Era Modern</h4>
                            <p>Seiring berjalannya waktu, Tenun Tumtuman Tarutung telah mengalami transformasi yang luar biasa. Jika dahulu hanya digunakan dalam upacara adat formal seperti pernikahan (sebagai kain pengantin), kini Tumtuman telah merambah dunia fashion internasional. Para desainer modern mulai mengaplikasikan teknik tenun tradisional ini ke dalam gaun malam, blazer formal, dan aksesoris mewah tanpa menghilangkan nilai sakralnya.</p>
                            <p>Sistem Informasi Pemasaran ini hadir sebagai bagian dari upaya pelestarian digital untuk memastikan warisan budaya ini tetap dikenal oleh generasi muda dan dapat diakses oleh pasar yang lebih luas di seluruh dunia.</p>
                        </div>
                    </div>

                    <div class="text-center pt-4 border-top">
                        <a href="index.php" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer_fe.php'; ?>
