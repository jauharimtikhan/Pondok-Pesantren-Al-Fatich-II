<div class="col-xl-4 col-md-6">
    <article>

        <div class="post-img">
            <a href="{{ route('wakaf.landing_page.id', $wakaf->id) }}">
                <img src="{{ asset('/') . $wakaf->image }}" alt="" class="img-fluid">
            </a>
        </div>

        <p class="post-category">
            @if ($wakaf->is_featured !== null)
                <span class="badge bg-success">Sedang Berlangsung</span>
            @else
                <span class="badge bg-warning">Belum Terlaksana</span>
            @endif

        </p>

        <h2 class="title">
            <a href="{{ route('wakaf.landing_page.id', $wakaf->id) }}">{{ $wakaf->name }}</a>
        </h2>

        <div class="d-flex align-items-center">
            <div class="post-meta">
                <p class="post-date">
                    Tanggal Dibuat : <time datetime="{{ $wakaf->created_at }}">{{ $wakaf->created_at }}</time>
                </p>
            </div>
        </div>

    </article>
</div>
