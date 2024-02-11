function BannerSection() {
  return (
    <>
      <section
        className="banner"
        style={{ background: ' url("/images/bg/slider-bg-1.jpg") no-repeat' }}
      >
        <div className="container">
          <div className="row">
            <div className="col-lg-6 col-md-12 col-xl-7">
              <div className="block">
                <div className="divider mb-3"></div>
                <span className="text-uppercase text-sm letter-spacing">
                  Total Health care solution
                </span>
                <h1 className="mb-3 mt-3">Your most trusted health partner</h1>

                <p className="mb-4 pr-5">
                  A repudiandae ipsam labore ipsa voluptatum quidem quae
                  laudantium quisquam aperiam maiores sunt fugit, deserunt rem
                  suscipit placeat.
                </p>
                <div className="btn-container">
                  <a
                    href="appoinment.html"
                    target="_blank"
                    className="btn btn-main-2 btn-icon btn-round-full"
                  >
                    Make appoinment{" "}
                    <i className="icofont-simple-right ml-2"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}

export default BannerSection;
