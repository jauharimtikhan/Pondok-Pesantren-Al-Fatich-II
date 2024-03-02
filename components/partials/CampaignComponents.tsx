import Image from "next/image";
import React from "react";
import "../partials/styles/campaigncomponents.module.css";

interface CampaignComponentsProps {
  progres: number;
  badgeClass: string;
  badgeText: string;
  title: string;
  link: string;
  image: string;
}

const CampaignComponents: React.FC<CampaignComponentsProps> = ({
  progres,
  badgeClass,
  badgeText,
  title,
  link,
  image,
}) => {
  return (
    <div className="col-12 col-md-4 col-lg-3">
      <div className="card rounded custom-card">
        <div className="card-image-top p-2">
          <Image
            src={image}
            alt="test"
            width={600}
            height={400}
            className="rounded custom-image-program"
          />
        </div>
        <div className="card-body custom-card-body">
          <p>
            <span className={`badge badge-${badgeClass}`}> {badgeText} </span>
          </p>
          <a
            href={link}
            style={{ textDecoration: progres === 0 ? "line-through" : "" }}
          >
            <p className="h4 tet-break text-wrap">{title}</p>
          </a>

          {progres === 0 ? (
            <></>
          ) : (
            <div className="progress custom-fixed-card ">
              <div
                className="progress-bar custom-progress-bar"
                role="progressbar"
                style={{ width: `${progres}%` }}
                aria-valuenow={progres}
                aria-valuemin={0}
                aria-valuemax={100}
              >
                {progres === 0 ? "Off" : `${progres}%`}
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default CampaignComponents;
