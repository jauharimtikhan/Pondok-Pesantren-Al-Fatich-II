"use client";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import { useRouter } from "next/navigation";
import { useEffect, useState } from "react";
import ListPayment from "@/components/partials/bootstrapComponents/ListPayment";

const Continue = () => {
  const router = useRouter();
  const [name, setName] = useState("");
  const [phone, setPhone] = useState("");
  const [loader, setLoader] = useState(false);
  const params = new URLSearchParams(window.location.search);
  const totals = params.get("total");

  const handleBack = () => {
    router.back();
  };

  const formdata = {
    name: name,
    phone: phone,
    total: totals,
  };

  const handleFormSubmit = async (e: any) => {
    e.preventDefault();

    const response = await fetch("http://localhost:8000/api/payment", {
      method: "POST",
      headers: {
        Authorization: `${process.env.NEXT_PUBLIC_API_KEY}`,
        "content-type": "application/json",
      },
      body: JSON.stringify(formdata),
    });

    const data = await response.json();

    (window as any).snap.pay(data.snap_token);
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
                className="btn btn-warning text-white float-right"
                onClick={handleBack}
              >
                Kembali
              </button>
            </div>
          </div>

          <div className="card-body">
            <div className="mt-4 row">
              <div className="col-12 ">
                <form action="" method="post" onSubmit={handleFormSubmit}>
                  <div className="form-group">
                    <label htmlFor="nama">Nama Lengkap</label>
                    <input
                      type="text"
                      name="nama"
                      id="nama"
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
                      value={phone}
                      onChange={(e) => setPhone(e.target.value)}
                      className="form-control"
                    />
                  </div>
                  <button type="submit" className="btn btn-success btn-md">
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
