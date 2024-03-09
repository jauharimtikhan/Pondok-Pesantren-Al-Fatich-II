"use client";
import FeatureCard from "@/components/AboutComponent/FeatureCard";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import GalleryComponents from "@/components/partials/GalleryComponents";
import KegiatanPondokComponents from "@/components/partials/KegiatanPondokComponents";
import AOS from "aos";
import "aos/dist/aos.css";
import { title } from "process";
import { useEffect } from "react";

const dataGallery = [
  {
    id: 1,
    img: "/images/gallery-1.jpg",
  },
  {
    id: 2,
    img: "/images/gallery-2.jpg",
  },
  {
    id: 3,
    img: "/images/gallery-3.jpg",
  },
  {
    id: 4,
    img: "/images/gallery-4.jpg",
  },
  {
    id: 5,
    img: "/images/gallery-5.jpg",
  },
  {
    id: 6,
    img: "/images/gallery-6.jpg",
  },
  {
    id: 7,
    img: "/images/gallery-7.jpg",
  },
  {
    id: 8,
    img: "/images/gallery (1).JPG",
  },
  {
    id: 9,
    img: "/images/gallery (2).JPG",
  },
  {
    id: 10,
    img: "/images/gallery (3).JPG",
  },
  {
    id: 11,
    img: "/images/gallery (4).JPG",
  },
  {
    id: 13,
    img: "/images/gallery (6).JPG",
  },
  {
    id: 14,
    img: "/images/gallery (7).JPG",
  },
  {
    id: 15,
    img: "/images/gallery (8).JPG",
  },
  {
    id: 16,
    img: "/images/gallery (9).JPG",
  },
  {
    id: 17,
    img: "/images/gallery (10).JPG",
  },
  {
    id: 18,
    img: "/images/gallery (11).JPG",
  },
];

const dataKegiatan = [
  {
    id: 1,
    img: "/images/testi-1.png",
    title: "Kegiatan Haul Pondok",
    description:
      "Kegiatan Pondok Pesantren Al Fatich II Dalam Rangka Memperingati Haul Pondok",
  },
  {
    id: 2,
    img: "/images/gallery-2.jpg",
    title: "Kegiatan Pengajian Ba'da ashar",
    description: "Kegiatan Rutin Pondok Pesantren Al Fatich II Ba'da Ashar ",
  },
  {
    id: 3,
    img: "/images/about-3.jpg",
    title: "Kegiatan Pembelajaran Tentang Eco Enzym ",
    description:
      "Kegiatan Pondok Pesantern Al Fatich II Pembelajaran Tentang Eco Enzym ",
  },
  {
    id: 4,
    img: "/images/about4.jpg",
    title: "Kegiatan Keorganisasian Pondok Pesantren Al Fatich II",
    description: "Kegiatan Keorganisasian Pondok Pesantren Al Fatich II ",
  },
];

const About = () => {
  useEffect(() => {
    AOS.init();
  }, []);
  return (
    <>
      <Navigation />
      <section
        className="page-title bg-1"
        style={{
          background: 'url("/images/logo/logo-alfatih.png") no-repeat -2% 50% ',
        }}
      >
        <div className="overlay"></div>
        <div className="container">
          <div className="row">
            <div className="col-md-12">
              <div className="block text-center">
                <h1 className="text-capitalize mb-5 text-lg">Tentang Kami</h1>
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
              <h2 className="title-color">Sejarah Singkat Pondok Pesantren</h2>
            </div>
            <div className="col-lg-8">
              <p>
                Pondok Pesantren Alfatich Bahrul Ulum didirikan tahun 2007
                dengan pembaharuan Piagam tahun 2021 Nomor Statistic Pesantren
                (NSP) ; 512351713036 , berlokasi di Dusun Tambakberas Desa
                Tambakrejo Kec Jombang Kab Jombang. Pada tahun awal berdiri
                menerima santri tingkat SLTP dan SLTA. Sejak tahun 2010 fokus
                menerima santri yang berasal dari kalangan mahasiswi. Kegiatan
                yang diberikan kepada santri putri sbb : Sholat berjamaah,
                mengaji Al-quran dengan metode Yanbua, kajian kitab kuning
                dengan kurikulum Madrasah Diniyah, Diskusi keagamaan, praktek
                keagamaan, praktek pengelolaan lingkungan yang sehat dengan
                membuat Eco Enzym, olahraga dan pengabdian kepada masyarakat.
                Pada Tahun 2019 Pesantren mendirikan sebuah masjid yang
                berlokasi di Desa Sentul Tembelang, berjarak 10 km dari
                Tambakberas. Di Masjid Alfatich ini para santri bisa praktek
                secara langsung untuk penerapan ilmu keagamaannya di masyarakat.
                Pada bulan Agustus 2021 Masjid di resmikan Bupati Jombang, dan
                sejak saat itu di mulai berbagai kegiatan yaitu sholat jumatan,
                pendirian TPQ, Pusat Bahasa Inggris dan Arab,Majelis dzikir dan
                Istighosah, kajian keagamaan, dan santunan yatim rutin tiap
                bulan.
              </p>
              <p>
                Pada tahun 2024 ini Pesantren Alfatich 2 yang berlokasi di
                Sentul Tembelang Jombang, ingin memperluas lahan yang di atasnya
                akan dibangun unit sekolah tingkat SLTP, SLTA, dan Perguruan
                Tinggi. Semua Siswa-siswinya diwajibkan untuk tinggal di Asrama
                Pondok Pesantren. Melalui pendidikan 24 jam ini maka kita bisa
                membekali para generasi muda menjadi calon-calon pemimpin yang
                berakhlakul karimah. Adapun pada tahap pertama ini akan
                dibebaskan lahan seluas 2 ha dengan harga @ Rp.300.000,00.
              </p>
            </div>
          </div>
        </div>
      </section>

      <section className="section gallery-pondok">
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-6">
              <div className="section-title text-center">
                <h2 className="mb-4">Gallery Pondok Pesantren</h2>
                <div className="divider mx-auto my-4"></div>
              </div>
            </div>
          </div>
          <div className=" d-flex justify-content-center">
            <div className="gallery row">
              {dataGallery.map((item) => (
                <GalleryComponents img={item.img} key={item.id} />
              ))}
            </div>
          </div>
        </div>
      </section>

      <section
        className="section team"
        data-aos="fade-up"
        data-aos-duration="400"
      >
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-6">
              <div className="section-title text-center">
                <h2 className="mb-4">Kegiatan Pondok Pesantren</h2>
                <div className="divider mx-auto my-4"></div>
              </div>
            </div>
          </div>

          <div className="row kegiatan-pondok-wrap-2">
            {dataKegiatan.map((item) => (
              <KegiatanPondokComponents
                img={item.img}
                title={item.title}
                description={item.description}
                key={item.id}
              />
            ))}
          </div>
        </div>
      </section>

      <Footer />
    </>
  );
};

export default About;
