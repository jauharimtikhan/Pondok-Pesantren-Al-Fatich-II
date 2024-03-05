"use client";
import Image from "next/image";
import Link from "next/link";
import { useEffect } from "react";
import toast, { Toaster } from "react-hot-toast";
interface PendigProps {
  pesan: string;
  paymentStatus: string;
  data: any;
  wakafId: string;
  donaturId: string;
  lastAmount: number;
}

const Pending: React.FC<PendigProps> = ({
  pesan,
  paymentStatus,
  data,
  wakafId,
  donaturId,
  lastAmount,
}) => {
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
        donatur_id: donaturId,
        last_amount: lastAmount,
        transaction_id: data.transaction_id,
        transaction_status: data.transaction_status,
      }),
    });
    const datas = await response.json();
    if (datas.statusCode == 200) {
      if (datas.message == "Pending") {
        toast.error(datas.message, {
          duration: 3000,
          position: "top-center",
        });
      }
    }
  };

  useEffect(() => {
    setTimeout(() => {
      handleUpdateAmount();
    }, 2000);
  }, []);
  return (
    <>
      <Toaster />
      <div className="card">
        <div className="card-body">
          <h6 className="">Bayar Sebelum : {data.expiry_time}</h6>
          <div className="p-2 d-flex justify-content-center">
            <div className="custom-card">
              <div className="custom-card-icon">
                <Image
                  src={"/images/pending-1.png"}
                  alt="Icon Pending"
                  width={50}
                  height={50}
                  priority
                />
              </div>
              <div className="custom-card-body">
                <h1 className="custom-card-title">{paymentStatus}</h1>

                <div className="custom-card-bg-detail-payment mt-3">
                  <small>
                    id pembayaran : {"#"}
                    {data.order_id}
                  </small>
                  <br />
                  <span>
                    Bank :{" "}
                    <span className="h5 p-0">
                      <b>{data.va_numbers[0].bank}</b>
                    </span>
                  </span>
                  <br />
                  <div className="row text-center mt-3">
                    <div className="col-12 ">
                      <h5 className="">Jumlah Yang Harus Dibayarkan : </h5>
                      <span className=" h4 my-3">
                        <b> {ConvertRP(data.gross_amount)}</b>
                      </span>
                    </div>
                  </div>
                </div>
                <p className="pt-2">{pesan}</p>
                <p className="text-center">
                  Nomor Virtual Acount{" "}
                  <span className="badge badge-new-primary mt-3">
                    <h3 className="text-white">
                      {" "}
                      {data.va_numbers[0].va_number}
                    </h3>
                  </span>
                </p>
                <small className="mt-0 text-danger">
                  *Silahkan melakukan pembayaran sesuai nominal yang tertera
                </small>
              </div>
            </div>
          </div>

          <div className="row">
            <div className="col-12 col-md-12 col-lg-12 my-1">
              <Link
                href={"/donasi"}
                className="btn btn-secondary d-flex justify-content-center text-white"
              >
                {"<<"} Kembali
              </Link>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default Pending;
