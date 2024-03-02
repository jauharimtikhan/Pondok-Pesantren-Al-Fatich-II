"use client";

import { useState } from "react";
import ListPaketWakaf from "./ListPaketWakaf";
import Link from "next/link";
import { useRouter, useSearchParams } from "next/navigation";

interface FormDonasiProps {
  datas: Array<any> | any;
}

function formatRupiah(angka: number) {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
  }).format(angka);
}
const FormDonasi: React.FC<FormDonasiProps> = ({ datas }) => {
  const params = useSearchParams();
  const param: any = params.get("multiple");
  const cleanParam = parseInt(param);
  const campaignId = params.get("campaign_id");
  const [TotalWakaf, setTotalWakaf] = useState(cleanParam);
  const router = useRouter();
  const handleAddWakaf = () => {
    setTotalWakaf((prev: number) => prev + cleanParam);
  };

  const handleMinWakaf = () => {
    if (TotalWakaf > cleanParam) {
      setTotalWakaf((pre: number) => pre - cleanParam);
    }
  };
  const handleBack = () => {
    router.back();
  };

  return (
    <>
      <form action="">
        <div className="form-group">
          <div className="form-total-wakaf">
            <div className="d-flex justify-content-between mb-3">
              <h4>Total Wakaf</h4>
              <button
                type="button"
                onClick={handleBack}
                className="btn btn-success text-white d-lg-none d-md-none d-block"
              >
                &lt;&lt; Kembali
              </button>
            </div>
            <div className="total-wakaf">
              <h4 className="font-weight-bold font-size-18 text-white">
                {formatRupiah(TotalWakaf)}
              </h4>
            </div>
          </div>
          <div className="row">
            <div className="col-12 col-md-6 col-lg-6 d-none d-md-block">
              <div className="field-custom-nilai-wakaf">
                <button
                  type="button"
                  onClick={handleBack}
                  className="btn btn-success text-white "
                >
                  &lt;&lt; Kembali
                </button>
              </div>
            </div>

            <div className="col-12 col-md-6 col-lg-6">
              <div className="field-custom-wakaf float-right">
                <button
                  type="button"
                  className="field-min-custom-wakaf"
                  role="button"
                  onClick={handleMinWakaf}
                >
                  -
                </button>
                <h5 className="text-white align-items-center">
                  {TotalWakaf ? (1 ? TotalWakaf / param : 0 / param) : 0}
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
          {datas.map((data: any) => (
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
            href={`/wakaf/continue?total=${TotalWakaf}&campaign_id=${campaignId}`}
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
