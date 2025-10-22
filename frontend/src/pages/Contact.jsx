import { useState } from "react";
import axiosInstance from "../axios";
import { Link } from "react-router-dom";

const Contact = () => {
  const [formData, setFormData] = useState({
    company_name: "",
    first_name: "",
    last_name: "",
    email: "",
    phone: "",
    comments: "",
  });

  const [errors, setErrors] = useState({});
  const [success, setSuccess] = useState("");

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
    setErrors({ ...errors, [e.target.name]: "" }); // clear error as user types
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setErrors({});
    setSuccess("");

    try {
      const res = await axiosInstance.post("/api/contact", formData);
      setSuccess(res.data.message);
      setFormData({
        company_name: "",
        first_name: "",
        last_name: "",
        email: "",
        phone: "",
        comments: "",
      });
    } catch (err) {
      if (err.response?.status === 422) {
        setErrors(err.response.data.errors || {});
      } else {
        setErrors({ general: "Something went wrong. Please try again." });
      }
    }
  };

  return (
    <section className="contentContainer contentInfo">
      <div className="container">
        <div className="row">
          <div className="col-md-12">
            <h1 className="text-uppercase">CONTACT US</h1>
            <div className="contactInfo">
              <h2 className="pb-0">HAVE A QUESTION?</h2>
              <h3>Speak with Customer Service:</h3>
              <p>1-800-243-5360,2</p>
              <p>
                <a href="mailto:customer.service@greenfield.com">
                  customer.service@greenfield.com
                </a>
              </p>
              <h3>Speak to A Live Sales Person (M-F 8AM-5PM EST):</h3>
              <p>1-800-243-5360,1</p>
              <h3>Email Marketing:</h3>
              <p>
                <a href="mailto:marketing@greenfield.com">marketing@greenfield.com</a>
              </p>
              <h3>Technical Questions &amp; Documentation Requests:</h3>
              <p>
                <a href="mailto:techsupport@greenfield.com">techsupport@greenfield.com</a>
              </p>
              <h3>Speak with Accounting:</h3>
              <p>1-800-243-5360,3</p>
              <h3>
                <Link className="text-blue" to="/faqs">
                  Frequently Asked Questions
                </Link>
              </h3>
              <br />
            </div>

            <div className="contactForm mt-2">
              <h2>REQUEST A QUOTE / SUPPORT PRICING</h2>

              {success && <div className="alert alert-success">{success}</div>}
              {errors.general && <div className="alert alert-danger">{errors.general}</div>}

              <form onSubmit={handleSubmit} noValidate>
                <div className="form-group mb-2">
                  <label htmlFor="company_name">Company Name</label>
                  <input
                    type="text"
                    name="company_name"
                    value={formData.company_name}
                    onChange={handleChange}
                    className="form-control"
                    id="company_name"
                  />
                  {errors.company_name && (
                    <small className="text-danger">{errors.company_name[0]}</small>
                  )}
                </div>

                <div className="form-group mb-2">
                  <label htmlFor="first_name">First Name *</label>
                  <input
                    type="text"
                    name="first_name"
                    value={formData.first_name}
                    onChange={handleChange}
                    className="form-control"
                    id="first_name"
                    required
                  />
                  {errors.first_name && (
                    <small className="text-danger">{errors.first_name[0]}</small>
                  )}
                </div>

                <div className="form-group mb-2">
                  <label htmlFor="last_name">Last Name *</label>
                  <input
                    type="text"
                    name="last_name"
                    value={formData.last_name}
                    onChange={handleChange}
                    className="form-control"
                    id="last_name"
                    required
                  />
                  {errors.last_name && (
                    <small className="text-danger">{errors.last_name[0]}</small>
                  )}
                </div>

                <div className="form-group mb-2">
                  <label htmlFor="email">E-mail Address *</label>
                  <input
                    type="email"
                    name="email"
                    value={formData.email}
                    onChange={handleChange}
                    className="form-control"
                    id="email"
                    required
                  />
                  {errors.email && (
                    <small className="text-danger">{errors.email[0]}</small>
                  )}
                </div>

                <div className="form-group mb-2">
                  <label htmlFor="phone">Phone Number</label>
                  <input
                    type="text"
                    name="phone"
                    value={formData.phone}
                    onChange={handleChange}
                    className="form-control"
                    id="phone"
                  />
                  {errors.phone && (
                    <small className="text-danger">{errors.phone[0]}</small>
                  )}
                </div>

                <div className="form-group mb-2">
                  <label htmlFor="comments">Comments *</label>
                  <textarea
                    name="comments"
                    value={formData.comments}
                    onChange={handleChange}
                    className="form-control"
                    id="comments"
                    rows="3"
                    required
                  ></textarea>
                  {errors.comments && (
                    <small className="text-danger">{errors.comments[0]}</small>
                  )}
                </div>

                <button
                  type="submit"
                  className="btn btn-primary mt-3 customBtn01 customBtn01Fill"
                >
                  Submit
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Contact;
