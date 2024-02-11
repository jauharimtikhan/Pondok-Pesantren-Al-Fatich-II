import React from "react";

const SingleBlog = () => {
  return (
    <div className="col-lg-12 col-md-12 mb-5">
      <div className="blog-item">
        <div className="blog-thumb">
          <a href="/blog/091238/medical">
            <img
              src="images/blog/blog-1.jpg"
              alt=""
              className="img-fluid rounded"
            />
          </a>
        </div>

        <div className="blog-item-content">
          <div className="blog-item-meta mb-3 mt-4">
            <span className="text-muted text-capitalize mr-3">
              <i className="icofont-comment mr-2"></i>5 Comments
            </span>
            <span className="text-black text-capitalize mr-3">
              <i className="icofont-calendar mr-1"></i> 28th January
            </span>
          </div>

          <h2 className="mt-3 mb-3">
            <a href="/blog/091238/medical">
              Choose quality service over cheap service all type of things
            </a>
          </h2>

          <p className="mb-4">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis
            aliquid architecto facere commodi cupiditate omnis voluptatibus
            inventore atque velit cum rem id assumenda quam recusandae ipsam ea
            porro, dicta ad.
          </p>

          <a
            href="/blog/091238/medical"
            className="btn btn-main btn-icon btn-round-full"
          >
            Read More <i className="icofont-simple-right ml-2  "></i>
          </a>
        </div>
      </div>
    </div>
  );
};

export default SingleBlog;
