import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { Modal, Button } from "react-bootstrap";
import pharmachemLogo from '../assets/pharmachem-logo.png';
import { useCart } from "../utils/CartContext";
import { useAuth } from "../utils/AuthContext";

import CartModal from '../components/CartModal';

const Header = () => {
  const [showCart, setShowCart] = useState(false);
  const { itemCount,distinctCount, total } = useCart();
  const [searchTerm, setSearchTerm] = useState("");
  const navigate = useNavigate();
  const isHome = location.pathname === "/";

  const { user, logout } = useAuth();
  const { cart } = useCart();
  
  const handleSearch = (e) => {
    e.preventDefault();
    if (searchTerm.trim() !== "") {
      navigate(`/search?q=${encodeURIComponent(searchTerm)}`);
      setSearchTerm("");
    }
  };

  const cartCount = cart.reduce((acc, item) => acc + item.quantity, 0);
  const handleClose = () => setShowCart(false);
  const handleShow = () => setShowCart(true);
  return (
    <>
      {/* Header */}
      
      <header id="header">
        <div className="container position-relative">
          <div className="topBar d-flex align-items-center justify-content-between">
            <a className="navbar-brand" href="/"><img src={ pharmachemLogo } alt="" className="imgResponsive" /></a>
            <div className="d-flex align-items-end topIcons flex-column">
              <div className="site-header-links">
                 {user ? (
                    <>
                    <span className="site-header--spacer">Logged in as</span> <Link to="/my-account">{user.name}</Link> · <button onClick={logout}>Log out</button>

                     </>
                  ) : (
                    <>
                      <Link to="/login">Sign In</Link>
                      <span className="site-header--spacer">or</span>
                      <Link to="/register">Create an Account</Link>
                    </>

                  )}
                

              </div>
              <div className="d-flex">
               <form onSubmit={handleSearch}>
                <div className="search-container d-flex searchHeader" id="searchBox">
                  <input type="text" value={searchTerm}  onChange={(e) => setSearchTerm(e.target.value)} className="search-input" id="searchInput" placeholder="Search all products..." />
                  <button type="submit" className="search-btn" id="searchBtn"><i className="fas fa-search"></i></button>
                </div>
               </form>
              <div className="cartButton">
                <button className="header-cart-btn" id="cartBtn" onClick={handleShow}>
                  <i className="fas fa-shopping-cart me-2"></i>CART
                   {distinctCount > 0 && (
                  <span className="cart-count cart-badge-desktop "> {distinctCount}</span>
                   )}
                </button>
              </div>
              </div>
            </div>
          </div>
        </div> 
      </header>
      <Modal show={showCart} onHide={handleClose} size="lg" centered>
        <Modal.Header closeButton>
          <Modal.Title>Shopping Cart</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          {/* ✅ Pass handleClose */}
          <CartModal onClose={handleClose} />
        </Modal.Body>
      </Modal>


    </>
  );
}

export default Header;
