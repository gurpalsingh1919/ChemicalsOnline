// src/pages/Home.jsx
import { useState } from 'react';
import { Link } from 'react-router-dom';
import Cart from '../components/CartModal';

const ShoppingCart = () => {

return (
   <section className="contentContainer shoppingCart">
		<div className="container">
			<div className="row">
				<div className="col-md-12">
					<h1>Shopping Cart</h1>
					 <Cart />
				</div>
			</div>
		</div>
   </section>
);
}
export default ShoppingCart;