// src/pages/Checkout.jsx
import React, { useEffect,useState } from "react";
import { useNavigate,Link } from "react-router-dom";
import { useAuth } from "../utils/AuthContext";
import { useCart } from "../utils/CartContext";
import { PayPalButtons,PayPalScriptProvider } from "@paypal/react-paypal-js";
import axiosInstance from "../axios";
 

export default function Checkout() {
  const { user, loading } = useAuth();
  //const [setLoading] = useState(true);
  const [isPlacingOrder, setIsPlacingOrder] = useState(false);

  const { distinctCount,cart, total, clearCart } = useCart();
  const navigate = useNavigate();

  useEffect(() => {
    if (!loading && !user) navigate("/login", { state: { from: "/checkout" } });
  }, [user, loading, navigate]);

  if (loading) return <p>Loading...</p>;
  if (!user) return null;

  const handlePlaceOrder = () => {
  	 setIsPlacingOrder(true);
  	 try {
			//axiosInstance.post('/api/orders-test')
  	 	const orderdata = {user_id:user.id,cart:cart,total:total,paypal_order_id:"####"};
  			const res = axiosInstance.post("/api/orders" , orderdata,{ withCredentials: true });
		        console.log(res);
		        if(res.order_id !='')
		        {
		        		alert("✅ Order placed successfully!");
				    	clearCart();
				    	navigate("/thank-you");
		        }
		        

		      } catch (err) {
		       
		      	console.log(err)
		      } finally {
		        setIsPlacingOrder(false);
		      }
  	 	

  };

   // ✅ PayPal: Create order with multiple items
  const createOrder = (data, actions) => {
    return actions.order.create({
      purchase_units: [
        {
          amount: {
            currency_code: "USD",
            value: total.toFixed(2),
            breakdown: {
              item_total: {
                currency_code: "USD",
                value: total.toFixed(2),
              },
            },
          },
          items: cart.map((item) => ({
            name: item.name,
            unit_amount: {
              currency_code: "USD",
              value: item.price.toFixed(2),
            },
            quantity: item.quantity.toString(),
          })),
        },
      ],
    });
  };

  // ✅ When PayPal approves payment
  const onApprove = (data, actions) => {
    return actions.order.capture().then((details) => {
      const paymentData = {
        order_id: details.id,
        payer_name: details.payer.name.given_name,
        payer_email: details.payer.email_address,
        status: details.status,
        amount: total,
      };

      // Send order to Laravel backend
      axiosInstance.post("/api/orders", paymentData, {
          withCredentials: true,
        })
        .then(() => {
          alert("✅ Payment successful! Order placed.");
          navigate("/order-success");
        })
        .catch((err) => {
          console.error(err);
          alert("⚠️ Payment succeeded but order save failed.");
        });
    });
  };

/////////////////////////////////////////////////

const [countries, setCountries] = useState([]);
  const [states, setStates] = useState([]);

  const [shipping, setShipping] = useState({
    country: "",
    state: "",
    first_name: user?.name?.split(" ")[0] || "",
    last_name: user?.name?.split(" ")[1] || "",
    address: "",
    apartment: "",
    city: "",
    pincode: "",
  });

  const [billing, setBilling] = useState({
    country: "",
    state: "",
    first_name: "",
    last_name: "",
    address: "",
    apartment: "",
    city: "",
    pincode: "",
  });

  const [sameAsShipping, setSameAsShipping] = useState(false);

  // Fetch all countries
  useEffect(() => {
    axiosInstance.get("/api/countries").then((res) => {
      setCountries(res.data);
    });
  }, []);

  // Fetch states when country changes
  useEffect(() => {
    if (shipping.country) {
      axiosInstance.get(`/api/states/${shipping.country}`).then((res) => {
        setStates(res.data);
      });
    } else {
      setStates([]);
    }
  }, [shipping.country]);

  // Autofill billing address
  useEffect(() => {
    if (sameAsShipping) {
      setBilling({ ...shipping });
    }
  }, [sameAsShipping, shipping]);

  const handleShippingChange = (e) => {
    const { name, value } = e.target;
    setShipping({ ...shipping, [name]: value });
  };

  const handleBillingChange = (e) => {
    const { name, value } = e.target;
    setBilling({ ...billing, [name]: value });
  };

return (
   <section className="contentContainer CheckoutForm">
		<div className="container">
			<div className="row">

				<div className="col-lg-7 col-md-6">
      {/* SHIPPING ADDRESS */}
      <div className="deliveryInformation">
        <h2>Shipping Address</h2>
        <div className="row">
          <div className="col-md-12">
            <div className="form-group mb-0">
              <label>Country</label>
              <select
                name="country"
                value={shipping.country}
                onChange={handleShippingChange}
                className="w-100"
              >
                <option value="">Select Country</option>
                {countries.map((c) => (
                  <option key={c.id} value={c.id}>
                    {c.country_name}
                  </option>
                ))}
              </select>
            </div>
          </div>

          <div className="col-md-6">
            <div className="form-group mb-0">
              <label>First Name</label>
              <input
                type="text"
                name="first_name"
                value={shipping.first_name}
                onChange={handleShippingChange}
                className="w-100"
                placeholder="First Name"
              />
            </div>
          </div>

          <div className="col-md-6">
            <div className="form-group mb-0">
              <label>Last Name</label>
              <input
                type="text"
                name="last_name"
                value={shipping.last_name}
                onChange={handleShippingChange}
                className="w-100"
                placeholder="Last Name"
              />
            </div>
          </div>

          <div className="col-md-12">
            <div className="form-group mb-0">
              <label>Address</label>
              <input
                type="text"
                name="address"
                value={shipping.address}
                onChange={handleShippingChange}
                className="w-100"
                placeholder="Address"
              />
            </div>
          </div>

          <div className="col-md-12">
            <div className="form-group mb-0">
              <label>Apartment, suite, etc (Optional)</label>
              <input
                type="text"
                name="apartment"
                value={shipping.apartment}
                onChange={handleShippingChange}
                className="w-100"
                placeholder="Apartment, suite, etc"
              />
            </div>
          </div>

          <div className="col-md-4">
            <div className="form-group mb-0">
              <label>City</label>
              <input
                type="text"
                name="city"
                value={shipping.city}
                onChange={handleShippingChange}
                className="w-100"
                placeholder="City"
              />
            </div>
          </div>

          <div className="col-md-4">
            <div className="form-group mb-0">
              <label>State</label>
              <select
                name="state"
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
            </div>
          </div>

          <div className="col-md-4">
            <div className="form-group mb-0">
              <label>Pin Code</label>
              <input
                type="text"
                name="pincode"
                value={shipping.pincode}
                onChange={handleShippingChange}
                className="w-100"
                placeholder="Pin Code"
              />
            </div>
          </div>
        </div>
      </div>

      {/* BILLING ADDRESS */}
      <div className="deliveryInformation">
        <h2>Billing Address</h2>

        <div className="sameAddress">
          <div className="form-check ps-0 d-flex align-items-center">
            <input
              className="min-width-auto min-height-auto m-0"
              id="sameAsShipping"
              type="checkbox"
              checked={sameAsShipping}
              onChange={(e) => setSameAsShipping(e.target.checked)}
            />
            <label className="form-check-label m-0" htmlFor="sameAsShipping">
              Same as Shipping address
            </label>
          </div>
        </div>

        {!sameAsShipping && (
          <div className="row">
            <div className="col-md-12">
              <div className="form-group mb-0">
                <label>Country</label>
                <select
                  name="country"
                  value={billing.country}
                  onChange={handleBillingChange}
                  className="w-100"
                >
                  <option value="">Select Country</option>
                  {countries.map((c) => (
                    <option key={c.id} value={c.id}>
                      {c.country_name}
                    </option>
                  ))}
                </select>
              </div>
            </div>

            <div className="col-md-6">
              <div className="form-group mb-0">
                <label>First Name</label>
                <input
                  type="text"
                  name="first_name"
                  value={billing.first_name}
                  onChange={handleBillingChange}
                  className="w-100"
                  placeholder="First Name"
                />
              </div>
            </div>

            <div className="col-md-6">
              <div className="form-group mb-0">
                <label>Last Name</label>
                <input
                  type="text"
                  name="last_name"
                  value={billing.last_name}
                  onChange={handleBillingChange}
                  className="w-100"
                  placeholder="Last Name"
                />
              </div>
            </div>

            <div className="col-md-12">
              <div className="form-group mb-0">
                <label>Address</label>
                <input
                  type="text"
                  name="address"
                  value={billing.address}
                  onChange={handleBillingChange}
                  className="w-100"
                  placeholder="Address"
                />
              </div>
            </div>

            <div className="col-md-12">
              <div className="form-group mb-0">
                <label>Apartment, suite, etc (Optional)</label>
                <input
                  type="text"
                  name="apartment"
                  value={billing.apartment}
                  onChange={handleBillingChange}
                  className="w-100"
                  placeholder="Apartment, suite, etc"
                />
              </div>
            </div>

            <div className="col-md-4">
              <div className="form-group mb-0">
                <label>City</label>
                <input
                  type="text"
                  name="city"
                  value={billing.city}
                  onChange={handleBillingChange}
                  className="w-100"
                  placeholder="City"
                />
              </div>
            </div>

            <div className="col-md-4">
              <div className="form-group mb-0">
                <label>State</label>
                <input
                  type="text"
                  name="state"
                  value={billing.state}
                  onChange={handleBillingChange}
                  className="w-100"
                  placeholder="State"
                />
              </div>
            </div>

            <div className="col-md-4">
              <div className="form-group mb-0">
                <label>Pin Code</label>
                <input
                  type="text"
                  name="pincode"
                  value={billing.pincode}
                  onChange={handleBillingChange}
                  className="w-100"
                  placeholder="Pin Code"
                />
              </div>
            </div>
          </div>
        )}
      </div>
    </div>
				<div className="col-lg-5 col-md-6">
					<div className="shoppingCartProducts checkoutCart">
						{cart.length === 0 ? (
			              <p className="text-center"><b>No items in cart</b></p>
			            ) : (
			            <span>
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
							)	)}
						</span>
			 			)}
						{distinctCount > 0 && (
						<div className="cart-row">
							<div className="row">
								<div className="col-md-12 text-end">
								
									<div className="totalPrice mb-2">Subtotal <span>${total}</span></div>
									
									<div className="btnOuter mt-4">
					               <button
													  className="btn btn-primary min-width-auto customBtn01 customBtn01Fill fw-semibold"
													  onClick={handlePlaceOrder}
													  disabled={isPlacingOrder || cart.length === 0}
													>
													  {isPlacingOrder ? (
													    <span><i className="fas fa-spinner fa-spin me-2"></i>Placing Order...</span>
													  ) : (
													    <span><i className="fas fa-shopping-cart me-2"></i>Place Order</span>
													  )}
													</button>


					               {/* PayPal button */}
								     {/* {cart.length > 0 && (
							        <PayPalScriptProvider
							          options={{
							            "client-id": import.meta.env.VITE_PAYPAL_CLIENT_ID,
							            currency: "USD",
							          }}
							        >
							          <PayPalButtons
							            style={{ layout: "vertical" }}
							            createOrder={createOrder}
							            onApprove={onApprove}
							          />
							        </PayPalScriptProvider>
							      )}
										*/}
					            </div>
								</div>
							</div>
						</div>
						)}
					</div>
				</div>
			</div>
		</div>
   </section>
);
}
