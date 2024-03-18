@extends('frontend::layouts\app')

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
                @foreach ($artikels as $artikel)
                    @include('frontend::components\posts\artikels', ['artikel' => $artikel])
                @endforeach
            </div>
        </div>
        {{ $pagination->links() }}
    </section>
@endsection
