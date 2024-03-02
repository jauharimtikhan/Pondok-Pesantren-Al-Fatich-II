"use client";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import Image from "next/image";
import { useParams } from "next/navigation";
import { useEffect, useState } from "react";

export const page = () => {
  const { id } = useParams();
  const [wakafById, setWakafById]: any = useState([]);

  const handleFetchData = async () => {
    const response = await fetch(
      `${process.env.NEXT_PUBLIC_API_URL}/api/wakaf/${id}`,
      {
        headers: {
          Authorization: `${process.env.NEXT_PUBLIC_API_KEY}`,
        },
      }
    );

    const data = await response.json();

    setWakafById(data.data);
  };

  useEffect(() => {
    handleFetchData();
  }, []);
  return (
    <>
      <Navigation />
      <section className="page-title bg-1">
        <div className="overlay"></div>
        <div className="container">
          <div className="row">
            <div className="col-md-12">
              <div className="block text-center">
                <h1 className="text-capitalize mb-5 text-lg">Detail Wakaf</h1>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="section department-single">
        <div className="container">
          <div className="row">
            <div className="col-lg-12">
              <div className="department-img">
                {wakafById.image ? (
                  <Image
                    src={`${process.env.NEXT_PUBLIC_API_URL}/${wakafById.image}`}
                    className="img-fluid"
                    alt="Detail wakaf"
                    style={{ height: "auto", width: "auto" }}
                    width={250}
                    height={250}
                  />
                ) : (
                  <p>Loading Gambar</p>
                )}
              </div>
            </div>
          </div>

          <div className="row">
            <div className="col-lg-8">
              <div className="department-content mt-5">
                <h3 className="text-md">{wakafById?.name}</h3>
                <div className="divider my-4"></div>
                <h4>Info Terkait Wakaf</h4>
                <p>{wakafById?.description}</p>
                <h4>Benefit Yang Akan Anda Dapatkan</h4>
                <p className="lead">{wakafById?.benefit}</p>

                <h3 className="mt-5 mb-4"></h3>
                <div className="divider my-4"></div>
                {/* <div className="row">
              <div className="col-lg-8">
              </div>
            </div> */}
              </div>
            </div>
            <div className="col-lg-4">
              <div className="sidebar-widget schedule-widget mt-5">
                <h5 className="mb-4">Target Wakaf</h5>

                <ul className="list-unstyled">
                  <li className="d-flex justify-content-between align-items-center">
                    <a href="#">Monday - Friday</a>
                    <span>9:00 - 17:00</span>
                  </li>
                  <li className="d-flex justify-content-between align-items-center">
                    <a href="#">Saturday</a>
                    <span>9:00 - 16:00</span>
                  </li>
                  <li className="d-flex justify-content-between align-items-center">
                    <a href="#">Sunday</a>
                    <span>Closed</span>
                  </li>
                </ul>

                <div className="sidebar-contatct-info mt-4">
                  <p className="mb-0">Need Urgent Help?</p>
                  <h3>+23-4565-65768</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <Footer />
    </>
  );
};
