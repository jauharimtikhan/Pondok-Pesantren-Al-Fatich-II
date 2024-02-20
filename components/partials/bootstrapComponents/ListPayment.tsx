"use client";
import Image from "next/image";

interface ListPaymentProps {
  img: string;
}

const ListPayment: React.FC<ListPaymentProps> = ({ img }) => {
  return (
    <>
      <div className="col-6 my-2" style={{ cursor: "pointer" }}>
        <div className="card h-100">
          <div className="card-body d-flex justify-content-center">
            <Image priority src={img} alt={img} width={100} height={100} />
          </div>
        </div>
      </div>
    </>
  );
};

export default ListPayment;
