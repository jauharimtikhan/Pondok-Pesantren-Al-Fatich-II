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
                    <button className="btn btn-success float-right">
                      Wakaf Sekarang
                    </button>
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
          <a className="navbar-brand text-dark h1 font-weight-bold" href="/">
            <h1 className="text-new-primary">Al Fatih 2</h1>
          </a>

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
                <a className="nav-link" href="/">
                  Beranda
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="/about">
                  About
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="/donasi">
                  Donasi
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="/blogs">
                  Blog
                </a>
              </li>

              <li className="nav-item">
                <a className="nav-link" href="/contact">
                  Contact
                </a>
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
