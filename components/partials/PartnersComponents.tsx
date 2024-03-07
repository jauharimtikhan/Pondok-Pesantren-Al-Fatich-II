import Image from "next/image";

const PartnersComponents = () => {
  return (
    <div className="col-lg-2">
      <Image
        width={100}
        height={100}
        priority
        src="../images/laziznu.png"
        alt=""
        className=""
        style={{ width: "100%" }}
      />
      <div className="client-thumb"></div>
    </div>
  );
};

export default PartnersComponents;
