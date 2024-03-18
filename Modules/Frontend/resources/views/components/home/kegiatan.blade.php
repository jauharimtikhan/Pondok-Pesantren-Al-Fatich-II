<div class="col-xl-4 col-md-6 portfolio-item filter-app">
    <div class="portfolio-wrap">
        <a href="{{ asset($kegiatan->image) }}" data-gallery="{{ $kegiatan->name }}" class="glightbox"><img
                src="{{ asset($kegiatan->image) }}" class="img-fluid" alt=""></a>
        <div class="portfolio-info">
            <h4><a href="#" title="Lebih Lengkap">{{ $kegiatan->name }}</a></h4>
            <p>{{ $kegiatan->description }}</p>
        </div>
    </div>
</div>
