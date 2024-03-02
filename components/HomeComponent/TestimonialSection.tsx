import React from "react";
import TestimonialComponents from "../partials/TestimonialComponents";

const TestimonialSection = () => {
  return (
    <>
      <section className="section testimonial-2 gray-bg">
        <div className="container">
          <div
            className="row justify-content-center"
            data-aos="fade-up"
            data-aos-duration="1100"
          >
            <div className="col-lg-7">
              <div className="section-title text-center">
                <h2>Harapan Dari Para Donatur</h2>
                <div className="divider mx-auto my-4"></div>
              </div>
            </div>
          </div>
        </div>

        <div className="container" data-aos="fade-up" data-aos-duration="1200">
          <div className="row align-items-center">
            <div className="col-lg-12 testimonial-wrap-2">
              <TestimonialComponents
                name="Anonymous"
                description="Lorem Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, aliquid? ipsum dolor sit, amet consectetur adipisicing elit. Aliquam quaerat consequuntur quas repudiandae error reiciendis aspernatur inventore repellat dolorum, molestias labore officia perspiciatis natus iure quisquam, deserunt quos! Porro, fugiat?"
              />
              <TestimonialComponents
                name="Anonymous"
                description="Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquam quaerat consequuntur quas repudiandae error reiciendis aspernatur inventore repellat dolorum, molestias labore officia perspiciatis natus iure quisquam, deserunt quos! Porro, fugiat?"
              />
              <TestimonialComponents
                name="Anonymous"
                description="Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquam quaerat consequuntur quas repudiandae error reiciendis aspernatur inventore repellat dolorum, molestias labore officia perspiciatis natus iure quisquam, deserunt quos! Porro, fugiat?"
              />
              <TestimonialComponents
                name="Anonymous"
                description="Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquam quaerat consequuntur quas repudiandae error reiciendis aspernatur inventore repellat dolorum, molestias labore officia perspiciatis natus iure quisquam, deserunt quos! Porro, fugiat?"
              />
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default TestimonialSection;
