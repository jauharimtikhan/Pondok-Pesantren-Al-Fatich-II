import CampaignComponents from "../partials/CampaignComponents";

const FeaturesSection = () => {
  return (
    <>
      <section className="features">
        <div className="container">
          <div className="row">
            <div className="col-lg-12">
              <div
                className="feature-block d-lg-flex row justify-content-center"
                style={{ gap: "35px" }}
              >
                <CampaignComponents
                  progres={1}
                  image="/images/bangunan-3.jpg"
                  badgeClass="success"
                  badgeText="Sedang Berlangsung"
                  title="Program Wakaf Tanah Untuk Pembangunan Gedung"
                  link="/donasi/0c632281-0021-43b2-9028-f911fb6f73fe"
                />
                <CampaignComponents
                  progres={0}
                  image="/images/about-2.jpg"
                  badgeClass="danger"
                  badgeText="Belum Terlaksana"
                  title="Program Donasi Al-Qur'an Untuk Anak Yatim"
                  link="/"
                />
                <CampaignComponents
                  progres={0}
                  image="/images/gallery (10).JPG"
                  badgeClass="danger"
                  badgeText="Belum Terlaksana"
                  title="Program Santunan Anak Yatim"
                  link="/"
                />
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default FeaturesSection;
