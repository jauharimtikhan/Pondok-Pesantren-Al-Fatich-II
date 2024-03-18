@extends('frontend::layouts\app')

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2>Artikel</h2>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol>
                    <li><a href="{{ route('/') }}">Beranda</a></li>
                    <li><a href="{{ route('artikel.landing_page') }}">Artikel</a></li>
                    <li style="cursor: none">{{ $artikel[0]->title }}</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row g-5">

                <div class="col-lg-8">

                    <article class="blog-details">

                        <div class="post-img">
                            <img src="{{ $artikel[0]->path }}" alt="" class="img-fluid">
                        </div>

                        <h2 class="title">{{ $artikel[0]->title }}</h2>

                        <div class="meta-top">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                        href="javascript:void(0)">{{ Ucfirst($artikel[0]->author) }}</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                        href="javascript:void(0)"><time
                                            datetime="{{ $artikel[0]->updated_at }}">{{ $artikel[0]->updated_at }}</time></a>
                                </li>
                                {{-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                        href="javascript:void(0)">12 Comments</a></li> --}}
                            </ul>
                        </div>

                        <div class="content">
                            <?php
                            $content = $artikel[0]->content;
                            
                            $news = str_replace(['../../', '../'], getenv('ASSET_URL') . '/', $content);
                            $new = htmlspecialchars_decode($news);
                            $blockQuote = '<blockquote><p>Iklan Google Ads</p></blockquote>';
                            
                            $result = str_replace('[:iklan]', $blockQuote, $new);
                            echo $result;
                            ?>

                        </div>

                        <div class="meta-bottom">
                            <i class="bi bi-folder"></i>
                            <ul class="cats">
                                <li><a href="javascript:void(0)">{{ $artikel[0]->kategori }}</a></li>
                            </ul>

                            <i class="bi bi-tags"></i>
                            <ul class="tags">
                                <?php $tags = explode(',', $artikel[0]->meta_description); ?>
                                @if (is_array($tags))
                                    @foreach ($tags as $tag)
                                        <li><a href="javascript:void(0)">{{ $tag }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                    </article>

                    <div class="post-author d-flex align-items-center">
                        <img src="{{ asset('assets-landing-page') }}/img/profile-pic.svg"
                            class="rounded-circle flex-shrink-0" alt="author-img" width="80" height="80">
                        <div>
                            <h4>{{ Ucfirst($artikel[0]->author) }}</h4>
                            <p>
                                Admin Pondok Pesantren Al Fatih
                            </p>
                        </div>
                    </div><!-- End post author -->

                    {{-- <div class="comments">

                        <h4 class="comments-count">8 Comments</h4>

                        <div id="comment-1" class="comment">
                            <div class="d-flex">
                                <div class="comment-img"><img
                                        src="{{ asset('assets-landing-page') }}/img/blog/comments-1.jpg" alt="">
                                </div>
                                <div>
                                    <h5><a href="">Georgia Reader</a> <a href="#" class="reply"><i
                                                class="bi bi-reply-fill"></i> Reply</a></h5>
                                    <time datetime="2020-01-01">01 Jan,2022</time>
                                    <p>
                                        Et rerum totam nisi. Molestiae vel quam dolorum vel voluptatem et et. Est ad aut
                                        sapiente quis molestiae est qui cum soluta.
                                        Vero aut rerum vel. Rerum quos laboriosam placeat ex qui. Sint qui facilis et.
                                    </p>
                                </div>
                            </div>
                        </div><!-- End comment #1 -->

                        <div id="comment-2" class="comment">
                            <div class="d-flex">
                                <div class="comment-img"><img
                                        src="{{ asset('assets-landing-page') }}/img/blog/comments-2.jpg" alt="">
                                </div>
                                <div>
                                    <h5><a href="">Aron Alvarado</a> <a href="#" class="reply"><i
                                                class="bi bi-reply-fill"></i> Reply</a></h5>
                                    <time datetime="2020-01-01">01 Jan,2022</time>
                                    <p>
                                        Ipsam tempora sequi voluptatem quis sapiente non. Autem itaque eveniet saepe.
                                        Officiis illo ut beatae.
                                    </p>
                                </div>
                            </div>

                            <div id="comment-reply-1" class="comment comment-reply">
                                <div class="d-flex">
                                    <div class="comment-img"><img
                                            src="{{ asset('assets-landing-page') }}/img/blog/comments-3.jpg"
                                            alt="">
                                    </div>
                                    <div>
                                        <h5><a href="">Lynda Small</a> <a href="#" class="reply"><i
                                                    class="bi bi-reply-fill"></i> Reply</a></h5>
                                        <time datetime="2020-01-01">01 Jan,2022</time>
                                        <p>
                                            Enim ipsa eum fugiat fuga repellat. Commodi quo quo dicta. Est ullam
                                            aspernatur ut vitae quia mollitia id non. Qui ad quas nostrum rerum sed
                                            necessitatibus aut est. Eum officiis sed repellat maxime vero nisi natus.
                                            Amet nesciunt nesciunt qui illum omnis est et dolor recusandae.

                                            Recusandae sit ad aut impedit et. Ipsa labore dolor impedit et natus in
                                            porro aut. Magnam qui cum. Illo similique occaecati nihil modi eligendi.
                                            Pariatur distinctio labore omnis incidunt et illum. Expedita et dignissimos
                                            distinctio laborum minima fugiat.

                                            Libero corporis qui. Nam illo odio beatae enim ducimus. Harum reiciendis
                                            error dolorum non autem quisquam vero rerum neque.
                                        </p>
                                    </div>
                                </div>

                                <div id="comment-reply-2" class="comment comment-reply">
                                    <div class="d-flex">
                                        <div class="comment-img"><img
                                                src="{{ asset('assets-landing-page') }}/img/blog/comments-4.jpg"
                                                alt=""></div>
                                        <div>
                                            <h5><a href="">Sianna Ramsay</a> <a href="#" class="reply"><i
                                                        class="bi bi-reply-fill"></i> Reply</a></h5>
                                            <time datetime="2020-01-01">01 Jan,2022</time>
                                            <p>
                                                Et dignissimos impedit nulla et quo distinctio ex nemo. Omnis quia
                                                dolores cupiditate et. Ut unde qui eligendi sapiente omnis ullam.
                                                Placeat porro est commodi est officiis voluptas repellat quisquam
                                                possimus. Perferendis id consectetur necessitatibus.
                                            </p>
                                        </div>
                                    </div>

                                </div><!-- End comment reply #2-->

                            </div><!-- End comment reply #1-->

                        </div><!-- End comment #2-->

                        <div id="comment-3" class="comment">
                            <div class="d-flex">
                                <div class="comment-img"><img
                                        src="{{ asset('assets-landing-page') }}/img/blog/comments-5.jpg" alt="">
                                </div>
                                <div>
                                    <h5><a href="">Nolan Davidson</a> <a href="#" class="reply"><i
                                                class="bi bi-reply-fill"></i> Reply</a></h5>
                                    <time datetime="2020-01-01">01 Jan,2022</time>
                                    <p>
                                        Distinctio nesciunt rerum reprehenderit sed. Iste omnis eius repellendus quia
                                        nihil ut accusantium tempore. Nesciunt expedita id dolor exercitationem
                                        aspernatur aut quam ut. Voluptatem est accusamus iste at.
                                        Non aut et et esse qui sit modi neque. Exercitationem et eos aspernatur. Ea est
                                        consequuntur officia beatae ea aut eos soluta. Non qui dolorum voluptatibus et
                                        optio veniam. Quam officia sit nostrum dolorem.
                                    </p>
                                </div>
                            </div>

                        </div><!-- End comment #3 -->

                        <div id="comment-4" class="comment">
                            <div class="d-flex">
                                <div class="comment-img"><img
                                        src="{{ asset('assets-landing-page') }}/img/blog/comments-6.jpg" alt="">
                                </div>
                                <div>
                                    <h5><a href="">Kay Duggan</a> <a href="#" class="reply"><i
                                                class="bi bi-reply-fill"></i> Reply</a></h5>
                                    <time datetime="2020-01-01">01 Jan,2022</time>
                                    <p>
                                        Dolorem atque aut. Omnis doloremque blanditiis quia eum porro quis ut velit
                                        tempore. Cumque sed quia ut maxime. Est ad aut cum. Ut exercitationem non in
                                        fugiat.
                                    </p>
                                </div>
                            </div>

                        </div><!-- End comment #4 -->

                        <div class="reply-form">

                            <h4>Leave a Reply</h4>
                            <p>Your email address will not be published. Required fields are marked * </p>
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input name="name" type="text" class="form-control"
                                            placeholder="Your Name*">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input name="email" type="text" class="form-control"
                                            placeholder="Your Email*">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <input name="website" type="text" class="form-control"
                                            placeholder="Your Website">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <textarea name="comment" class="form-control" placeholder="Your Comment*"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Post Comment</button>

                            </form>

                        </div>

                    </div> --}}

                </div>

                <div class="col-lg-4">

                    <div class="sidebar">

                        <div class="sidebar-item search-form">
                            <h3 class="sidebar-title">Search</h3>
                            <form action="" class="mt-3" id="form-search">
                                @csrf
                                <input type="text" name="keyword">
                                <button type="submit"><i class="bi bi-search" id="icon-search"></i>
                                    <div class="spinner-border text-white spinner-border-sm d-none" id="loading"
                                        role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </button>
                            </form>
                            <ul class="list-group mt-3" id="renderSearch">

                            </ul>
                        </div><!-- End sidebar search formn-->

                        <div class="sidebar-item categories">
                            <h3 class="sidebar-title">Kategori Artikel</h3>
                            <ul class="mt-3">
                                <?php $categories = DB::table('categories')->get(); ?>
                                @foreach ($categories as $category)
                                    <li><a href="javascript:void(0)">{{ $category->name }} </a></li>
                                @endforeach
                            </ul>
                        </div><!-- End sidebar categories-->

                        <div class="sidebar-item recent-posts">
                            <h3 class="sidebar-title">Artikel Terbaru</h3>

                            <div class="mt-3">
                                <?php
                                $all = 'SELECT *, p.created_at, p.updated_at, p.id AS artikel_id , pm.path, c.name AS kategori, u.name AS author FROM posts p JOIN post_media pm ON pm.post_id = p.id JOIN categories c ON c.id = p.category_id JOIN users u ON u.id = p.user_id ORDER BY p.updated_at DESC LIMIT 6';
                                $recents = DB::select($all);
                                ?>
                                @if ($recents > 1)
                                    @foreach ($recents as $recent)
                                        <div class="post-item mt-3">
                                            <img src="{{ $recent->path }}" alt="recent artikel" class="rounded">
                                            <div>
                                                <h4><a href="{{ route('artikelById.landing_page', $recent->artikel_id) }}">{{ $recent->title }}
                                                    </a>
                                                </h4>
                                                <time
                                                    datetime="{{ $recent->updated_at }}">{{ $recent->updated_at }}</time>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>

                        </div><!-- End sidebar recent posts-->

                        <div class="sidebar-item tags">
                            <h3 class="sidebar-title">Tag</h3>
                            <ul class="mt-3">
                                <?php $ta = $artikel[0]->meta_description;
                                $t = explode(',', $ta);
                                ?>
                                @if (is_array($t))
                                    @foreach ($t as $tr)
                                        <li><a href="javascript:void(0)">{{ $tr }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div><!-- End sidebar tags-->

                    </div><!-- End Blog Sidebar -->

                </div>
            </div>

        </div>
    </section>
@endsection

@push('js')
    <script type="text/javascript">
        $('#form-search').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('artikel.search') }}',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#icon-search').addClass('d-none');
                    $('#loading').removeClass('d-none');
                },
                success: function(res) {
                    if (res.statusCode == 200) {
                        $('#renderSearch').html('');
                        if (res.result.length > 1) {
                            $.each(res.result, function(key, val) {
                                const url = `{{ route('artikelById.landing_page', ':id') }}`
                                    .replace(':id', val.id)
                                const components =
                                    `<li class="list-group-item"><a href="${url}">${val.title}</a></li>`
                                $('#renderSearch').append(components)
                            })
                        } else {
                            const url = `{{ route('artikelById.landing_page', ':id') }}`
                                .replace(':id', res.result[0].id)
                            const components =
                                `<li class="list-group-item"><a href="${url}">${res.result[0].title}</a></li>`
                            $('#renderSearch').append(components)
                        }

                    }
                },
                complete: function() {
                    $('#icon-search').removeClass('d-none');
                    $('#loading').addClass('d-none');
                },
                error: function(err) {
                    console.error(err)
                    if (err.status == 404) {
                        const components =
                            `<li class="list-group-item text-danger">${err.responseJSON.message}</li>`
                        $('#renderSearch').append(components)
                    }
                }
            })
        })
    </script>
@endpush
