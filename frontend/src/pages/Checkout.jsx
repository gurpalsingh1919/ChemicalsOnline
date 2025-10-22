// src/pages/Checkout.jsx
import React, { useEffect,useState } from "react";
import { useNavigate,Link } from "react-router-dom";
import { useAuth } from "../utils/AuthContext";
import { useCart } from "../utils/CartContext";
import { PayPalButtons,PayPalScriptProvider } from "@paypal/react-paypal-js";
import axiosInstance from "../axios";
 

export default function Checkout() {
  const { user, loading } = useAuth();
  const [setLoading] = useState(true);
  const { distinctCount,cart, total, clearCart } = useCart();
  const navigate = useNavigate();

  useEffect(() => {
    if (!loading && !user) navigate("/login", { state: { from: "/checkout" } });
  }, [user, loading, navigate]);

  if (loading) return <p>Loading...</p>;
  if (!user) return null;

  const handlePlaceOrder = () => {
  	//setLoading(true);
  	 try {
			axiosInstance.post('/api/orders-test')
  	 	const orderdata = {user_id:user.id,cart:cart,total:total,paypal_order_id:"####"};
  			const res = axiosInstance.post("/api/orders" , orderdata,{ withCredentials: true });
		       // console.log(res);
		        if(res.order_id !='')
		        {
		        		alert("✅ Order placed successfully!");
				    	clearCart();
				    	navigate("/thank-you");
		        }
		        

		      } catch (err) {
		       
		      	console.log(err)
		      } finally {
		        
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

return (
   <section className="contentContainer CheckoutForm">
		<div className="container">
			<div className="row">

				<div className="col-lg-7 col-md-6">
					<div className="deliveryInformation">
						<h2>Shipping Address</h2>
						<div className="row">
							<div className="col-md-12">
								<div className="form-group mb-0">
									<label htmlFor="Company-name">Country</label>
									<select className="w-100">
										<option>Select Country</option>
										<option>India</option>
									</select>
								</div>
							</div>
							<div className="col-md-6">
								<div className="form-group mb-0">
									<label htmlFor="first-name">First Name</label>
									<input type="text" className="w-100" id="first-name" placeholder="First Name" value={user.name} aria-describedby="first-name" />
								</div>
							</div>
							<div className="col-md-6">
								<div className="form-group mb-0">
									<label htmlFor="last-name">Last Name</label>
									<input type="text" className="w-100" id="last-name" placeholder="Last Name" aria-describedby="last-name" />
								</div>
							</div>
							<div className="col-md-12">
								<div className="form-group mb-0">
									<label htmlFor="address">Address</label>
									<input type="text" className="w-100" id="address" placeholder="Address" aria-describedby="address" />
								</div>
							</div>
							<div className="col-md-12">
								<div className="form-group mb-0">
									<label htmlFor="apartment">Apartment, suit, etc (Optional)</label>
									<input type="text" className="w-100" id="apartment" placeholder="Apartment, suit, etc (Optional)" aria-describedby="apartment" />
								</div>
							</div>
							<div className="col-md-4">
								<div className="form-group mb-0">
									<label htmlFor="city">City</label>
									<input type="text" className="min-width-auto w-100" id="city" placeholder="City" aria-describedby="city" />
								</div>
							</div>
							<div className="col-md-4">
								<div className="form-group mb-0">
									<label htmlFor="state">State</label>
									<input type="text" className="min-width-auto w-100" id="state" placeholder="State" aria-describedby="state" />
								</div>
							</div>
							<div className="col-md-4">
								<div className="form-group mb-0">
									<label htmlFor="pin-code">Pin Code</label>
									<input type="text" className="min-width-auto w-100" id="pin-code" placeholder="Pin Code" aria-describedby="pin-code" />
								</div>
							</div>
						</div>
					</div>

					<div className="deliveryInformation">
						<h2>Billing Address</h2>
						<div className="sameAddress">
							<div className="form-check ps-0 d-flex align-items-center">
								<input className="min-width-auto min-height-auto m-0" id="exampleCheck1" type="checkbox" />
								<label className="form-check-label d-inline-block m-0" htmlFor="exampleCheck1">Same as Shipping address</label>
							</div>
						</div>
						<div className="row">
							<div className="col-md-12">
								<div className="form-group mb-0">
									<label htmlFor="Company-name">Country</label>
									<select className="w-100">
										<option>Select Country</option>
										<option>India</option>
									</select>
								</div>
							</div>
							<div className="col-md-6">
								<div className="form-group mb-0">
									<label htmlFor="first-name">First Name</label>
									<input type="text" className="w-100" id="first-name" placeholder="First Name" aria-describedby="first-name" />
								</div>
							</div>
							<div className="col-md-6">
								<div className="form-group mb-0">
									<label htmlFor="last-name">Last Name</label>
									<input type="text" className="w-100" id="last-name" placeholder="Last Name" aria-describedby="last-name" />
								</div>
							</div>
							<div className="col-md-12">
								<div className="form-group mb-0">
									<label htmlFor="address">Address</label>
									<input type="text" className="w-100" id="address" placeholder="Address" aria-describedby="address" />
								</div>
							</div>
							<div className="col-md-12">
								<div className="form-group mb-0">
									<label htmlFor="apartment">Apartment, suit, etc (Optional)</label>
									<input type="text" className="w-100" id="apartment" placeholder="Apartment, suit, etc (Optional)" aria-describedby="apartment" />
								</div>
							</div>
							<div className="col-md-4">
								<div className="form-group mb-0">
									<label htmlFor="city">City</label>
									<input type="text" className="min-width-auto w-100" id="city" placeholder="City" aria-describedby="city" />
								</div>
							</div>
							<div className="col-md-4">
								<div className="form-group mb-0">
									<label htmlFor="state">State</label>
									<input type="text" className="min-width-auto w-100" id="state" placeholder="State" aria-describedby="state" />
								</div>
							</div>
							<div className="col-md-4">
								<div className="form-group mb-0">
									<label htmlFor="pin-code">Pin Code</label>
									<input type="text" className="min-width-auto w-100" id="pin-code" placeholder="Pin Code" aria-describedby="pin-code" />
								</div>
							</div>
						</div>
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
					               <button className="btn btn-primary min-width-auto customBtn01 customBtn01Fill fw-semibold"         onClick={handlePlaceOrder} disabled={cart.length === 0}>
					               	<i className="fas fa-shopping-cart me-2"></i>Place Order
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
