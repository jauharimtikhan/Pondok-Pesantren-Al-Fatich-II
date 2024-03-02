"use client";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import FormDonasi from "@/components/partials/bootstrapComponents/FormDonasi";
import { useSearchParams } from "next/navigation";
import { useEffect, useState } from "react";

const wakaf = () => {
  const [paketWakaf, setPaketWakaf]: any = useState([]);
  const [wakafById, setWakafById]: any = useState([]);
  const [loading, setLoading] = useState(false);
  const params = useSearchParams();
  const param = params.get("campaign_id");

  const handlePaketWakaf = async () => {
    setLoading(true);
    const response = await fetch(
      `${process.env.NEXT_PUBLIC_API_URL}/api/paket_wakaf/${param}`,
      {
        headers: {
          Authorization: `${process.env.NEXT_PUBLIC_API_KEY}`,
        },
      }
    );

    const data = await response.json();
    setPaketWakaf(data.result);
    setLoading(false);
  };

  const handleGetWakaf = async () => {
    setLoading(true);
    const response = await fetch(
      `${process.env.NEXT_PUBLIC_API_URL}/api/wakaf/${param}`,
      {
        headers: {
          Authorization: `${process.env.NEXT_PUBLIC_API_KEY}`,
        },
      }
    );

    const data = await response.json();

    setWakafById(data.result);
    setLoading(false);
  };

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

  function formatDonatur(number: number) {
    let result = "";

    if (number >= 1000000000) {
      const billion = Math.floor(number / 1000000000);
      const million = Math.round((number % 1000000000) / 1000000);
      if (million === 0) {
        result = `${billion}M/orang`;
      } else {
        result = `${billion}.${million}M/orang`;
      }
    } else if (number >= 1000000) {
      const million = Math.floor(number / 1000000);
      const thousand = Math.round((number % 1000000) / 1000);
      if (thousand === 0) {
        result = `${million}JT/orang`;
      } else {
        result = `${million}.${thousand}JT/orang`;
      }
    } else if (number >= 1000) {
      const thousand = Math.floor(number / 1000);
      result = `${thousand}K/orang`;
    } else {
      result = `${number}/orang`;
    }

    return result;
  }

  useEffect(() => {
    handlePaketWakaf();
    handleGetWakaf();
  }, [param]);
  return (
    <>
      <Navigation />
      <div className="container my-3">
        <div className="row">
          <div className="col-12 col-md-8 col-lg-8">
            <div className="card">
              <div className="card-body">
                {loading ? (
                  <div className="d-flex justify-content-center">
                    <div className="spinner-border text-success" role="status">
                      <span className="sr-only">Loading...</span>
                    </div>
                  </div>
                ) : (
                  <FormDonasi datas={paketWakaf} />
                )}
              </div>
            </div>
          </div>
          <div className="col-12 col-md-4 col-lg-4">
            <div className="sidebar-widget schedule-widget mt-2">
              <h5 className="mb-4">Informasi Terkait Wakaf</h5>

              <ul className="list-unstyled">
                <li className="form-group">
                  <span className="">Target Wakaf</span>
                  <span className=" float-right">
                    {wakafById.data_wakaf?.target
                      ? ConvertRP(wakafById.data_wakaf.target)
                      : "Loading..."}
                  </span>
                </li>
                <li className="form-group">
                  <span className="">Total Donatur</span>
                  <span className=" float-right">
                    {wakafById?.total_donatur
                      ? formatDonatur(wakafById.total_donatur)
                      : "Loading..."}
                  </span>
                </li>
                <li className="form-group">
                  <span className="text-success">
                    <b>Dana Terkumpul</b>
                  </span>
                  <span className=" float-right">
                    {wakafById.data_wakaf?.last_amount
                      ? wakafById.data_wakaf.last_amount
                      : "Rp. 0"}
                  </span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default wakaf;
