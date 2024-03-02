"use client";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import { useRouter, useSearchParams } from "next/navigation";
import { useEffect, useState } from "react";
import toast, { Toaster } from "react-hot-toast";
const Continue = () => {
  const router = useRouter();
  const [name, setName] = useState("");
  const [phone, setPhone] = useState("");
  const [loader, setLoader] = useState(false);
  const params = useSearchParams();
  const totals = params.get("total");
  const wakafId: string | any = params.get("campaign_id");

  const handleBack = () => {
    router.back();
  };

  const formdata = {
    name: name,
    phone: phone,
    total: totals,
    wakaf_id: wakafId,
  };

  const handleFormSubmit = async (e: any) => {
    e.preventDefault();
    setLoader(true);
    const response = await fetch(
      `${process.env.NEXT_PUBLIC_API_URL}/api/payment`,
      {
        method: "POST",
        headers: {
          Authorization: `${process.env.NEXT_PUBLIC_API_KEY}`,
          "content-type": "application/json",
        },
        body: JSON.stringify(formdata),
      }
    );

    const data = await response.json();

    (window as any).snap.pay(data.snap_token, {
      onSuccess: function (result: any) {
        toast.success("Pembayaran Berhasil", {
          duration: 3000,
          position: "top-center",
        });
        console.log(result);
      },
      onPending: function (result: any) {
        /* You may add your own implementation here */
        toast.success("Pembayaran Sedang Diproses", {
          duration: 3000,
          position: "top-center",
        });
        console.log(result);
      },
      onError: function (result: any) {
        /* You may add your own implementation here */
        toast.error("Pembayaran Gagal", {
          duration: 3000,
          position: "top-center",
        });
        console.log(result);
      },
      onClose: function () {
        // alert("you closed the popup without finishing the payment");
        /* You may add your own implementation here */
        toast.error("Anda Mengakhiri Transaksi", {
          duration: 3000,
          position: "top-center",
        });
      },
    });
    setLoader(false);
  };

  // console.log(total);
  useEffect(() => {
    const SnapUrl = "https://app.sandbox.midtrans.com/snap/snap.js";
    const clientKey: any = process.env.NEXT_PUBLIC_MIDTRANS_CLIENT_KEY;

    const script = document.createElement("script");
    script.src = SnapUrl;
    script.setAttribute("data-client-key", clientKey);
    script.async = true;
    document.body.appendChild(script);
    return () => {
      document.body.removeChild(script);
    };
  });
  return (
    <>
      <Navigation />
      <div className="container my-3">
        <div className="card  mx-auto">
          <div className="card-header">
            <div className="d-flex justify-content-between align-items-center">
              <h3 className="card-title">Pembayaran Wakaf</h3>
              <button
                type="button"
                className="btn btn-success text-white float-right"
                onClick={handleBack}
              >
                Kembali
              </button>
            </div>
          </div>
          <Toaster />
          <div className="card-body">
            <div className="mt-4 row">
              <div className="col-12 ">
                <form action="" method="post" onSubmit={handleFormSubmit}>
                  <input type="hidden" name="wakaf_id" value={wakafId} />
                  <div className="form-group">
                    <label htmlFor="nama">Nama Lengkap</label>
                    <input
                      type="text"
                      name="nama"
                      id="nama"
                      required
                      placeholder="Nama Lengkap"
                      value={name}
                      onChange={(e) => setName(e.target.value)}
                      className="form-control"
                    />
                  </div>
                  <div className="form-group">
                    <label htmlFor="notelp">No Whatsapp</label>
                    <input
                      type="tel"
                      name="notelp"
                      id="notelp"
                      required
                      placeholder="No. Whatsapp"
                      value={phone}
                      onChange={(e) => setPhone(e.target.value)}
                      className="form-control"
                    />
                  </div>
                  <button
                    type="submit"
                    disabled={loader}
                    className="btn btn-success btn-md"
                  >
                    Submit
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default Continue;
