import Image from "next/image";
import React from "react";

interface GalleryComponentsProps {
  img: string;
}
const GalleryComponents: React.FC<GalleryComponentsProps> = ({ img }) => {
  return (
    <div className="col-6 col-md-4 col-lg-3 my-1 ">
      <Image
        width={6000}
        height={4000}
        priority
        src={img}
        alt="Galler Pondok Pesantren"
        className="rounded img-fixed "
      />
    </div>
  );
};

export default GalleryComponents;
