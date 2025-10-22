import { useState } from "react";
import axiosInstance from "../axios";
import { useNavigate ,Link} from "react-router-dom";

export default function Register() {
  const navigate = useNavigate();
  const [form, setForm] = useState({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
  });
  const [error, setError] = useState("");

  const handleChange = (e) =>
    setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");

    try {
      // 1️⃣ Get CSRF cookie
       axiosInstance.get("/sanctum/csrf-cookie", {
        withCredentials: true,
      });

      // 2️⃣ Post registration data
       axiosInstance.post("/register", form, {
        withCredentials: true,
      });

      // 3️⃣ Fetch user info (optional, if using context)
      const { data: user } = axiosInstance.get(
        "/api/user",
        { withCredentials: true }
      );

      console.log("Registered user:", user);

      // 4️⃣ Redirect to checkout or home
      navigate("/checkout");
    } catch (err) {
      console.error(err);
      setError(
        err.response?.data?.message || "Registration failed. Please try again."
      );
    }
  };



return (
   <section className="contentContainer contentInfo text-center">
		<div className="container">
			<div className="row">
				<div className="col-xl-4 col-lg-5 col-md-6 col-sm-7 mx-auto">
					<h1>Create Account</h1>
					 {error && <div className="alert alert-danger">{error}</div>}
					<div className="form-group mb-0">
						<form onSubmit={handleSubmit} >
						{/*<label for="Company-name">Company Name</label>*/}
						<input type="text"  name="name" placeholder="Name"  value={form.name} onChange={handleChange} className="w-100"  required />
						
						<input type="email"  name="email" placeholder="E-mail Address" className="w-100"  value={form.email}
            onChange={handleChange} required/>
						<input type="Password"  name="password" placeholder="Password" className="w-100" value={form.password}
            onChange={handleChange} required />
						<input type="text"   name="password_confirmation" placeholder="Confirm Password" className="w-100" value={form.password_confirmation}
            onChange={handleChange} required />
						<input type="submit" className="btn btn-primary min-width-auto mt-2 customBtn01 customBtn01Fill fw-semibold" id="" value="Create" />
						<p>or <Link to="/">Return to Store</Link></p>
						</form>
					</div>
				</div>
			</div>
		</div>
   </section>
);
}
