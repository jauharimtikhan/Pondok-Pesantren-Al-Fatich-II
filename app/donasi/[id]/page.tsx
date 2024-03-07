"use client";

import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import Image from "next/image";
import Link from "next/link";
import { useParams } from "next/navigation";
import { useEffect, useState } from "react";
const page = () => {
  const { id } = useParams();
  const [wakafById, setWakafById]: any = useState([]);
  const [loading, setLoading] = useState(true);

  function ConvertRP(number: number) {
    let result = "";

    // Check if the number is greater than or equal to 1 billion
    if (number >= 1000000000) {
      const billion = Math.floor(number / 1000000000);
      const million = Math.round((number % 1000000000) / 1000000);
      if (million === 0) {
        result = `${billion}M`;
      } else {
        result = `${billion}.${million}M`;
      }
    } else {
      result = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(number);
    }
    return result;
  }

  useEffect(() => {
    const handleFetchData = async () => {
      try {
        const response = await fetch(
          `${process.env.NEXT_PUBLIC_API_URL}/api/wakaf/${id}`,
          {
            headers: {
              Authorization: `${process.env.NEXT_PUBLIC_API_KEY}`,
            },
          }
        );

        const data = await response.json();

        setWakafById(data.result);
      } catch (error) {
        console.log(error);
      } finally {
        setLoading(false);
      }
    };
    if (loading) {
      handleFetchData();
    }
  }, [loading]);
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
                {wakafById.data_wakaf?.image ? (
                  <Image
                    src={`${process.env.NEXT_PUBLIC_API_URL}/${wakafById.data_wakaf?.image}`}
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
                <h3 className="text-md">
                  {wakafById.data_wakaf?.name
                    ? wakafById.data_wakaf.name
                    : "Loading..."}
                </h3>
                <div className="divider my-4"></div>
                <h4>Info Terkait Wakaf</h4>
                <p>
                  {wakafById.data_wakaf?.description
                    ? wakafById.data_wakaf.description
                    : "Loading..."}
                </p>
                <h4>Benefit Yang Akan Anda Dapatkan</h4>
                <p className="lead">
                  {wakafById.data_wakaf?.benefit
                    ? wakafById.data_wakaf.benefit
                    : "Loading..."}
                </p>

                <h3 className="mt-5 mb-4"></h3>
                <div className="divider my-4"></div>
              </div>
            </div>
            <div className="col-lg-4">
              <div className="sidebar-widget schedule-widget mt-5">
                <h5 className="mb-4">Informasi Terkait Wakaf</h5>

                <ul className="list-unstyled">
                  <li className="d-flex justify-content-between align-items-center">
                    <span>Target Wakaf</span>
                    <span>
                      {wakafById.data_wakaf?.target
                        ? ConvertRP(wakafById.data_wakaf.target)
                        : "Loading..."}
                    </span>
                  </li>
                  <li className="d-flex justify-content-between align-items-center">
                    <span>Total Donatur</span>
                    <span>
                      {wakafById?.total_donatur
                        ? wakafById.total_donatur
                        : "Loading..."}
                    </span>
                  </li>
                  <li className="d-flex justify-content-between align-items-center">
                    <span>Dana Terkumpul</span>
                    <span>
                      {wakafById.data_wakaf?.last_amount
                        ? ConvertRP(wakafById.data_wakaf.last_amount)
                        : "Rp. 0"}
                    </span>
                  </li>
                </ul>

                <div className="sidebar-contatct-info mt-4">
                  <p className="mb-4">Ingin menjadi donatur?</p>
                  <Link
                    href={`/wakaf/?campaign_id=${wakafById.data_wakaf?.id}&multiple=${wakafById?.multiple_price}`}
                    className="btn-lg cta-button"
                  >
                    Wakaf Sekarang
                  </Link>
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

export default page;
