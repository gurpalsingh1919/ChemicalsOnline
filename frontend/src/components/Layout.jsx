import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import pharmachemLogo from '../assets/pharmachem-logo.png';
import Breadcrumb from "../components/Breadcrumb";

const Layout = ({ children }) => {
  
  const [searchQuery, setSearchQuery] = useState('');
  const navigate = useNavigate();
  const isHome = location.pathname === "/";

  const handleSearch = (e) => {
    e.preventDefault();
    if (searchQuery.trim()) {
      navigate(`/product-search?q=${encodeURIComponent(searchQuery.trim())}`);
    }
  };

  return (
    <>
      {/* Header */}
      
      <header id="header">
        <div className="container">
          <div className="topBar d-flex align-items-center justify-content-between">
            <a className="navbar-brand" href="/"><img src={ pharmachemLogo } alt="" className="imgResponsive" /></a>
            <div className="d-flex align-items-end topIcons flex-column">
              <div className="site-header-links">
                <a href="#">Sign in</a>
                <span className="site-header--spacer">or</span>
                <a href="#">Create an Account</a>
              </div>
              <div className="d-flex">
              <div className="search-container d-flex" id="searchBox">
                <input type="text" className="search-input" id="searchInput" placeholder="Search all products..." />
                <button className="search-btn" id="searchBtn"><i className="fas fa-search"></i></button>
              </div>
              <div className="cartButton">
                <button className="header-cart-btn" id="cartBtn">
                  <i className="fas fa-shopping-cart me-2"></i>CART
                  <span class="cart-count cart-badge-desktop ">1</span>
                </button>
              </div>
              </div>
            </div>
          </div>
        </div>
        <nav className="navbar navbar-expand-lg">
          <div className="container">
            <button
              className="navbar-toggler collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarNavDropdown"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span className="navbar-toggler-icon"></span>
            </button>
            <div className="collapse navbar-collapse" id="navbarNavDropdown">
              <ul className="navbar-nav">
                <li className="nav-item dropdown">
                  <a className="nav-link" href="#">SHOP BY PRODUCTS</a>
                  <span className="icon"><i className="fa-solid fa-chevron-down dropdown-icon"></i></span>
                  <ul className="subMenu">
                    <li><a href="/products">ORGANIC ALCOHOLS</a></li>
                    <li><a href="#">NON-GMO ALCOHOLS</a></li>
                    <li><a href="#">PURE ETHANOL</a></li>
                    <li><a href="#">TAX FREE ETHANOL1</a></li>
                    <li><Link to={`/products/ipa-isopropyl-alcohol`}>IPA (ISOPROPYL ALCOHOL) </Link></li>
                    <li>
                      <a href="#">GLYCERIN</a>
                      <ul className="subMenu02">
                        <li><a href="#">USP KOSHER</a></li>
                        <li><a href="#">NON-GMO ALCOHOLS</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li className="nav-item dropdown">
                  <a className="nav-link" href="#">SHOP BY INDUSTRY</a>
                  <span className="icon"><i className="fa-solid fa-chevron-down dropdown-icon"></i></span>
                  <ul className="subMenu">
                    <li><a href="#">SMALL MOLECULE PHARMA</a></li>
                    <li><a href="#">LARGE MOLECULE PHARMA/BIOPROCESSING</a></li>
                    <li><a href="#">LABS</a></li>
                    <li><a href="#">BEVERAGE</a></li>
                  </ul>
                </li>
                <li className="nav-item dropdown">
                  <a className="nav-link" href="#">SUPPORT</a>
                  <span className="icon"><i className="fa-solid fa-chevron-down dropdown-icon"></i></span>
                  <ul className="subMenu">
                    <li><a href="#">Product Documentation</a></li>
                    <li><a href="#">FAQ'S</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </li>
                <li className="nav-item"><a className="nav-link" href="#">NEWS</a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>

      {/* Page Content */}
      {!isHome && <Breadcrumb />}
      {children}

      {/* Footer */}
      <footer className="">
       <div className="container">
          <div className="row">
            <div className="col-lg-12">
              <h3>SITEMAP</h3>
              <ul className="footerNav">
                <li className=""><a href="#">Home</a></li>
                <li className=""><a href="#">Greenfield Global</a></li>
                <li className=""><a href="#">My Account</a></li>
                <li className=""><a href="#">Shopping Cart</a></li>
                <li className=""><a href="#">Have a Question?</a></li>
                <li className=""><a href="/faqs">FAQ'S</a></li>
              </ul>
            </div>
          </div>
          <div className="copyRight">
           <div className="row">
              <div className="col-lg-6 col-md-6 col-sm-12 order-1 order-md-0"> © Copyright 2025 pharmachemonline. All rights reserved. </div>
              <div className="col-lg-6 col-md-6 col-sm-12 order-0 text-end"> 
                <ul className="footerNav">
                  <li className=""><a href="/about-us">About Us</a></li>
                  <li className=""><a href="#">Contact Us</a></li>
                  <li className=""><a href="#">Help</a></li>
                  <li className=""><a href="/legal-notice">Legal Notice</a></li>
                </ul>
              </div>
           </div>
          </div>
       </div>
    </footer>
    </>
  );
}

export default Layout;
