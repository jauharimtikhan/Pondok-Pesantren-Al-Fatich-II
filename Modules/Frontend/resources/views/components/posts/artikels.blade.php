<div class="col-xl-4 col-md-6">
    <article>
        <div class="post-img ">
            <a href="{{ route('artikelById.landing_page', $artikel->artikel_id) }}">
                <img src="{{ $artikel->path }}" alt="" class="img-fluid">
            </a>
        </div>

        <p class="post-category">{{ $artikel->kategori }}</p>

        <h2 class="title">
            <a href="{{ route('artikelById.landing_page', $artikel->artikel_id) }}">{{ $artikel->title }}</a>
        </h2>

        <div class="d-flex align-items-center">
            <img src="{{ asset('assets-landing-page') }}/img/profile-pic.svg" alt=""
                class="img-fluid post-author-img flex-shrink-0">
            <div class="post-meta">
                <p class="post-author-list">{{ Ucfirst($artikel->author) }}</p>
                <p class="post-date">
                    <time datetime="{{ $artikel->created_at }}">{{ $artikel->created_at }}</time>
                </p>
            </div>
        </div>

    </article>
</div>
