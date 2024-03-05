import Image from "next/image";
import React from "react";

const KegiatanPondokComponents = () => {
  return (
    <div className="col-lg-3 col-md-6 col-sm-6">
      <div className="team-block mb-5 mb-lg-0">
        <Image
          width={600}
          height={400}
          src="/images/about4.jpg"
          alt=""
          priority
          className="img-fluid w-100 rounded-full shadow-sm"
        />

        <div className="content">
          <h4 className="mt-4 mb-0">
            <a href="doctor-single.html">Pengajian Rutin Ba'da Subuh</a>
          </h4>
          <p>Kegiatan Rutin Pondok Pesantren Setalah Sholat Subuh</p>
        </div>
      </div>
    </div>
  );
};

export default KegiatanPondokComponents;
