"use client";

import FeatureCard from "@/components/AboutComponent/FeatureCard";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import TabPaneComponent from "@/components/partials/bootstrapComponents/FormDonasi";
import AOS from "aos";
import "aos/dist/aos.css";
import Link from "next/link";
import { useEffect } from "react";
const page = () => {
  useEffect(() => {
    AOS.init();
  }, []);
  return (
    <>
      <Navigation />
      <section
        className="page-title bg-1"
        style={{ background: 'url("/images/bg/22.jpg") no-repeat 50% 50%' }}
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
            </div>
          </div>
        </div>
      </section>
      <div className="d-flex justify-content-center">
        <Link href="/wakaf" className="btn btn-success btn-lg text-white mb-4">
          {" "}
          Wakaf Sekarang
        </Link>
      </div>
      <section
        className="fetaure-page"
        data-aos="fade-up"
        data-aos-duration="200"
      >
        <div className="container">
          <div className="row">
            <FeatureCard data-aos="fade-up" data-aos-duration="400" />
            <FeatureCard data-aos="fade-up" data-aos-duration="800" />
            <FeatureCard data-aos="fade-up" data-aos-duration="1200" />
            <FeatureCard data-aos="fade-up" data-aos-duration="1600" />
          </div>
        </div>
      </section>
      <div className="row mt-5 ml-2 mb-5">
        <div className="col-lg-8 ">
          <nav className="pagination py-2 d-inline-block">
            <div className="nav-links">
              <span aria-current="page" className="page-numbers current">
                1
              </span>
              <a className="page-numbers" href="#">
                2
              </a>
              <a className="page-numbers" href="#">
                3
              </a>
              <a className="page-numbers" href="#">
                <i className="icofont-thin-double-right"></i>
              </a>
            </div>
          </nav>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default page;
