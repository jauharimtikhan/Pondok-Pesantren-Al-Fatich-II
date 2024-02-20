"use client";
import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import { useRouter } from "next/navigation";
import { useEffect, useState } from "react";
import ListPayment from "@/components/partials/bootstrapComponents/ListPayment";

const Continue = () => {
  const router = useRouter();
  const [payments, setPayments] = useState([]);
  const [loader, setLoader] = useState(false);
  const params = new URLSearchParams();
  const total = params.get("total");

  const handleBack = () => {
    router.back();
  };

  useEffect(() => {
    const fetchListPayment = async () => {
      setLoader(true);
      const response = await fetch(
        `${process.env.NEXT_PUBLIC_API_URL}/api/list_payment`,
        {
          headers: {
            Authorization: `${process.env.NEXT_PUBLIC_API_KEY}`,
          },
        }
      );
      const JsonData = await response.json();
      setPayments(JsonData.data);
      // console.log(JsonData.data);
      setLoader(false);
    };
    fetchListPayment();
  }, []);

  return (
    <>
      <Navigation />
      <div className="container my-3">
        <div className="card">
          <div className="card-body">
            <button
              type="button"
              className="btn btn-warning"
              onClick={handleBack}
            >
              Kembali
            </button>
            {loader && (
              <div className="d-flex justify-content-center">
                <div className="spinner-border text-primary" role="status">
                  <span className="sr-only">Loading...</span>
                </div>
              </div>
            )}
            <div className="mt-4 row">
              {payments.map((payment: any) => (
                <ListPayment
                  key={payment.payments_id}
                  img={payment.payments_logo}
                />
              ))}
            </div>
          </div>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default Continue;
