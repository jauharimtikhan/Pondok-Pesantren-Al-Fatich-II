import CountUp from "react-countup";
const CtaSection = () => {
  return (
    <>
      <section
        className="cta-section"
        data-aos="fade-up"
        data-aos-duration="800"
      >
        <div className="container rounded-sm">
          <div className="cta position-relative rounded-sm">
            <div className="row">
              <div className="col-lg-4 col-md-6 col-sm-6">
                <div className="counter-stat">
                  <i className="icofont-users-alt-3"></i>
                  <span className="text-break text-wrap">
                    <CountUp start={0} end={100} />
                  </span>
                  <p>Total Donatur</p>
                </div>
              </div>
              <div className="col-lg-4 col-md-6 col-sm-6">
                <div className="counter-stat">
                  <i className="icofont-flag"></i>
                  <span className="text-break text-wrap">
                    <CountUp start={0} prefix="Rp." end={100000} />
                  </span>
                  <p>Total Donasi</p>
                </div>
              </div>

              <div className="col-lg-4 col-md-6 col-sm-6">
                <div className="counter-stat">
                  <i className="icofont-money"></i>
                  <span className="text-break text-wrap">
                    <CountUp start={0} prefix="Rp." end={1000000000} />
                  </span>
                  <p>Target Donasi</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default CtaSection;
