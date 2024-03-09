import Image from "next/image";

const AboutSection = () => {
  return (
    <>
      <section
        className="section about"
        data-aos="fade-up"
        data-aos-duration="700"
      >
        <div className="container">
          <div className="row align-items-center">
            <div className="col-lg-4 col-sm-6">
              <div className="about-img">
                <Image
                  width={500}
                  height={500}
                  priority
                  src="/images/about-1.jpg"
                  alt=""
                  className="img-fluid"
                />
                <Image
                  width={500}
                  height={500}
                  priority
                  src="/images/about-2.jpg"
                  alt=""
                  className="img-fluid mt-4"
                />
              </div>
            </div>
            <div className="col-lg-4 col-sm-6">
              <div className="about-img mt-4 mt-lg-0">
                <Image
                  width={500}
                  height={500}
                  priority
                  src="/images/gallery (2).JPG"
                  alt=""
                  className="img-fluid"
                />
              </div>
            </div>
            <div className="col-lg-4">
              <div className="about-content pl-4 mt-4 mt-lg-0">
                <h2 className="title-color">Tentang Kami</h2>
                <p className="mt-4 mb-5">
                  Yayasan Pendidikan Islam Al Fatich 2 adalah lembaga pendidikan
                  yang berkomitmen untuk memberikan pendidikan berkualitas
                  dengan nilai-nilai Islam yang kuat. Terletak di Sentul Timur,
                  Sentul, Kecamatan Tembelang, Kabupaten Jombang, Jawa Timur
                  61452
                </p>

                <a
                  href="/about"
                  className="btn btn-new-main-2 btn-round-full btn-icon text-new-main-2"
                >
                  Tentang Kami
                  <i className="icofont-simple-right ml-3"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default AboutSection;
