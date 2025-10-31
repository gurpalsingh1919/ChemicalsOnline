// src/pages/Checkout.jsx
import React, { useEffect, useState } from "react";
import { useNavigate, Link } from "react-router-dom";
import { useAuth } from "../utils/AuthContext";
import { useCart } from "../utils/CartContext";
import axiosInstance from "../axios";

export default function Checkout() {
  const { user, loading } = useAuth();
  const { distinctCount, cart, total, clearCart } = useCart();
  const navigate = useNavigate();

  const [isPlacingOrder, setIsPlacingOrder] = useState(false);
  const [countries, setCountries] = useState([]);
  const [states, setStates] = useState([]);
  const [sameAsShipping, setSameAsShipping] = useState(false);
   const [errors, setErrors] = useState({});
  const handleShippingChange = (e) => {
    const { name, value } = e.target;
    setShipping({ ...shipping, [name]: value });
    setErrors((prev) => ({ ...prev, [name]: "" })); // clear error when typing
  };

  const handleBillingChange = (e) => {
    const { name, value } = e.target;
    setBilling({ ...billing, [name]: value });
  };

  /** ✅ Validate required shipping fields before placing order */
  const validateShipping = () => {
    let newErrors = {};

    if (!shipping.country) newErrors.country = "Country is required";
    if (!shipping.first_name) newErrors.first_name = "First name is required";
    if (!shipping.last_name) newErrors.last_name = "Last name is required";
    if (!shipping.address) newErrors.address = "Address is required";
    if (!shipping.city) newErrors.city = "City is required";
    if (!shipping.state) newErrors.state = "State is required";
    if (!shipping.pincode) newErrors.pincode = "Pincode is required";

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  /** 🧾 Save Address + Place Order */
  const handlePlaceOrder = async () => {
    if (!cart.length) return alert("🛒 Your cart is empty!");
    if (!validateShipping()) return; // stop if validation fails

    setIsPlacingOrder(true);
    try {
      // 1️⃣ Save/update addresses first
      const [shippingRes, billingRes] = await Promise.all([
        axiosInstance.post("/api/user/save-address", {
          ...shipping,
          user_id: user.id,
          address_type: "shipping",
        }),
        axiosInstance.post("/api/user/save-address", {
          ...billing,
          user_id: user.id,
          address_type: "billing",
        }),
      ]);

      // 2️⃣ Place order
      const orderRes = await axiosInstance.post("/api/orders", {
        user_id: user.id,
        cart,
        total,
        shipping_address_id: shippingRes.data.id,
        billing_address_id: billingRes.data.id,
      });

      if (orderRes.data?.order_id) {
        alert("✅ Order placed successfully!");
        clearCart();
        navigate("/thank-you");
      }
    } catch (err) {
      console.error(err);
      alert("❌ Failed to place order. Try again.");
    } finally {
      setIsPlacingOrder(false);
    }
  };

  // Address states
  const [shipping, setShipping] = useState({
    id: null,
    country: "",
    state: "",
    first_name: "",
    last_name: "",
    address: "",
    apartment: "",
    city: "",
    pincode: "",
  });

  const [billing, setBilling] = useState({
    id: null,
    country: "",
    state: "",
    first_name: "",
    last_name: "",
    address: "",
    apartment: "",
    city: "",
    pincode: "",
  });

  // Redirect to login if not logged in
  useEffect(() => {
    if (!loading && !user) navigate("/login", { state: { from: "/checkout" } });
  }, [user, loading, navigate]);

  

  // Fetch countries
  useEffect(() => {
    axiosInstance.get("/api/countries").then((res) => {
      setCountries(res.data);
    });
  }, []);

  // Fetch states dynamically for shipping
  useEffect(() => {
    if (shipping.country) {
      axiosInstance.get(`/api/states/${shipping.country}`).then((res) => {
        setStates(res.data);
      });
    } else {
      setStates([]);
    }
  }, [shipping.country]);

  // Fetch previously saved addresses
  useEffect(() => {
    if (user?.id) {
      axiosInstance
        .get(`/api/user/addresses/`)
        .then((res) => {
          const billingAddr = res.data.find((a) => a.address_type === "billing");
          const shippingAddr = res.data.find(
            (a) => a.address_type === "shipping"
          );

          if (billingAddr) setBilling(billingAddr);
          if (shippingAddr) setShipping(shippingAddr);
        })
        .catch(() => {});
    }
  }, [user]);

  // Autofill billing if checked
  useEffect(() => {
    if (sameAsShipping) {
      setBilling({ ...shipping });
    }
  }, [sameAsShipping, shipping]);

  
if (loading) return <p>Loading...</p>;
  if (!user) return null;

  return (
    <section className="contentContainer CheckoutForm">
      <div className="container">
        <div className="row">
          {/* ================= LEFT SIDE: ADDRESS FORM ================= */}
          <div className="col-lg-7 col-md-6">
            {/* SHIPPING ADDRESS */}
            <div className="deliveryInformation">
              <h2>Shipping Address</h2>
              <div className="row">
                <div className="col-md-12">
                  <label>Country</label>
                  <select
                    name="country"
                    value={shipping.country}
                    onChange={handleShippingChange}
                    className={`w-100 ${errors.country ? "is-invalid" : ""}`}
                  >
                    <option value="">Select Country</option>
                    {countries.map((c) => (
                      <option key={c.id} value={c.id}>
                        {c.country_name}
                      </option>
                    ))}
                  </select>
                  {errors.country && (
                    <div className="text-danger small">{errors.country}</div>
                  )}
                </div>

                <div className="col-md-6">
                  <label>First Name</label>
                  <input
                    name="first_name"  className={`w-100 ${errors.first_name ? "is-invalid" : ""}`}
                    value={shipping.first_name}
                    onChange={handleShippingChange}
                    placeholder="First Name"
                  />
                  {errors.first_name && (
                    <div className="text-danger small">{errors.first_name}</div>
                  )}
                </div>
                <div className="col-md-6">
                  <label>Last Name</label>
                  <input
                    name="last_name" className={`w-100 ${errors.last_name ? "is-invalid" : ""}`}
                    value={shipping.last_name}
                    onChange={handleShippingChange}
                    placeholder="Last Name"
                  />
                  {errors.last_name && (
                    <div className="text-danger small">{errors.last_name}</div>
                  )}
                </div>

                <div className="col-md-12">
                  <label>Address*</label>
                  <input
                    name="address" className={`w-100 ${errors.address ? "is-invalid" : ""}`}
                    value={shipping.address}
                    onChange={handleShippingChange}
                    placeholder="Address"
                  />
                  {errors.address && (
                    <div className="text-danger small">{errors.address}</div>
                  )}
                </div>

                <div className="col-md-12">
                  <label>Apartment, suite, etc</label>
                  <input
                    name="apartment" className="w-100"
                    value={shipping.apartment}
                    onChange={handleShippingChange}
                    placeholder="Apartment"
                  />
                </div>

                <div className="col-md-4">
                <div className="form-group mb-0">
                  <label>City</label>
                  <input
                    name="city" className={`min-width-auto w-100 ${errors.city ? "is-invalid" : ""}`}
                    value={shipping.city}
                    onChange={handleShippingChange}
                    placeholder="City"
                  />
                  {errors.city && (
                    <div className="text-danger small">{errors.city}</div>
                  )}
                </div>
                </div>
                <div className="col-md-4">
                <div className="form-group mb-0">
                  <label>State</label>
                  <select
                    name="state" className={`min-width-auto w-100 ${errors.state ? "is-invalid" : ""}`}
                    value={shipping.state}
                    onChange={handleShippingChange}
                    className="w-100"
                  >
                    <option value="">Select State</option>
                    {states.map((s) => (
                      <option key={s.id} value={s.id}>
                        {s.name}
                      </option>
                    ))}
                  </select>
                  {errors.state && (
                    <div className="text-danger small">{errors.state}</div>
                  )}
                  </div>
                </div>

                <div className="col-md-4">
                <div className="form-group mb-0">
                  <label>Pin Code</label>
                  <input type="text"
                    name="pincode" className={`min-width-auto w-100 ${errors.pincode ? "is-invalid" : ""}`}
                    value={shipping.pincode}
                    onChange={handleShippingChange}
                    placeholder="Pin Code"
                  />
                  {errors.pincode && (
                    <div className="text-danger small">{errors.pincode}</div>
                  )}
                  </div>
                </div>
              </div>
            </div>

            {/* BILLING ADDRESS */}
            <div className="deliveryInformation">
              <h2>Billing Address</h2>

              <div className="form-check ps-0 d-flex align-items-center">
                <input
                  id="sameAsShipping"
                  type="checkbox"
                  checked={sameAsShipping}
                  onChange={(e) => setSameAsShipping(e.target.checked)}
                />
                <label className="form-check-label" htmlFor="sameAsShipping">
                  Same as Shipping
                </label>
              </div>

              {!sameAsShipping && (
                <div className="row">
                  <div className="col-md-12">
                    <label>Country</label>
                    <select
                      name="country" className="w-100"
                      value={billing.country}
                      onChange={handleBillingChange}
                    >
                      <option value="">Select Country</option>
                      {countries.map((c) => (
                        <option key={c.id} value={c.id}>
                          {c.country_name}
                        </option>
                      ))}
                    </select>
                  </div>

                  <div className="col-md-6">
                    <label>First Name</label>
                    <input
                      name="first_name" className="w-100"
                      value={billing.first_name}
                      onChange={handleBillingChange}
                      placeholder="First Name"
                    />
                  </div>

                  <div className="col-md-6">
                    <label>Last Name</label>
                    <input
                      name="last_name" className="w-100"
                      value={billing.last_name}
                      onChange={handleBillingChange}
                      placeholder="Last Name"
                    />
                  </div>

                  <div className="col-md-12">
                    <label>Address</label>
                    <input
                      name="address" className="w-100"
                      value={billing.address}
                      onChange={handleBillingChange}
                      placeholder="Address"
                    />
                  </div>

                  <div className="col-md-12">
                    <label>Apartment, suite, etc</label>
                    <input
                      name="apartment" className="w-100"
                      value={billing.apartment}
                      onChange={handleBillingChange}
                      placeholder="Apartment"
                    />
                  </div>

                  <div className="col-md-4">
                    <label>City</label>
                    <input
                      name="city" className="w-100"
                      value={billing.city}
                      onChange={handleBillingChange}
                      placeholder="City"
                    />
                  </div>

                  <div className="col-md-4">
                    <label>State</label>
                    <input
                      name="state" className="w-100"
                      value={billing.state}
                      onChange={handleBillingChange}
                      placeholder="State"
                    />
                  </div>

                  <div className="col-md-4">
                    <label>Pin Code</label>
                    <input
                      name="pincode" className="w-100"
                      value={billing.pincode}
                      onChange={handleBillingChange}
                      placeholder="Pin Code"
                    />
                  </div>
                </div>
              )}
            </div>
          </div>

          {/* ================= RIGHT SIDE: CART SUMMARY ================= */}
          <div className="col-lg-5 col-md-6">
            <div className="shoppingCartProducts checkoutCart">
              {cart.length === 0 ? (
                <p className="text-center">
                  <b>No items in cart</b>
                </p>
              ) : (
                <>
                  {cart.map((item) => (
                    <div className="cart-row" key={item.id}>
							<div className="row">
								<div className="col-md-8 col-sm-8">
									<div className="d-flex">
										<div className="productImage"><img src={item.image_url} alt={item.name} className="imgResponsive" /></div>
										<Link to={`/products/${item.slug}`} className="productName ms-2">{item.name}</Link>
									</div>
								</div>
								<div className="col-md-4 col-sm-4">
									<div className="d-flex justify-content-between">
										<div className="productQuantity">
					                  {item.quantity}
					               </div>
					               <div className="productPriceOuter d-flex">
					               	<div className="productPrice">${parseFloat(item.price * item.quantity).toFixed(2)}</div>
					               </div>
				               </div>
								</div>
							</div>
						</div>
                  ))}
                  <div className="cart-row">
                  <div className="text-end mt-3">
                    <div className="totalPrice mb-2">Subtotal <span>${total}</span></div>
                    <button
                      className="btn btn-primary mt-3"
                      onClick={handlePlaceOrder}
                      disabled={isPlacingOrder}
                    >
                      {isPlacingOrder ? "Placing Order..." : "Place Order"}
                    </button>
                  </div>
                  </div>
                </>
              )}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
