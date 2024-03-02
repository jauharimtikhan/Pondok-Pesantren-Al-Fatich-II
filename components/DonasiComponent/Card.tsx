import Image from "next/image";
import Link from "next/link";

interface CardProps {
  title: string;
  description: string;
  img: string;
  id: string | number;
}

const Card: React.FC<CardProps> = ({ title, description, img, id }) => {
  return (
    <div className="col-12 col-lg-3 col-md-6">
      <div className="card h-100">
        <Link href={`/donasi/${id}`}>
          <div className="card-image-top">
            <Image
              className=" img-fluid"
              src={`${process.env.NEXT_PUBLIC_API_URL}/${img}`}
              alt="Campaign Wakaf"
              style={{ objectFit: "cover", height: "auto", width: "auto" }}
              width={600}
              height={400}
              priority
            />
          </div>
          <hr />

          <div className="card-body">
            <h4 className="text-dot">{title}</h4>
            <p className="text-truncate" style={{ height: "100px" }}>
              {description}
            </p>
          </div>
        </Link>
      </div>
    </div>
  );
};

export default Card;
