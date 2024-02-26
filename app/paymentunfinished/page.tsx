import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import Link from "next/link";

const paymentunfinished = () => {
  return (
    <>
      <Navigation />
      <div className="container my-3">
        <h1>Pembayaran Tidak Di Lanjutkan</h1>

        <Link href="/wakaf">Kembali </Link>
      </div>
      <Footer />
    </>
  );
};

export default paymentunfinished;
