import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import Link from "next/link";

const paymenterror = () => {
  return (
    <>
      <Navigation />
      <div className="container my-3">
        <h1>Pembayaran Error</h1>

        <Link href="/wakaf">Kembali </Link>
      </div>
      <Footer />
    </>
  );
};

export default paymenterror;
