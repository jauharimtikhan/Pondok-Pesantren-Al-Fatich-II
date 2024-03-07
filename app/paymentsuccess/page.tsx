"use client";
import Navigation from "@/components/Navigation";
import Cancel from "@/components/PaymentComponents/Cancel";
import Expire from "@/components/PaymentComponents/Expire";
import Invalid from "@/components/PaymentComponents/Invalid";
import Pending from "@/components/PaymentComponents/Pending";
import Success from "@/components/PaymentComponents/Success";
import Footer from "@/components/footer";
import ModalComponents from "@/components/partials/bootstrapComponents/ModalComponents";
import Link from "next/link";
import { useSearchParams } from "next/navigation";
import { useEffect, useState } from "react";
import toast, { Toaster } from "react-hot-toast";
const Paymentsuccess = () => {
  const searchParams = useSearchParams();
  const id = searchParams.get("order_id");
  const donaturId: any = searchParams.get("donatur_id");
  const wakafId: any = searchParams.get("wakaf_id");
  const statuspayment = searchParams.get("transaction_status");
  const lastAmount: any = searchParams.get("last_amount");
  const [status, setStatus] = useState([]);
  const [paymentStatus, setPaymentStatus] = useState("");
  const [pesans, setPesans] = useState("");
  const [settlement, setSettlement] = useState(false);
  const [pending, setPending] = useState(false);
  const [cancel, setCancel] = useState(false);
  const [invalid, setInvalid] = useState(false);
  const [expire, setExpire] = useState(false);
  const [loading, setLoading] = useState(false);

  const handleSatus = async () => {
    setLoading(true);
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
    const datas = data.data;
    if (data.data.status_code == 200 || 201) {
      setStatus(data.data);
    }
    if (datas.transaction_status == "settlement") {
      setSettlement(true);
      setPaymentStatus("Lunas");
      setPesans(
        "Terimakasih telah membantu kami. Bantuan anda akan kami pergunakan dengan sebaik-baiknya"
      );
    } else if (datas.transaction_status == "pending") {
      setPending(true);
      setPaymentStatus("Pending");
      setPesans(`Silahkan selesaikan pembayaran terlebih dahulu`);
    } else if (datas.transaction_status == "capture") {
      setSettlement(true);
      setPaymentStatus("Status Pembayaran Anda Berhasil");
      setPesans(
        "Terimakasih telah membantu kami. Bantuan anda akan kami pergunakan dengan sebaik-baiknya"
      );
    } else if (datas.transaction_status == "deny") {
      setInvalid(true);
      setPaymentStatus("Status Pembayaran Anda Invalid");
      setPesans("Pembayaran anda tidak valid");
    } else if (datas.transaction_status == "expire") {
      setExpire(true);
      setPaymentStatus("Status Pembayaran Anda Kadaluarsa");
      setPesans("Pembayaran anda kadaluarsa. Silahkan melakukan order ulang");
    } else if (datas.transaction_status == "cancel") {
      setCancel(true);
      setPaymentStatus("Status Pembayaran Anda Dibatalkan");
      setPesans("Pembayaran anda dibatalkan");
    }
    setLoading(false);
  };

  useEffect(() => {
    handleSatus();
  }, [id, statuspayment, donaturId, wakafId]);
  return (
    <>
      <Navigation />
      <Toaster />
      <div className="container my-3">
        <div className="row">
          <div className="col-12">
            {loading ? (
              <div className="d-flex justify-content-center pb-10 pt-10">
                <div
                  className="spinner-border text-success"
                  role="status"
                ></div>
              </div>
            ) : null}
            {settlement ? (
              <Success
                data={status}
                pesan={pesans}
                paymentStatus={paymentStatus}
                wakafId={wakafId}
                lastAmount={lastAmount}
                donaturId={donaturId}
              />
            ) : null}
            {pending == true ? (
              <Pending
                data={status}
                pesan={pesans}
                paymentStatus={paymentStatus}
                wakafId={wakafId}
                lastAmount={lastAmount}
                donaturId={donaturId}
              />
            ) : null}
            {cancel ? <Cancel /> : ""}
            {invalid ? <Invalid /> : ""}
            {expire ? <Expire /> : ""}
          </div>
        </div>
      </div>

      <Footer />
    </>
  );
};

export default Paymentsuccess;
