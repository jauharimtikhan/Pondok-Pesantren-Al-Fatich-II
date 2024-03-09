import React, { useEffect } from "react";
import PartnersComponents from "../partials/PartnersComponents";
import AOS from "aos";
import Image from "next/image";

const ClientSection = () => {
  useEffect(() => {
    AOS.init();
  }, []);

  return (
    <>
      <section className="section " data-aos="fade-up" data-aos-duration="1400">
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-7">
              <div className="section-title text-center">
                <h2>Partner Kami</h2>
                <div className="divider mx-auto my-4"></div>
              </div>
            </div>
          </div>
        </div>

        <div className="container">
          <div className="d-flex justify-content-center">
            <Image
              width={300}
              height={300}
              priority
              src="/images/laziznu.png"
              alt=""
              className="img-fluid"
              style={{ width: "30%" }}
            />
          </div>
        </div>
      </section>
    </>
  );
};

export default ClientSection;
