import { useEffect, useState } from "react";
import CountUp from "react-countup";

const CtaSection = () => {
  const [totalDonasi, setTotalDonasi]: any = useState(0);
  const [totalDonatur, setTotalDonatur]: any = useState(0);
  useEffect(() => {
    const handleTotal = async () => {
      const response = await fetch(
        `${process.env.NEXT_PUBLIC_API_URL}/api/totaldonasi`,
        {
          headers: {
            "Content-Type": "application/json",
            Authorization: `${process.env.NEXT_PUBLIC_API_KEY}`,
          },
        }
      );

      const data = await response.json();
      const totaldonate = parseInt(data.data.total_donasi);
      const totaldanaturs = parseInt(data.data.total_donatur);
      setTotalDonasi(totaldonate);
      setTotalDonatur(totaldanaturs);
    };

    handleTotal();
  }, []);
  return (
    <>
      <section
        className="cta-section mt-2 mb-5"
        data-aos="fade-up"
        data-aos-duration="800"
      >
        <div className="container rounded-sm">
          <div className="cta position-relative rounded-sm">
            <div className="row">
              <div className="col-lg-4 col-md-12 col-sm-12">
                <div className="counter-stat">
                  <i className="icofont-users-alt-3"></i>
                  <span className="text-break text-wrap text-custom-size">
                    <CountUp start={0} end={totalDonatur} />
                  </span>
                  <p>Total Donatur</p>
                </div>
              </div>
              <div className="col-lg-4 col-md-12 col-sm-12">
                <div className="counter-stat">
                  <i className="icofont-flag"></i>
                  <span className="text-break text-wrap">
                    <CountUp start={0} prefix="Rp." end={totalDonasi} />
                  </span>
                  <p>Total Donasi</p>
                </div>
              </div>

              <div className="col-lg-4 col-md-12 col-sm-12 ">
                <div className="counter-stat">
                  <i className="icofont-money"></i>
                  <span className=" text-wrap text-custom-size">
                    <CountUp start={0} prefix="Rp." end={6000000000} />
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
