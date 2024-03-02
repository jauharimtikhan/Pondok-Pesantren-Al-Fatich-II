"use client";
import FeatureCard from "@/components/AboutComponent/FeatureCard";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import GalleryComponents from "@/components/partials/GalleryComponents";
import KegiatanPondokComponents from "@/components/partials/KegiatanPondokComponents";
import AOS from "aos";
import "aos/dist/aos.css";
import { useEffect } from "react";
const about = () => {
  useEffect(() => {
    AOS.init();
  }, []);
  return (
    <>
      <Navigation />
      <section
        className="page-title bg-1"
        style={{
          background: 'url("/images/logo/logo-alfatih.png") no-repeat -2% 50% ',
        }}
      >
        <div className="overlay"></div>
        <div className="container">
          <div className="row">
            <div className="col-md-12">
              <div className="block text-center">
                <h1 className="text-capitalize mb-5 text-lg">Tentang Kami</h1>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section
        className="section about-page"
        data-aos="fade-up"
        data-aos-duration="100"
      >
        <div className="container">
          <div className="row">
            <div className="col-lg-4">
              <h2 className="title-color">Sejarah Singkat Pondok Pesantren</h2>
            </div>
            <div className="col-lg-8">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Incidunt, quod laborum alias. Vitae dolorum, officia sit! Saepe
                ullam facere at, consequatur incidunt, quae esse, quis ut
                reprehenderit dignissimos, libero delectus. Lorem ipsum dolor
                sit amet consectetur adipisicing elit. Veniam neque reiciendis
                delectus! Eveniet pariatur quam nulla sint quaerat odio eaque.
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fuga
                ab autem aspernatur numquam aliquam perspiciatis quidem
                assumenda harum voluptate laborum fugiat alias dignissimos omnis
                est blanditiis impedit odio unde provident repudiandae rerum
                laudantium, voluptas illo nihil. Exercitationem deleniti nam
                vitae!
              </p>
              {/* <img src="images/about/sign.png" alt="" className="img-fluid" /> */}
            </div>
          </div>
        </div>
      </section>

      <section className="section gallery-pondok">
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-6">
              <div className="section-title text-center">
                <h2 className="mb-4">Gallery Pondok Pesantren</h2>
                <div className="divider mx-auto my-4"></div>
              </div>
            </div>
          </div>
          <div className="row d-flex justify-content-center">
            <GalleryComponents />
            <GalleryComponents />
            <GalleryComponents />
            <GalleryComponents />
            <GalleryComponents />
            <GalleryComponents />
            <GalleryComponents />
            <GalleryComponents />
            <GalleryComponents />
            <GalleryComponents />
          </div>
        </div>
      </section>

      <section
        className="section team"
        data-aos="fade-up"
        data-aos-duration="400"
      >
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-6">
              <div className="section-title text-center">
                <h2 className="mb-4">Kegiatan Pondok Pesantren</h2>
                <div className="divider mx-auto my-4"></div>
              </div>
            </div>
          </div>

          <div className="row kegiatan-pondok-wrap-2">
            <KegiatanPondokComponents />
            <KegiatanPondokComponents />
            <KegiatanPondokComponents />
            <KegiatanPondokComponents />
            <KegiatanPondokComponents />
            <KegiatanPondokComponents />
            <KegiatanPondokComponents />
            <KegiatanPondokComponents />
            <KegiatanPondokComponents />
            <KegiatanPondokComponents />
            <KegiatanPondokComponents />
          </div>
        </div>
      </section>

      <Footer />
    </>
  );
};

export default about;
