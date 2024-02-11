"use client";
import FeatureCard from "@/components/AboutComponent/FeatureCard";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
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
        style={{ background: 'url("/images/bg/22.jpg") no-repeat 50% 50%' }}
      >
        <div className="overlay"></div>
        <div className="container">
          <div className="row">
            <div className="col-md-12">
              <div className="block text-center">
                <span className="text-white">About Us</span>
                <h1 className="text-capitalize mb-5 text-lg">About Us</h1>
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
              <h2 className="title-color">
                Personal care for your healthy living
              </h2>
            </div>
            <div className="col-lg-8">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Incidunt, quod laborum alias. Vitae dolorum, officia sit! Saepe
                ullam facere at, consequatur incidunt, quae esse, quis ut
                reprehenderit dignissimos, libero delectus.
              </p>
              {/* <img src="images/about/sign.png" alt="" className="img-fluid" /> */}
            </div>
          </div>
        </div>
      </section>

      <section
        className="fetaure-page"
        data-aos="fade-up"
        data-aos-duration="200"
      >
        <div className="container">
          <div className="row">
            <FeatureCard />
            <FeatureCard />
            <FeatureCard />
            <FeatureCard />
          </div>
        </div>
      </section>

      <section
        className="section awards"
        data-aos="fade-up"
        data-aos-duration="300"
      >
        <div className="container">
          <div className="row align-items-center">
            <div className="col-lg-4">
              <h2 className="title-color">Our Doctors achievements </h2>
              <div className="divider mt-4 mb-5 mb-lg-0"></div>
            </div>
            <div className="col-lg-8">
              <div className="row">
                <div className="col-lg-4 col-md-6 col-sm-6">
                  <div className="award-img rounded shadow-sm">
                    <img
                      src="images/about/3.png"
                      alt=""
                      className="img-fluid"
                    />
                  </div>
                </div>
                <div className="col-lg-4 col-md-6 col-sm-6">
                  <div className="award-img rounded shadow-sm">
                    <img
                      src="images/about/4.png"
                      alt=""
                      className="img-fluid"
                    />
                  </div>
                </div>
                <div className="col-lg-4 col-md-6 col-sm-6">
                  <div className="award-img rounded shadow-sm">
                    <img
                      src="images/about/1.png"
                      alt=""
                      className="img-fluid"
                    />
                  </div>
                </div>
                <div className="col-lg-4 col-md-6 col-sm-6">
                  <div className="award-img rounded shadow-sm">
                    <img
                      src="images/about/2.png"
                      alt=""
                      className="img-fluid"
                    />
                  </div>
                </div>
                <div className="col-lg-4 col-md-6 col-sm-6">
                  <div className="award-img rounded shadow-sm">
                    <img
                      src="images/about/5.png"
                      alt=""
                      className="img-fluid"
                    />
                  </div>
                </div>
                <div className="col-lg-4 col-md-6 col-sm-6">
                  <div className="award-img rounded shadow-sm">
                    <img
                      src="images/about/6.png"
                      alt=""
                      className="img-fluid"
                    />
                  </div>
                </div>
              </div>
            </div>
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
                <h2 className="mb-4">Meet Our Specialist</h2>
                <div className="divider mx-auto my-4"></div>
                <p>
                  Today’s users expect effortless experiences. Don’t let
                  essential people and processes stay stuck in the past. Speed
                  it up, skip the hassles
                </p>
              </div>
            </div>
          </div>

          <div className="row">
            <div className="col-lg-3 col-md-6 col-sm-6">
              <div className="team-block mb-5 mb-lg-0">
                <img
                  src="images/team/1.jpg"
                  alt=""
                  className="img-fluid w-100 rounded shadow-sm"
                />

                <div className="content">
                  <h4 className="mt-4 mb-0">
                    <a href="doctor-single.html">John Marshal</a>
                  </h4>
                  <p>Internist, Emergency Physician</p>
                </div>
              </div>
            </div>

            <div className="col-lg-3 col-md-6 col-sm-6">
              <div className="team-block mb-5 mb-lg-0">
                <img
                  src="images/team/2.jpg"
                  alt=""
                  className="img-fluid w-100 rounded shadow-sm"
                />

                <div className="content">
                  <h4 className="mt-4 mb-0">
                    <a href="doctor-single.html">Marshal Root</a>
                  </h4>
                  <p>Surgeon, Сardiologist</p>
                </div>
              </div>
            </div>

            <div className="col-lg-3 col-md-6 col-sm-6">
              <div className="team-block mb-5 mb-lg-0">
                <img
                  src="images/team/3.jpg"
                  alt=""
                  className="img-fluid w-100 rounded shadow-sm"
                />

                <div className="content">
                  <h4 className="mt-4 mb-0">
                    <a href="doctor-single.html">Siamon john</a>
                  </h4>
                  <p>Internist, General Practitioner</p>
                </div>
              </div>
            </div>
            <div className="col-lg-3 col-md-6 col-sm-6">
              <div className="team-block">
                <img
                  src="images/team/4.jpg"
                  alt=""
                  className="img-fluid w-100 rounded shadow-sm"
                />

                <div className="content">
                  <h4 className="mt-4 mb-0">
                    <a href="doctor-single.html">Rishat Ahmed</a>
                  </h4>
                  <p>Orthopedic Surgeon</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section
        className="section testimonial"
        data-aos="fade-up"
        data-aos-duration="500"
      >
        <div className="container">
          <div className="row">
            <div className="col-lg-6 offset-lg-6">
              <div className="section-title">
                <h2 className="mb-4">What they say about us</h2>
                <div className="divider  my-4"></div>
              </div>
            </div>
          </div>
          <div className="row align-items-center">
            <div className="col-lg-6 testimonial-wrap offset-lg-6">
              <div className="testimonial-block">
                <div className="client-info ">
                  <h4>Amazing service!</h4>
                  <span>John Partho</span>
                </div>
                <p>
                  They provide great service facilty consectetur adipisicing
                  elit. Itaque rem, praesentium, iure, ipsum magnam deleniti a
                  vel eos adipisci suscipit fugit placeat. Quibusdam laboriosam
                  eveniet nostrum nemo commodi numquam quod.
                </p>
                <i className="icofont-quote-right"></i>
              </div>

              <div className="testimonial-block">
                <div className="client-info">
                  <h4>Expert doctors!</h4>
                  <span>Mullar Sarth</span>
                </div>
                <p>
                  They provide great service facilty consectetur adipisicing
                  elit. Itaque rem, praesentium, iure, ipsum magnam deleniti a
                  vel eos adipisci suscipit fugit placeat. Quibusdam laboriosam
                  eveniet nostrum nemo commodi numquam quod.
                </p>
                <i className="icofont-quote-right"></i>
              </div>

              <div className="testimonial-block">
                <div className="client-info">
                  <h4>Good Support!</h4>
                  <span>Kolis Mullar</span>
                </div>
                <p>
                  They provide great service facilty consectetur adipisicing
                  elit. Itaque rem, praesentium, iure, ipsum magnam deleniti a
                  vel eos adipisci suscipit fugit placeat. Quibusdam laboriosam
                  eveniet nostrum nemo commodi numquam quod.
                </p>
                <i className="icofont-quote-right"></i>
              </div>

              <div className="testimonial-block">
                <div className="client-info">
                  <h4>Nice Environment!</h4>
                  <span>Partho Sarothi</span>
                </div>
                <p>
                  They provide great service facilty consectetur adipisicing
                  elit. Itaque rem, praesentium, iure, ipsum magnam deleniti a
                  vel eos adipisci suscipit fugit placeat. Quibusdam laboriosam
                  eveniet nostrum nemo commodi numquam quod.
                </p>
                <i className="icofont-quote-right"></i>
              </div>

              <div className="testimonial-block">
                <div className="client-info">
                  <h4>Modern Service!</h4>
                  <span>Kolis Mullar</span>
                </div>
                <p>
                  They provide great service facilty consectetur adipisicing
                  elit. Itaque rem, praesentium, iure, ipsum magnam deleniti a
                  vel eos adipisci suscipit fugit placeat. Quibusdam laboriosam
                  eveniet nostrum nemo commodi numquam quod.
                </p>
                <i className="icofont-quote-right"></i>
              </div>
            </div>
          </div>
        </div>
      </section>
      <Footer />
    </>
  );
};

export default about;
