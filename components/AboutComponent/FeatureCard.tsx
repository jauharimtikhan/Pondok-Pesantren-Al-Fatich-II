import Image from "next/image";

const FeatureCard = () => {
  return (
    <div className="col-lg-3 col-md-6">
      <div className="about-block-item mb-5 mb-lg-0">
        <Image
          height={600}
          priority
          width={600}
          src="/images/about/about-1.jpg"
          alt=""
          className="img-fluid w-100 rounded"
        />
        <h4 className="mt-3">Healthcare for Kids</h4>
        <p>
          Voluptate aperiam esse possimus maxime repellendus, nihil quod
          accusantium .
        </p>
      </div>
    </div>
  );
};

export default FeatureCard;
