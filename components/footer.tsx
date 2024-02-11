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
                <span className="h4">Al FAtih 2</span>
              </div>
              <p>
                Tempora dolorem voluptatum nam vero assumenda voluptate, facilis
                ad eos obcaecati tenetur veritatis eveniet distinctio possimus.
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
              <h4 className="text-capitalize mb-3">Department</h4>
              <div className="divider mb-4"></div>

              <ul className="list-unstyled footer-menu lh-35">
                <li>
                  <a href="#">Surgery </a>
                </li>
                <li>
                  <a href="#">Wome's Health</a>
                </li>
                <li>
                  <a href="#">Radiology</a>
                </li>
                <li>
                  <a href="#">Cardioc</a>
                </li>
                <li>
                  <a href="#">Medicine</a>
                </li>
              </ul>
            </div>
          </div>

          <div className="col-lg-2 col-md-6 col-sm-6">
            <div className="widget mb-5 mb-lg-0">
              <h4 className="text-capitalize mb-3">Support</h4>
              <div className="divider mb-4"></div>

              <ul className="list-unstyled footer-menu lh-35">
                <li>
                  <a href="#">Terms & Conditions</a>
                </li>
                <li>
                  <a href="#">Privacy Policy</a>
                </li>
                <li>
                  <a href="#">Company Support </a>
                </li>
                <li>
                  <a href="#">FAQuestions</a>
                </li>
                <li>
                  <a href="#">Company Licence</a>
                </li>
              </ul>
            </div>
          </div>

          <div className="col-lg-3 col-md-6 col-sm-6">
            <div className="widget widget-contact mb-5 mb-lg-0">
              <h4 className="text-capitalize mb-3">Get in Touch</h4>
              <div className="divider mb-4"></div>

              <div className="footer-contact-block mb-4">
                <div className="icon d-flex align-items-center">
                  <i className="icofont-email mr-3"></i>
                  <span className="h6 mb-0">Support Available for 24/7</span>
                </div>
                <h4 className="mt-2">
                  <a href="tel:+23-345-67890">Support@email.com</a>
                </h4>
              </div>

              <div className="footer-contact-block">
                <div className="icon d-flex align-items-center">
                  <i className="icofont-support mr-3"></i>
                  <span className="h6 mb-0">Mon to Fri : 08:30 - 18:00</span>
                </div>
                <h4 className="mt-2">
                  <a href="tel:+23-345-67890">+23-456-6588</a>
                </h4>
              </div>
              <div className="footer-contact-block mt-3">
                <div className="icon d-flex align-items-center">
                  <i className="icofont-location-pin mr-3"></i>
                  <span className="h6 mb-0">
                    Sentul Timur, Sentul, Kec. Tembelang, Kabupaten Jombang,
                    Jawa Timur 61452
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="footer-btm py-4 mt-5">
          <div className="row align-items-center justify-content-between">
            <div className="col-lg-6">
              <div className="copyright">
                &copy; Copyright Al Fatih
                <span className="text-color"></span> by
                <a href="#" target="_blank">
                  {" "}
                  Jauhar Imtikhan
                </a>
              </div>
            </div>
            <div className="col-lg-6">
              <div className="subscribe-form text-lg-right mt-5 mt-lg-0">
                <form action="#" className="subscribe">
                  <input
                    type="text"
                    className="form-control"
                    placeholder="Your Email address"
                  />
                  <a href="#" className="btn btn-main-2 btn-round-full">
                    Subscribe
                  </a>
                </form>
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
