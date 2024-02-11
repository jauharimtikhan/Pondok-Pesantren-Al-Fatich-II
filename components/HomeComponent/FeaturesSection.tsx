const FeaturesSection = () => {
  return (
    <>
      <section className="features">
        <div className="container">
          <div className="row">
            <div className="col-lg-12">
              <div className="feature-block d-lg-flex">
                <div
                  className="feature-item mb-5 mb-lg-0"
                  data-aos="fade-up"
                  data-aos-duration="500"
                >
                  <div className="feature-icon mb-4">
                    <i className="icofont-surgeon-alt"></i>
                  </div>
                  <span>24 Hours Service</span>
                  <h4 className="mb-3">Online Appoinment</h4>
                  <p className="mb-4">
                    Get ALl time support for emergency.We have introduced the
                    principle of family medicine.
                  </p>
                  <a
                    href="appoinment.html"
                    className="btn btn-main btn-round-full"
                  >
                    Make a appoinment
                  </a>
                </div>

                <div
                  className="feature-item mb-5 mb-lg-0"
                  data-aos="fade-up"
                  data-aos-duration="1000"
                >
                  <div className="feature-icon mb-4">
                    <i className="icofont-ui-clock"></i>
                  </div>
                  <span>Timing schedule</span>
                  <h4 className="mb-3">Working Hours</h4>
                  <ul className="w-hours list-unstyled">
                    <li className="d-flex justify-content-between">
                      Sun - Wed : <span>8:00 - 17:00</span>
                    </li>
                    <li className="d-flex justify-content-between">
                      Thu - Fri : <span>9:00 - 17:00</span>
                    </li>
                    <li className="d-flex justify-content-between">
                      Sat - sun : <span>10:00 - 17:00</span>
                    </li>
                  </ul>
                </div>

                <div
                  className="feature-item mb-5 mb-lg-0"
                  data-aos="fade-up"
                  data-aos-duration="1500"
                >
                  <div className="feature-icon mb-4">
                    <i className="icofont-support"></i>
                  </div>
                  <span>Emegency Cases</span>
                  <h4 className="mb-3">1-800-700-6200</h4>
                  <p>
                    Get ALl time support for emergency.We have introduced the
                    principle of family medicine.Get Conneted with us for any
                    urgency .
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default FeaturesSection;
