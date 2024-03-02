"use client";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import ModalComponents from "@/components/partials/bootstrapComponents/ModalComponents";
import Link from "next/link";
import { useSearchParams } from "next/navigation";
import { useEffect, useState } from "react";
import toast, { Toaster } from "react-hot-toast";
const paymentsuccess = () => {
  const searchParams = useSearchParams();
  const id = searchParams.get("order_id");
  const [status, setStatus] = useState([]);

  const handleSatus = async () => {
    const response = await fetch(
      `${process.env.NEXT_PUBLIC_API_URL}/api/payment_status?order_id=${id}`,
      {
        method: "GET",
        headers: {
          Authorization: `${process.env.NEXT_PUBLIC_API_KEY}`,
          "content-type": "application/json",
        },
      }
    );
    const data = await response.json();
    if (data.data.status_code == 200) {
      setStatus(data.data);
    }
  };
  const [show, setShow] = useState(false);

  const handleShow = () => setShow(true);
  const handleClose = () => setShow(false);

  useEffect(() => {
    handleSatus();
  }, [id]);
  return (
    <>
      <Navigation />
      <Toaster />
      <div className="container my-3">
        <div className="row">
          <div className="col-12">
            <div className="card">
              <div className="card-body">
                <h5 className="card-title">Pembayaran Berhasil</h5>
                <p className="card-text">
                  Terimakasih telah membantu kami. Bantuan anda akan kami
                  pergunakan dengan sebaik-baiknya
                </p>
                <Link href="/donasi" className="btn btn-success text-white">
                  Kembali{" "}
                </Link>
                <button
                  type="button"
                  className="btn btn-info mx-3"
                  onClick={handleShow}
                >
                  Download Sertifikat Penghargaan
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <ModalComponents show={show} handleClose={handleClose} />

      <Footer />
    </>
  );
};

export default paymentsuccess;
