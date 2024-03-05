import Image from "next/image";
import React from "react";

const NewsComponents = () => {
  return (
    <div className="col-12 my-3">
      <div className="card">
        <div className="card-body">
          <div className="row">
            <div className="col-7" style={{ cursor: "pointer" }}>
              <Image
                src="/images/blog/blog-1.jpg"
                width={600}
                height={400}
                alt="test"
                className="img-fluid rounded"
              />
            </div>
            <div className="col-5">
              <h3 className="card-title" style={{ cursor: "pointer" }}>
                Berita Terkini
              </h3>
              <p className="text-truncate" style={{ cursor: "pointer" }}>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi
                similique culpa enim aliquid, obcaecati saepe esse. Impedit
                vitae laborum quaerat officia, mollitia atque nisi veniam
                ratione assumenda rem iusto recusandae. Lorem, ipsum dolor sit
                amet consectetur adipisicing elit. Quo necessitatibus doloremque
                nostrum. Laudantium, voluptate dolor? Animi dolores odit ipsum
                voluptates.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default NewsComponents;
