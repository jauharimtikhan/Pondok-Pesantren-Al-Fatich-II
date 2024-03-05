"use client";
import { usePathname, useSearchParams } from "next/navigation";
import Link from "next/link";
import { useRouter } from "next/navigation";
import { useEffect, useState } from "react";
interface PaginationProps {
  page: number;
  totalPages: number;
  path?: string;
  isActive?: boolean;
  setPage: any;
}

const Pagination: React.FC<PaginationProps> = ({
  page,
  totalPages,
  setPage,
}) => {
  const pathName = usePathname();
  const searchParams = useSearchParams();
  const currentPage = Number(searchParams.get("page")) || 1;
  const { replace } = useRouter();
  const [prevPages, setPrevPages] = useState("");
  const [nextPages, setNextPages] = useState("");
  const createPageURL = (pageNumber: number | string) => {
    const params = new URLSearchParams(searchParams);
    params.set("page", pageNumber.toString());
    replace(`${pathName}?${params.toString()}`);
  };
  const handleNextPage = () => {
    setPage((prevPage: number) => prevPage + 1);

    const pages: any = createPageURL(currentPage + 1);
    setNextPages(pages);
  };

  const handlePrevPage = () => {
    setPage((prevPage: number) => prevPage - 1);
    const pages: any = createPageURL(currentPage - 1);
    setPrevPages(pages);
  };

  return (
    <nav className="pagination py-2 d-inline-block">
      <div className="nav-links">
        <Link
          className="page-numbers"
          onClick={handlePrevPage}
          href={prevPages}
        >
          <i className="icofont-thin-double-left"></i>
        </Link>
        <span aria-current="page" className={`page-numbers current`}>
          {page}
        </span>
        <span className="page-numbers">
          <u>dari</u>
        </span>
        <span className="page-numbers">{totalPages ?? 0}</span>
        <Link className="page-numbers" onClick={handleNextPage} href={nextPages}>
          <i className="icofont-thin-double-right"></i>
        </Link>
      </div>
    </nav>
  );
};

export default Pagination;
