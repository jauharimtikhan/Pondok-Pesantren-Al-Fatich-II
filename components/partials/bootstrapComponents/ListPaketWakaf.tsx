"use client";

import { createContext, useState } from "react";

interface ListPaketWakafProps {
  NamaPaket: string;
  HargaPaketWakaf: string;
  TotalWakaf: any;
}

const ListPaketWakaf: React.FC<ListPaketWakafProps> = ({
  NamaPaket,
  HargaPaketWakaf,
  TotalWakaf,
}) => {
  return (
    <div>
      <div
        className="card my-2"
        style={{ cursor: "pointer" }}
        onClick={TotalWakaf}
      >
        <div className="card-body">
          <div className="row">
            <div className="col-6">
              <h5>{NamaPaket}</h5>
            </div>
            <div className="col-6">
              <h5 className="float-right">{HargaPaketWakaf}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ListPaketWakaf;
