import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import Link from "next/link";

const paymentsuccess = () => {
  return (
    <>
      <Navigation />
      <div className="container my-3">
        <h1>Pembayaran Berhasil</h1>

        <Link href="/wakaf">Kembali </Link>
      </div>
      <Footer />
    </>
  );
};

export default paymentsuccess;
