"use client";
import Logos from "@/public/images/logo/logo-alfatih.png";
import Image from "next/image";

const handleTop = () => {
  window.scrollTo(0, 0);
};
function Footer() {
  return (
    <footer className="footer section gray-bg">
      <div className="container">
        <div className="row">
          <div className="col-lg-4 mr-auto col-sm-6">
            <div className="widget mb-5 mb-lg-0">
              <div className="logo mb-4">
                <Image src={Logos} alt="" className="img-fluid" width={80} />
                <span className="h4">PP Al Fatich 2</span>
              </div>
              <p>
                Yayasan Pendidikan Islam Al Fatich 2 adalah lembaga pendidikan
                yang berkomitmen untuk memberikan pendidikan berkualitas dengan
                nilai-nilai Islam yang kuat. Terletak di Sentul Timur, Sentul,
                Kecamatan Tembelang, Kabupaten Jombang, Jawa Timur 61452
              </p>

              <ul className="list-inline footer-socials mt-4">
                <li className="list-inline-item">
                  <a href="#">
                    <i
                      className="icofont-facebook"
                      style={{ color: "white" }}
                    ></i>
                  </a>
                </li>
                <li className="list-inline-item">
                  <a href="#">
                    <i
                      className="icofont-twitter"
                      style={{ color: "white" }}
                    ></i>
                  </a>
                </li>
                <li className="list-inline-item">
                  <a href="#">
                    <i
                      className="icofont-linkedin"
                      style={{ color: "white" }}
                    ></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <div className="col-lg-2 col-md-6 col-sm-6">
            <div className="widget mb-5 mb-lg-0">
              <h4 className="text-capitalize mb-3">Tautan Cepat</h4>
              <div className="divider mb-4"></div>

              <ul className="list-unstyled footer-menu lh-35">
                <li>
                  <a href="/">Beranda</a>
                </li>
                <li>
                  <a href="/about">Tentang Kami</a>
                </li>
                <li>
                  <a href="/donasi">Wakaf</a>
                </li>
                <li>
                  <a href="/blogs">Artikel</a>
                </li>
                <li>
                  <a href="/contact">Kontak Kami</a>
                </li>
              </ul>
            </div>
          </div>

          <div className="col-lg-2 col-md-6 col-sm-6">
            <div className="widget mb-5 mb-lg-0">
              <h4 className="text-capitalize mb-3">Bantuan</h4>
              <div className="divider mb-4"></div>

              <ul className="list-unstyled footer-menu lh-35">
                <li>
                  <a href="#">Syarat & Ketentuan</a>
                </li>
                <li>
                  <a href="#">Kebijakan pribadi</a>
                </li>
                <li>
                  <a href="#">Dukungan Perusahaan </a>
                </li>
                <li>
                  <a href="#">Lisensi Perusahaan</a>
                </li>
              </ul>
            </div>
          </div>

          <div className="col-lg-3 col-md-6 col-sm-6">
            <div className="widget widget-contact mb-5 mb-lg-0">
              <h4 className="text-capitalize mb-3">Kontak</h4>
              <div className="divider mb-4"></div>

              <div className="footer-contact-block mb-4">
                <div className="icon d-flex align-items-center">
                  <i className="icofont-email mr-3"></i>
                  <span className="h6 mb-0">Email Admin Kami</span>
                </div>
                <h5 className="mt-2">
                  <a
                    target="_blank"
                    className="text-break"
                    href="mailto:pondokpesantrenalfatcih@gmail.com"
                  >
                    pondokpesantrenalfatcih@gmail.com
                  </a>
                </h5>
              </div>

              <div className="footer-contact-block">
                <div className="icon d-flex align-items-center">
                  <i className="icofont-whatsapp mr-3"></i>
                  <span className="h6 mb-0">Whatsapp Admin Kami</span>
                </div>
                <h4 className="mt-2">
                  <a href="#">+62 823 1234 567</a>
                </h4>
              </div>
              <div className="footer-contact-block mt-3">
                <div className="icon d-flex align-items-center">
                  <i className="icofont-location-pin mr-3"></i>
                  <span className="h6 mb-0">Alamat Pondok Pesantren</span>
                </div>
                <div className="mt-2 rounded">
                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15823.648785543863!2d112.23289028866321!3d-7.474948105103801!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7815f4b4b1b267%3A0x48851718a39bd78b!2sSentul%20Timur%2C%20Sentul%2C%20Kec.%20Tembelang%2C%20Kabupaten%20Jombang%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1709377946847!5m2!1sid!2sid"
                    width={200}
                    height={200}
                    className="rounded-lg"
                    style={{ border: 0 }}
                    allowFullScreen={false}
                    loading="lazy"
                    referrerPolicy="no-referrer-when-downgrade"
                  ></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="footer-btm py-4 mt-5">
          <div className="row align-items-center justify-content-between">
            <div className="col-lg-6">
              <div className="copyright">
                &copy; Copyright - {new Date().getFullYear()} PP. Al Fatich 2
                <span className="text-color"></span> by
                <a href="#" target="_blank">
                  {" "}
                  Tim PKM UNWAHA
                </a>
              </div>
            </div>
          </div>

          <div className="row">
            <div className="col-lg-4">
              <span
                onClick={() => handleTop()}
                className="backtop js-scroll-trigger"
              >
                <i className="icofont-long-arrow-up"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
}

export default Footer;
