import Navigation from "@/components/Navigation";
import Footer from "@/components/footer";
import FormDonasi from "@/components/partials/bootstrapComponents/FormDonasi";

const wakaf = () => {
  return (
    <>
      <Navigation />
      <div className="container my-3">
        <div className="card">
          <div className="card-body">
            <FormDonasi />
          </div>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default wakaf;
