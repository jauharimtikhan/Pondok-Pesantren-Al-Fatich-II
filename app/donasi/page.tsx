"use client";

import FeatureCard from "@/components/AboutComponent/FeatureCard";
import Card from "@/components/DonasiComponent/Card";
import Navigation from "@/components/Navigation";
import Pagination from "@/components/Pagination";
import Footer from "@/components/footer";
import AOS from "aos";
import "aos/dist/aos.css";
import { useEffect, useState } from "react";
const Page = () => {
  const [donasi, setDonasi] = useState([]);
  const [paginate, setPaginate]: any = useState([]);
  const [pesan, setPesan] = useState(false);
  const [page, setPage] = useState(1);

  const handleFetch = async () => {
    setPesan(true);
    const response = await fetch(
      `${process.env.NEXT_PUBLIC_API_URL}/api/wakaf?page=${page}&perPage=10`,
      {
        headers: {
          Authorization: `${process.env.NEXT_PUBLIC_API_KEY}`,
        },
      }
    );
    const data = await response.json();
    // console.log(data);

    setPaginate(data.result);
    setDonasi(data.result.data);
    setPesan(false);
  };

  useEffect(() => {
    AOS.init();
    handleFetch();
  }, [page]);
  return (
    <>
      <Navigation />
      <section
        className="page-title bg-1"
        style={{
          background: 'url("/images/logo/logo-alfatih.png") no-repeat 50% 50%',
        }}
      >
        <div className="overlay"></div>
        <div className="container">
          <div className="row">
            <div className="col-md-12">
              <div className="block text-center">
                <h1 className="text-capitalize mb-5 text-lg">Wakaf Online</h1>
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
              <h2 className="title-color">Wakaf Online</h2>
            </div>
            <div className="col-lg-8">
              <p>
                Program wakaf online adalah sebuah program atau sistem yang
                memungkinkan individu atau organisasi untuk memberikan sumbangan
                atau kontribusi secara finansial melalui internet. Melalui
                program ini, anda sebagai donatur dapat dengan mudah melakukan
                donasi dengan menggunakan berbagai metode pembayaran elektronik
                seperti kartu kredit, transfer bank, atau dompet digital. Dan
                kami selaku penyelenggara program ini akan mendistribusi kan
                sumbangan anda ke yang membutuhkan.
              </p>
              <p>
                Silahkan pilih salah satu program yang sedang berjalan di bawah
                ini!
              </p>
            </div>
          </div>
        </div>
      </section>
      {/* <div className="d-flex justify-content-center">
        {donasi.map((item: any) =>
          item.is_featured > 0 ? (
            <Link
              key={item.id}
              href={`/wakaf?campaign_id=${item.id}&multiple=${}`}
              className="btn btn-success btn-lg text-white mb-4"
            >
              {" "}
              Wakaf Sekarang
            </Link>
          ) : (
            ""
          )
        )}
      </div> */}
      <section
        className="fetaure-page"
        data-aos="fade-up"
        data-aos-duration="200"
      >
        {pesan === true ? (
          <div className="d-flex justify-content-center align-items-center">
            <div className="spinner-border text-success" role="status">
              <span className="sr-only">Loading...</span>
            </div>
          </div>
        ) : (
          ""
        )}
        <div className="container">
          <div className="row">
            {donasi.map((item: any) =>
              donasi.length > 0 ? (
                <Card
                  key={item.id}
                  id={item.id}
                  title={item.name}
                  description={item.description}
                  img={item.image}
                  data-aos="fade-up"
                  data-aos-duration="400"
                />
              ) : (
                <p className="text-center">Tidak ada donasi</p>
              )
            )}
          </div>
        </div>
      </section>
      <div className="row mt-5  mb-5">
        <div className="col-lg-12 d-flex justify-content-center">
          {donasi?.length > 0 ? (
            <Pagination
              page={page}
              totalPages={paginate.total}
              setPage={setPage}
            />
          ) : (
            <p className="text-center"></p>
          )}
        </div>
      </div>
      <Footer />
    </>
  );
};

export default Page;
