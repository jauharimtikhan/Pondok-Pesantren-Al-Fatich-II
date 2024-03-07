"use client";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import AOS from "aos";
import "aos/dist/aos.css";
import { useEffect } from "react";
const Contact = () => {
  useEffect(() => {
    AOS.init();
  }, []);
  return (
    <>
      <Navigation />
      <section className="page-title bg-1">
        <div className="overlay"></div>
        <div className="container">
          <div className="row">
            <div className="col-md-12">
              <div
                className="block text-center"
                data-aos="fade-up"
                data-aos-duration="250"
              >
                <h1 className="text-capitalize mb-5 text-lg">Hubungi Kami</h1>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="section contact-info pb-0 mb-4 ">
        <div className="container">
          <div className="row">
            <div
              className="col-lg-4 col-sm-6 col-md-6"
              data-aos="fade-up"
              data-aos-duration="300"
            >
              <div className="contact-block mb-4 mb-lg-0 h-100">
                <i
                  className="icofont-live-support "
                  style={{ color: "#016a70" }}
                ></i>
                <h5>Whatsapp</h5>
                +6282 1111 1111
              </div>
            </div>
            <div
              className="col-lg-4 col-sm-6 col-md-6"
              data-aos="fade-up"
              data-aos-duration="600"
            >
              <div className="contact-block mb-4 mb-lg-0 h-100">
                <i
                  className="icofont-support-faq"
                  style={{ color: "#016a70" }}
                ></i>
                <h5>Email</h5>
                pondokpesantrenalfatcih@gmail.com
              </div>
            </div>
            <div
              className="col-lg-4 col-sm-6 col-md-6"
              data-aos="fade-up"
              data-aos-duration="900"
            >
              <div className="contact-block mb-4 mb-lg-0 h-100">
                <i
                  className="icofont-location-pin"
                  style={{ color: "#016a70" }}
                ></i>
                <h5>Lokasi</h5>
                Sentul Timur, Sentul, Kec. Tembelang, Kabupaten Jombang, Jawa
                Timur 61452
              </div>
            </div>
          </div>
        </div>
      </section>

      <Footer />
    </>
  );
};

export default Contact;
