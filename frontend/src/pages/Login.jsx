// src/pages/Login.jsx
import { useState } from "react";
import { useNavigate, useLocation,Link } from "react-router-dom";
import axiosInstance from "../axios";
import { useAuth } from "../utils/AuthContext";
import { useCart } from "../utils/CartContext";

export default function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const navigate = useNavigate();
  const location = useLocation();
  const { login } = useAuth();
   const { cart } = useCart(); // ✅ Access cart

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");

    try {
      // Step 1: Get CSRF token
      await axiosInstance.get("/sanctum/csrf-cookie");

      // Step 2: Attempt login
      await axiosInstance.post("/login", {
        email,
        password,
      });

      // Step 3: Get authenticated user info
      const userRes = await axiosInstance.get("/api/user");
      console.log(userRes)
      login(userRes.data);

       // ✅ Step 4: Redirect logic
      if (cart && cart.length > 0) {
      	console.log(cart.length)
        navigate("/checkout");
      } else {
        const redirectTo = "/my-account";
        console.log(redirectTo)
        navigate(redirectTo);
      }
    } catch (err) {
      console.error(err);
      setError("Invalid credentials or server error.");
    }
  };
return (
   <section className="contentContainer contentInfo text-center">
		<div className="container">
			<div className="row">
				<div className="col-xl-4 col-lg-5 col-md-6 col-sm-7 mx-auto">
					<h1>Login</h1>
					
					{error && 
					<div className="note form-error mb-3">
						<ul className="disc mb-0"><li>{error}</li></ul>
					</div>
					}
						
					
					<form className="form-group mb-0" onSubmit={handleSubmit}>
						{/*<input type="email" placeholder="E-mail Address" className="w-100" id="e-mail-address" aria-describedby="e-mail-address" />*/}
						<input type="email" className="w-100" value={email} onChange={(e) => setEmail(e.target.value)} placeholder="E-mail Address" required />

						{/*<input type="Password" placeholder="Password" className="w-100" id="password" aria-describedby="password" />*/}
						<input type="password"   className="w-100" value={password} onChange={(e) => setPassword(e.target.value)}  placeholder="Password" required />
						
						<p className="mb-3"><Link to="/forgot-password">Create an account?</Link></p>
						<button type="submit" className="btn btn-primary min-width-auto mt-2 customBtn01 customBtn01Fill fw-semibold" id="">Sign In</button>
						
						<p>or <Link to="/">Return to Store</Link></p>
					</form>
				</div>
			</div>
		</div>
   </section>
);
}
