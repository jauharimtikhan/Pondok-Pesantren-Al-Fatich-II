@extends('home.layouts.app')

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2>Artikel</h2>
                        <p>Pada halaman ini akan memuat berita terkini tentang perkembangan pondok pesantren
                            Al Fatich 2
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol>
                    <li><a href="{{ route('/') }}">Beranda</a></li>
                    <li>Artikel</li>
                </ol>
            </div>
        </nav>
    </div>

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4 posts-list">
                @include('home.components.posts.artikels')
            </div>
        </div>

        <div class="blog-pagination">
            <ul class="justify-content-center">
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
            </ul>
        </div>
    </section>
@endsection
