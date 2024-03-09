import Image from "next/image";
import React from "react";
import style from "./styles/maintenance.module.css";
const MaintenaceMode = () => {
  return (
    <>
      <div className={style.maintenance}>
        <div className={style.maintenance_contain}>
          <Image
            width={398}
            height={249}
            priority
            src="https://demo.wpbeaveraddons.com/wp-content/uploads/2018/02/main-vector.png"
            alt="maintenance"
          />
          <span className={style.pp_infobox_title_prefix}>
            WE ARE COMING SOON
          </span>
          <div className={`${style}.pp-infobox-title`}>
            <h3 className={`${style}.pp-infobox-title`}>
              The website under maintenance!
            </h3>
          </div>
          <div className={`${style}.pp-infobox-description`}>
            <p>
              Someone has kidnapped our site. We are negotiation ransom and
              <br />
              will resolve this issue in 24/7 hours
            </p>{" "}
          </div>
        </div>
      </div>
    </>
  );
};

export default MaintenaceMode;
