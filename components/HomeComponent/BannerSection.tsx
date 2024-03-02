function BannerSection() {
  return (
    <>
      <section
        className="banner"
        style={{
          background:
            ' url("/images/banner-4.jpeg") top center / cover no-repeat',
        }}
      >
        <div className="container">
          <div className="row">
            <div className="col-lg-6 col-md-12 col-xl-7">
              <div className="block">
                <div className="divider mb-3"></div>
                <span className="text-uppercase text-sm d-lg-block d-none letter-spacing text-white">
                  Pondok Pesantren
                </span>
                <span className="text-uppercase text-sm letter-spacing d-lg-none d-block">
                  Pondok Pesantren
                </span>
                <h1 className="mb-3 mt-3 text-white d-lg-block d-none">
                  Al Fatich 2
                </h1>
                <h1 className="mb-3 mt-3 d-lg-none d-block">Al Fatich 2</h1>

                <p className="mb-4 pr-5 d-lg-none d-block">
                  Yayasan Pendidikan Islam Al Fatich 2 adalah lembaga pendidikan
                  yang berkomitmen untuk memberikan pendidikan berkualitas
                  dengan nilai-nilai Islam yang kuat. Terletak di Sentul Timur,
                  Sentul, Kecamatan Tembelang, Kabupaten Jombang, Jawa Timur
                  61452
                </p>
                <p className="mb-4 pr-5 text-white d-lg-block d-none">
                  Yayasan Pendidikan Islam Al Fatich 2 adalah lembaga pendidikan
                  yang berkomitmen untuk memberikan pendidikan berkualitas
                  dengan nilai-nilai Islam yang kuat. Terletak di Sentul Timur,
                  Sentul, Kecamatan Tembelang, Kabupaten Jombang, Jawa Timur
                  61452
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}

export default BannerSection;
