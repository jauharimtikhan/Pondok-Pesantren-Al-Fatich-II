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
                <a href="#">Thoughtful living in los Angeles</a>
              </h6>
            </div>

            <div className="py-2">
              <span className="text-sm text-muted">03 Mar 2018</span>
              <h6 className="my-2">
                <a href="#">Vivamus molestie gravida turpis.</a>
              </h6>
            </div>

            <div className="py-2">
              <span className="text-sm text-muted">03 Mar 2018</span>
              <h6 className="my-2">
                <a href="#">Fusce lobortis lorem at ipsum semper sagittis</a>
              </h6>
            </div>
          </div>

          <div className="sidebar-widget category mb-3">
            <h5 className="mb-4">Categories</h5>

            <ul className="list-unstyled">
              <li className="align-items-center">
                <a href="#">Medicine</a>
                <span>(14)</span>
              </li>
              <li className="align-items-center">
                <a href="#">Equipments</a>
                <span>(2)</span>
              </li>
              <li className="align-items-center">
                <a href="#">Heart</a>
                <span>(10)</span>
              </li>
              <li className="align-items-center">
                <a href="#">Free counselling</a>
                <span>(5)</span>
              </li>
              <li className="align-items-center">
                <a href="#">Lab test</a>
                <span>(5)</span>
              </li>
            </ul>
          </div>

          <div className="sidebar-widget tags mb-3">
            <h5 className="mb-4">Tags</h5>

            <a href="#">Doctors</a>
            <a href="#">agency</a>
            <a href="#">company</a>
            <a href="#">medicine</a>
            <a href="#">surgery</a>
            <a href="#">Marketing</a>
            <a href="#">Social Media</a>
            <a href="#">Branding</a>
            <a href="#">Laboratory</a>
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
