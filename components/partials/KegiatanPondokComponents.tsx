import Image from "next/image";
import Link from "next/link";
import React from "react";

interface KegiatanPondokComponentsProps {
  img: string;
  title: string;
  description: string;
}

const KegiatanPondokComponents: React.FC<KegiatanPondokComponentsProps> = ({
  img,
  title,
  description,
}) => {
  return (
    <div className="col-lg-3 col-md-6 col-sm-6">
      <div className="team-block mb-5 mb-lg-0">
        <Image
          width={6000}
          height={4000}
          src={img}
          alt="Kegiatan Pondok Pesantren Al Fatich 2"
          priority
          className="img-fluid w-100 rounded shadow-sm"
        />

        <div className="content">
          <h4 className="mt-4 mb-0">
            <Link href="#">{title}</Link>
          </h4>
          <p>{description}</p>
        </div>
      </div>
    </div>
  );
};

export default KegiatanPondokComponents;
