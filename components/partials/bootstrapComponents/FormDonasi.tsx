"use client";

import { InputMask } from "@react-input/mask";
import { useState } from "react";
import ListPaketWakaf from "./ListPaketWakaf";
import Link from "next/link";

const Datas = [
  {
    id: 1,
    name: "Paket 1",
    price: 250000,
  },
  {
    id: 2,
    name: "Paket 2",
    price: 500000,
  },
  {
    id: 3,
    name: "Paket 3",
    price: 750000,
  },
  {
    id: 4,
    name: "Paket 4",
    price: 1000000,
  },
];
const FormDonasi = () => {
  const [TotalWakaf, setTotalWakaf] = useState(250000);
  const handleAddWakaf = () => {
    setTotalWakaf(TotalWakaf + 250000);
  };

  const handleMinWakaf = () => {
    if (TotalWakaf == 1) {
      setTotalWakaf(1);
    } else {
      setTotalWakaf(TotalWakaf - 250000);
    }
  };

  function formatRupiah(angka: number) {
    let reverse = angka.toString().split("").reverse().join("");
    let ribuan: any = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join(".").split("").reverse().join("");
    return "Rp " + ribuan;
  }

  return (
    <>
      <form action="">
        <div className="form-group">
          <div className="form-total-wakaf">
            <h4>Total Wakaf</h4>
            <div className="total-wakaf">
              <h4 className="font-weight-bold font-size-18 text-white">
                {formatRupiah(TotalWakaf)}
              </h4>
            </div>
          </div>
          <div className="row">
            <div className="col-12">
              <div className="field-custom-wakaf float-right">
                <button
                  type="button"
                  className="field-min-custom-wakaf"
                  role="button"
                  onClick={handleMinWakaf}
                >
                  -
                </button>
                <h5 className="text-white">
                  {TotalWakaf ? (1 ? TotalWakaf / 250000 : 0 / 250000) : 0}
                </h5>
                <button
                  type="button"
                  className="field-add-custom-wakaf"
                  onClick={handleAddWakaf}
                >
                  +
                </button>
              </div>
            </div>
          </div>
        </div>
        <div className="form-group">
          <h5>Atau Rekomendasi Jumlah Paket</h5>
        </div>
        <div className="form-group">
          {Datas.map((data) => (
            <ListPaketWakaf
              key={data.id}
              NamaPaket={data.name}
              HargaPaketWakaf={formatRupiah(data.price)}
              TotalWakaf={() => setTotalWakaf(data.price)}
            />
          ))}
        </div>

        <div className="form-group d-flex justify-content-center">
          <Link
            href={"/wakaf/continue?total=" + TotalWakaf}
            className="btn btn-success-new rounded w-50"
          >
            Lanjut
          </Link>
        </div>
      </form>
    </>
  );
};

export default FormDonasi;
