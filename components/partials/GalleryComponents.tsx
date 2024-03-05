import Image from "next/image";
import React from "react";

const GalleryComponents = () => {
  return (
    <div className="col-6 col-md-4 col-lg-3 my-1 ">
      <Image
        width={600}
        height={400}
        priority
        src="/images/about-2.jpg"
        alt=""
        className="rounded-full img-fluid box-shadow-1"
      />
    </div>
  );
};

export default GalleryComponents;
