"use client";
import SidebarContent from "@/components/BlogComponent/SidebarContent";
import SingleBlog from "@/components/BlogComponent/SingleBlog";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import React, { useEffect } from "react";
import AOS from "aos";
import "aos/dist/aos.css";
const blog = () => {
  useEffect(() => {
    AOS.init();
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
                <span className="text-white">Our blog</span>
                <h1 className="text-capitalize mb-5 text-lg">Blog articles</h1>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section
        className="section blog-wrap"
        data-aos="fade-up"
        data-aos-duration="100"
      >
        <div className="container">
          <div className="row">
            <div className="col-lg-8">
              <div className="row">
                <SingleBlog />
                <SingleBlog />
                <SingleBlog />
                <SingleBlog />
              </div>
            </div>

            <SidebarContent />
          </div>

          <div className="row mt-5">
            <div className="col-lg-8">
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
        </div>
      </section>
      <Footer />
    </>
  );
};

export default blog;
