import NewsComponents from "../partials/NewsComponents";

const ServiceSection = () => {
  return (
    <>
      <section className="section service gray-bg">
        <div className="container">
          <div
            className="row justify-content-center"
            data-aos="fade-up"
            data-aos-duration="900"
          >
            <div className="col-lg-7 text-center">
              <div className="section-title">
                <h2>Berita Terkini</h2>
                <div className="divider mx-auto my-4"></div>
              </div>
            </div>
          </div>

          <div className="row">
            <NewsComponents />
            <NewsComponents />
            <NewsComponents />
            <NewsComponents />
          </div>
        </div>
      </section>
    </>
  );
};

export default ServiceSection;
