import Link from "next/link";

const SidebarContent = () => {
  return (
    <>
      <div className="col-lg-4" data-aos="fade-up" data-aos-duration="100">
        <div className="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
          <div className="sidebar-widget search  mb-3 ">
            <h5>Search Here</h5>
            <form action="#" className="search-form">
              <input
                type="text"
                className="form-control"
                placeholder="search"
              />
              <i className="ti-search"></i>
            </form>
          </div>

          <div className="sidebar-widget latest-post mb-3">
            <h5>Popular Posts</h5>

            <div className="py-2">
              <span className="text-sm text-muted">03 Mar 2018</span>
              <h6 className="my-2">
                <Link href="#">Thoughtful living in los Angeles</Link>
              </h6>
            </div>

            <div className="py-2">
              <span className="text-sm text-muted">03 Mar 2018</span>
              <h6 className="my-2">
                <Link href="#">Vivamus molestie gravida turpis.</Link>
              </h6>
            </div>

            <div className="py-2">
              <span className="text-sm text-muted">03 Mar 2018</span>
              <h6 className="my-2">
                <Link href="#">
                  Fusce lobortis lorem at ipsum semper sagittis
                </Link>
              </h6>
            </div>
          </div>

          <div className="sidebar-widget category mb-3">
            <h5 className="mb-4">Categories</h5>

            <ul className="list-unstyled">
              <li className="align-items-center">
                <Link href="#">Medicine</Link>
                <span>(14)</span>
              </li>
              <li className="align-items-center">
                <Link href="#">Equipments</Link>
                <span>(2)</span>
              </li>
              <li className="align-items-center">
                <Link href="#">Heart</Link>
                <span>(10)</span>
              </li>
              <li className="align-items-center">
                <Link href="#">Free counselling</Link>
                <span>(5)</span>
              </li>
              <li className="align-items-center">
                <Link href="#">Lab test</Link>
                <span>(5)</span>
              </li>
            </ul>
          </div>

          <div className="sidebar-widget tags mb-3">
            <h5 className="mb-4">Tags</h5>

            <Link href="#">Doctors</Link>
            <Link href="#">agency</Link>
            <Link href="#">company</Link>
            <Link href="#">medicine</Link>
            <Link href="#">surgery</Link>
            <Link href="#">Marketing</Link>
            <Link href="#">Social Media</Link>
            <Link href="#">Branding</Link>
            <Link href="#">Laboratory</Link>
          </div>

          <div className="sidebar-widget schedule-widget mb-3">
            <h5 className="mb-4">Iklan Google Ads</h5>

            {/* <ul className="list-unstyled">
              <li className="d-flex justify-content-between align-items-center">
                <a href="#">Monday - Friday</a>
                <span>9:00 - 17:00</span>
              </li>
              <li className="d-flex justify-content-between align-items-center">
                <a href="#">Saturday</a>
                <span>9:00 - 16:00</span>
              </li>
              <li className="d-flex justify-content-between align-items-center">
                <a href="#">Sunday</a>
                <span>Closed</span>
              </li>
            </ul> */}
          </div>
        </div>
      </div>
    </>
  );
};

export default SidebarContent;
