// src/pages/Home.jsx
import { useState, useEffect  } from 'react';
import { useNavigate, Link,useLocation } from 'react-router-dom';
// import { getCart,removeFromCart, clearCart, getCartCount, getCartTotal  } from "../utils/cart";
import { useCart } from "../utils/CartContext";
import { useAuth } from "../utils/AuthContext";



export default function CartModal({ showCart,setShowCart, onClose }) {
	//const [items, setItems] = useState([]);
   const { distinctCount,cart, total, removeFromCart,updateQuantity } = useCart();
   const { user } = useAuth();
	const navigate = useNavigate(); 
	 const location = useLocation();

	  // if (!show) return null; // ✅ hide modal when show=false

	const dec = (i) => updateQuantity(i.id, (i.quantity || 1) - 1);
  	const inc = (i) => updateQuantity(i.id, (i.quantity || 0) + 1);

  	const handleCheckout = () => {
  		//setShowCart(false)
  		onClose()
  	 	//if (typeof onClose === "function") onClose();

    	if (!user) {
      	// Not logged in → redirect to login
      	navigate("/login", { state: { from: "/checkout" } });
    	} else {
      	// Logged in → go to checkout
      	navigate("/checkout");
    	}
  };
 const isCartEmpty = !cart || cart.length === 0;
return (
			<div className="shoppingCartProducts">
			 {cart.length === 0 ? (
              <p className="text-center">No items in cart</p>
            ) : (
            <span>
			{cart.map((item) => (

				<div className="cart-row"  key={item.id}>
					<div className="row">
						<div className="col-md-6">
							<div className="d-flex">
								<div className="productImage">

									<img src={item.image_url} alt={item.name} className="imgResponsive" />

								</div>
								<Link to={`/products/${item.slug}`} className="productName">{item.name}</Link>
							</div>
						</div>
						<div className="col-md-6">
							<div className="d-flex justify-content-between">
								<div className="productQuantity">
			                  <div className="d-flex align-items-center">
			                     <button
			                        className="btn btn-outline-secondary"
			                        onClick={() => dec(item)}
			                     >
			                     <i className="fa-solid fa-minus"></i>
			                     </button>
			                     <input
			                     type="text"
			                     className="form-control text-center"
			                     style={{ width: "40px" }}
			                     value={item.quantity}
			                     min="1"
			                     />
			                     <button
			                        className="btn btn-outline-secondary"
			                        onClick={() => inc(item)}
			                     >
			                     <i className="fa-solid fa-plus"></i>
			                     </button>
			                  </div>
			               </div>
			               <div className="productPriceOuter d-flex">
			               	<div className="productPrice">${parseFloat(item.price * item.quantity).toFixed(2)}</div>
			               	<a href="#" className="removeProduct"  onClick={() => removeFromCart(item.id)}>
			               		<i className="fa-solid fa-xmark"></i>
			               		</a>
			               </div>
		               </div>
						</div>
					</div>
				</div>
				))}
			</span>
 			)}
 			{distinctCount > 0 && (
				<div className="cart-row">
					<div className="row">
						<div className="col-md-12 text-end">
							
							<div className="totalPrice mb-2">Subtotal <span>${total}</span></div>

							
							<p className="highlighted"><em>Taxes and shipping calculated at checkout</em></p>
							<div className="btnOuter mt-5">
								{/*<input type="submit" name="update" className="btn min-width-auto customBtn01 customBtn01Fill updateCart fw-semibold me-2" value="Update cart" />*/}
			               <button disabled={isCartEmpty}  title={isCartEmpty ? "Add items to cart first" : ""} className="btn btn-primary min-width-auto customBtn01 customBtn01Fill fw-semibold" onClick={handleCheckout}>
			               	<i className="fas fa-shopping-cart me-2"></i>checkout
			               </button>
			            </div>
						</div>
					</div>
				</div>
				)}
			</div>
			

);
}
