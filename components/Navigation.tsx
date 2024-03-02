import Link from "next/link";

function Navigation() {
  return (
    <header>
      <div className="header-top-bar">
        <div className="container">
          <div className="row align-items-center">
            <div className="col-lg-6">
              <ul className="top-bar-info list-inline-item pl-0 mb-0 d-md-none d-lg-block d-none">
                <li className="list-inline-item">
                  <i className="icofont-location-pin mr-2"></i>Sentul Timur,
                  Sentul, Kec. Tembelang, Kabupaten Jombang, Jawa Timur 61452
                </li>
              </ul>
            </div>
            <div className="col-lg-6">
              <div className="row align-items-center">
                <div className="col-10 col-md-11 col-lg-11">
                  <div className="text-lg-right top-right-bar mt-2 mt-lg-0 ">
                    <Link
                      href="/donasi"
                      className="btn btn-success float-right text-white"
                    >
                      Wakaf Sekarang
                    </Link>
                  </div>
                </div>
                <div className="col-2 col-md-1 col-lg-1">
                  <div
                    className="text-lg-right top-right-bar mt-2 mt-lg-0"
                    style={{ cursor: "pointer" }}
                    data-toggle="modal"
                    data-target="#modalSearch"
                  >
                    <i
                      className="icofont-search-2"
                      style={{ fontSize: "20px" }}
                    ></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <nav className="navbar navbar-expand-lg navigation" id="navbar">
        <div className="container">
          <Link className="navbar-brand text-dark h1 font-weight-bold" href="/">
            <h1 className="text-new-primary">PP Al Fatich 2</h1>
          </Link>

          <button
            className="navbar-toggler collapsed"
            type="button"
            data-toggle="collapse"
            data-target="#navbarmain"
            aria-controls="navbarmain"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span className="icofont-navigation-menu"></span>
          </button>

          <div className="collapse navbar-collapse" id="navbarmain">
            <ul className="navbar-nav ml-auto">
              <li className="nav-item active">
                <Link className="nav-link" href="/">
                  Beranda
                </Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" href="/about">
                  Tentang Kami
                </Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" href="/donasi">
                  Wakaf
                </Link>
              </li>
              {/* <li className="nav-item">
                <Link className="nav-link" href="/blogs">
                  Blog
                </Link>
              </li> */}

              <li className="nav-item">
                <Link className="nav-link" href="/contact">
                  Kontak
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div
        className="modal fade"
        id="modalSearch"
        tabIndex={-1}
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div className="modal-dialog">
          <div className="modal-content">
            <div className="modal-body">
              <form action="" method="post">
                <input
                  type="search"
                  name="search"
                  id="search"
                  autoFocus
                  className="form-control input-search"
                  placeholder="Type here to search..."
                />
              </form>
            </div>
          </div>
        </div>
      </div>
    </header>
  );
}

export default Navigation;
