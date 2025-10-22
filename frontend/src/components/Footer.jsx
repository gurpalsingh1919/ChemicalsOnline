import React, { useState } from 'react';
import { Link } from 'react-router-dom';


const Footer = () => {
  
  return (
    <>
      <footer className="">
       <div className="container">
          <div className="row">
            <div className="col-lg-12">
              <h3>SITEMAP</h3>
              <ul className="footerNav">
                <li className=""><Link to="/">Home</Link></li>
                <li className=""><a href="https://greenfield.com/" target="_blank" rel="noopener noreferrer">Greenfield Global</a></li>
                <li className=""><Link to="/my-account">My Account</Link></li>
                <li className=""><Link to="/shopping-cart">Shopping Cart</Link></li>
                <li className=""><Link to="/contact-us">Have a Question?</Link></li>
                <li className=""><Link to="/faqs">FAQ'S</Link></li>
              </ul>
            </div>
          </div>
          <div className="copyRight">
           <div className="row">
              <div className="col-lg-6 col-md-6 col-sm-12 order-1 order-md-0"> © Copyright 2025 pharmachemonline. All rights reserved. </div>
              <div className="col-lg-6 col-md-6 col-sm-12 order-0 text-end"> 
                <ul className="footerNav">
                  <li className=""><Link to="/about-us">About Us</Link></li>
                  <li className=""><Link to="/contact-us">Contact Us</Link></li>
                  <li className=""><Link to="/contact-us">Help</Link></li>
                  <li className=""><Link to="/legal-notice">Legal Notice</Link></li>
                </ul>
              </div>
           </div>
          </div>
       </div>
    </footer>
    </>
  );
}

export default Footer;
