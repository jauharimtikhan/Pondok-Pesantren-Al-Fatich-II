@extends('frontend::layouts\app')

@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2>Wakaf</h2>
                        <p>Pada halaman ini akan memuat daftar program wakaf yang sedang berlangsung di pondok pesantren Al
                            Fatich 2</p>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol>
                    <li><a href="{{ route('/') }}">Beranda</a></li>
                    <li>Wakaf</li>
                </ol>
            </div>
        </nav>
    </div>

    <section class="wakaf">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4 posts-list">
                @foreach ($wakafs as $wakaf)
                    @include('frontend::components\wakaf\single-wakaf', ['wakaf' => $wakaf])
                @endforeach
            </div>
        </div>
        {{ $wakafs->links() }}

    </section>
@endsection
