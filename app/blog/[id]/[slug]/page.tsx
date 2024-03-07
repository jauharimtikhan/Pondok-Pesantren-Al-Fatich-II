"use client";
import SidebarContent from "@/components/BlogComponent/SidebarContent";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import { useParams } from "next/navigation";
import AOS from "aos";
import "aos/dist/aos.css";
import { useEffect } from "react";
import Image from "next/image";
import Link from "next/link";
const Page = () => {
  const params = useParams();
  const { id, slug } = params;
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
                <span className="text-white">News details</span>
                <h1 className="text-capitalize mb-5 text-lg">Blog Single</h1>
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
                <div className="col-lg-12 mb-5">
                  <div className="single-blog-item">
                    <Image
                      width={500}
                      height={500}
                      priority
                      src="/images/blog/blog-1.jpg"
                      alt=""
                      className="img-fluid rounded"
                    />

                    <div className="blog-item-content mt-5">
                      <div className="blog-item-meta mb-3">
                        <span className="text-color-2 text-capitalize mr-3">
                          <i className="icofont-book-mark mr-2"></i> Equipment
                        </span>
                        <span className="text-muted text-capitalize mr-3">
                          <i className="icofont-comment mr-2"></i>5 Comments
                        </span>
                        <span className="text-black text-capitalize mr-3">
                          <i className="icofont-calendar mr-2"></i> 28th January
                          2019
                        </span>
                      </div>

                      <h2 className="mb-4 text-md">
                        <a href="blog-single.html">
                          Healthy environment to care with modern equipment
                        </a>
                      </h2>

                      <p className="lead mb-4">
                        Non illo quas blanditiis repellendus laboriosam minima
                        animi. Consectetur accusantium pariatur repudiandae!
                      </p>

                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Possimus natus, consectetur? Illum libero vel
                        nihil nisi quae, voluptatem, sapiente necessitatibus
                        distinctio voluptates, iusto qui. Laboriosam autem, nam
                        voluptate in beatae. Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit. Quae iure officia nihil
                        nemo, repudiandae itaque similique praesentium non aut
                        nesciunt facere nulla, sequi sunt nam temporibus atque
                        earum, ratione, labore.
                      </p>

                      <blockquote className="quote">
                        Iklan Google Ads
                      </blockquote>

                      <p className="lead mb-4 font-weight-normal text-black">
                        The same is true as we experience the emotional
                        sensation of stress from our first instances of social
                        rejection ridicule. We quickly learn to fear and thus
                        automatically.
                      </p>

                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Iste, rerum beatae repellat tenetur incidunt
                        quisquam libero dolores laudantium. Nesciunt quis itaque
                        quidem, voluptatem autem eos animi laborum iusto
                        expedita sapiente.
                      </p>

                      <div className="mt-5 clearfix">
                        <ul className="float-left list-inline tag-option">
                          <li className="list-inline-item">
                            <a href="#">Advancher</a>
                          </li>
                          <li className="list-inline-item">
                            <a href="#">Landscape</a>
                          </li>
                          <li className="list-inline-item">
                            <a href="#">Travel</a>
                          </li>
                        </ul>

                        <ul className="float-right list-inline">
                          <li className="list-inline-item"> Share: </li>
                          <li className="list-inline-item">
                            <a href="#" target="_blank">
                              <i
                                className="icofont-facebook"
                                aria-hidden="true"
                              ></i>
                            </a>
                          </li>
                          <li className="list-inline-item">
                            <a href="#" target="_blank">
                              <i
                                className="icofont-twitter"
                                aria-hidden="true"
                              ></i>
                            </a>
                          </li>
                          <li className="list-inline-item">
                            <a href="#" target="_blank">
                              <i
                                className="icofont-pinterest"
                                aria-hidden="true"
                              ></i>
                            </a>
                          </li>
                          <li className="list-inline-item">
                            <a href="#" target="_blank">
                              <i
                                className="icofont-linkedin"
                                aria-hidden="true"
                              ></i>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-lg-12 mb-5">
                  <div className="row">
                    <div className="col-6 col-md-6 col-lg-6">
                      <div className="card">
                        <div className="card-body">previous</div>
                      </div>
                    </div>
                    <div className="col-6 col-md-6 col-lg-6">
                      <div className="card">
                        <div className="card-body">next</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-lg-12">
                  <div className="comment-area mt-4 mb-5">
                    <h4 className="mb-4">
                      2 Comments on Healthy environment...{" "}
                    </h4>
                    <ul className="comment-tree list-unstyled">
                      <li className="mb-5">
                        <div className="comment-area-box">
                          <div className="comment-thumb float-left">
                            <Image
                              width={600}
                              height={400}
                              priority
                              alt=""
                              src="/images/blog/testimonial1.jpg"
                              className="img-fluid rounded"
                            />
                          </div>

                          <div className="comment-info">
                            <h5 className="mb-1">John</h5>
                            <span>United Kingdom</span>
                            <span className="date-comm">
                              | Posted April 7, 2019
                            </span>
                          </div>
                          <div className="comment-meta mt-2">
                            <Link href="#">
                              <i className="icofont-reply mr-2 text-muted"></i>
                              Reply
                            </Link>
                          </div>

                          <div className="comment-content mt-3">
                            <p>
                              Some consultants are employed indirectly by the
                              client via a consultancy staffing company, a
                              company that provides consultants on an agency
                              basis.{" "}
                            </p>
                          </div>
                        </div>
                      </li>

                      <li>
                        <div className="comment-area-box">
                          <div className="comment-thumb float-left">
                            <Image
                              width={600}
                              height={400}
                              priority
                              alt=""
                              src="/images/blog/testimonial2.jpg"
                              className="img-fluid rounded"
                            />
                          </div>

                          <div className="comment-info">
                            <h5 className="mb-1">Philip W</h5>
                            <span>United Kingdom</span>
                            <span className="date-comm">
                              | Posted June 7, 2019
                            </span>
                          </div>

                          <div className="comment-meta mt-2">
                            <Link href="#">
                              <i className="icofont-reply mr-2 text-muted"></i>
                              Reply{" "}
                            </Link>
                          </div>

                          <div className="comment-content mt-3">
                            <p>
                              Some consultants are employed indirectly by the
                              client via a consultancy staffing company, a
                              company that provides consultants on an agency
                              basis.{" "}
                            </p>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>

                <div className="col-lg-12">
                  <form className="comment-form my-5" id="comment-form">
                    <h4 className="mb-4">Write a comment</h4>
                    <div className="row">
                      <div className="col-md-6">
                        <div className="form-group">
                          <input
                            className="form-control"
                            type="text"
                            name="name"
                            id="name"
                            placeholder="Name:"
                          />
                        </div>
                      </div>
                      <div className="col-md-6">
                        <div className="form-group">
                          <input
                            className="form-control"
                            type="text"
                            name="mail"
                            id="mail"
                            placeholder="Email:"
                          />
                        </div>
                      </div>
                    </div>

                    <textarea
                      className="form-control mb-4 new-form-control"
                      name="comment"
                      id="comment"
                      placeholder="Comment"
                    ></textarea>

                    <button
                      type="submit"
                      className="btn btn-new-primary btn-lg float-right"
                    >
                      Submit
                    </button>
                  </form>
                </div>
              </div>
            </div>
            <SidebarContent />
          </div>
        </div>
      </section>
      <Footer />
    </>
  );
};

export default Page;
