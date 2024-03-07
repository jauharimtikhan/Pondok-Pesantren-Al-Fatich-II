"use client";

import Image from "next/image";
import Link from "next/link";
import { useEffect } from "react";
import toast, { Toaster } from "react-hot-toast";
interface SuccessProps {
  pesan: string;
  paymentStatus: string;
  data: any;
  wakafId: string;
  donaturId: string;
  lastAmount: number;
}

const Success: React.FC<SuccessProps> = ({
  pesan,
  paymentStatus,
  data,
  wakafId,
  donaturId,
  lastAmount,
}) => {
  const handleDownload = () => {
    const fileUrl = "/images/logo/logo-alfatih.png";
    const link = document.createElement("a");
    link.href = fileUrl;

    link.type = "image/jpg";

    // Tambahkan atribut target untuk menampilkan dalam sebuah iframe jika tipe konten sesuai
    if (link.type === "image/jpg") {
      link.target = "_blank";
    }

    link.setAttribute("download", "sertfikat-wakaf-Ponpes-Al-Fatich 2.jpg");

    document.body.appendChild(link);

    link.click();

    document.body.removeChild(link);
  };

  function ConvertRP(angka: number) {
    let reverse = angka.toString().split("").reverse().join("");
    let ribuan: any = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join(".").split("").reverse().join("");
    return "Rp " + ribuan;
  }

  const handleUpdateAmount = async () => {
    const url = `${process.env.NEXT_PUBLIC_API_URL}/api/payment/update`;
    const response = await fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: `${process.env.NEXT_PUBLIC_API_KEY}`,
      },
      body: JSON.stringify({
        gross_amount: data.gross_amount,
        wakaf_id: wakafId,
        last_amount: lastAmount,
        donatur_id: donaturId,
        transaction_id: data.transaction_id,
        transaction_status: data.transaction_status,
      }),
    });
    const datas = await response.json();
    if (datas.statusCode == 200) {
      // toast.success(datas.message, {
      //   duration: 3000,
      //   position: "top-center",
      // });
    }
  };

  useEffect(() => {
    handleUpdateAmount();
  }, []);
  return (
    <>
      <Toaster />
      <div className="card">
        <div className="card-body">
          <div className="p-2 d-flex justify-content-center">
            <div className="custom-card">
              <div className="custom-card-icon">
                <Image
                  src={"/images/icon-check-1.png"}
                  alt="Icon Check"
                  width={50}
                  height={50}
                  priority
                />
              </div>
              <div className="custom-card-body">
                <h1 className="custom-card-title">{paymentStatus}</h1>
                <p>
                  "Satu sedekah yang tulus sama dengan seribu langkah menuju
                  surga."
                </p>
                <div className="custom-card-bg-detail-payment">
                  <small>
                    id pembayaran : {"#"}
                    {data.order_id}
                  </small>
                  <div className="row text-center">
                    <div className="col-12  ">
                      <h5 className="">Total : </h5>
                      <span className=" h4">
                        <b> {ConvertRP(data.gross_amount)}</b>
                      </span>
                    </div>
                  </div>
                </div>
                <p className="pt-2">{pesan}</p>
              </div>
            </div>
          </div>

          <div className="row">
            <div className="col-12 col-md-6 col-lg-6 my-1">
              <Link
                href={"/donasi"}
                className="btn btn-secondary d-flex justify-content-center text-white"
              >
                {"<<"} Kembali
              </Link>
            </div>
            <div className="col-12 col-md-6 col-lg-6 my-1">
              <button
                onClick={handleDownload}
                className="btn btn-new-primary btn-block text-white"
              >
                Download Sertifikat
              </button>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default Success;
