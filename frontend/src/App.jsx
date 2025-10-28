import { useState } from 'react';
import React from 'react';
import reactLogo from './assets/react.svg';
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';
//import Layout from './components/Layout';
import Header from "./components/Header";
import Navbar from "./components/Navbar";
import Breadcrumb from "./components/Breadcrumb";
import ScrollToTop from "./components/ScrollToTop";
import Footer from "./components/Footer";
import Home from './pages/Home';
import Products from './pages/Products';
import ProductsDetail from './pages/ProductsDetail';
import About from './pages/About';
import FAQ from './pages/FAQ';
import LegalNotice from './pages/LegalNotice';
import Contact from './pages/Contact';
import ProductDocumentation from './pages/ProductDocumentation';
import ProductDocsDetail from './pages/ProductDocsDetail';
import News from './pages/News';
//import AceticAcidGlacialACS from './pages/AceticAcidGlacialACS';
import Login from './pages/Login';
import Register from './pages/Register';
import ForgotPassword from './pages/ForgotPassword';
import MyAccount from './pages/MyAccount';
import OrderDetail from './pages/OrderDetail';
import ShoppingCart from './pages/ShoppingCart';
import Checkout from './pages/Checkout';
import Search from './pages/Search';

import SeeAllProduct from './pages/SeeAllProduct';
import Collections from './pages/Collections';
import ProtectedRoute from './utils/ProtectedRoute';
import ThankYou from './pages/ThankYou';

import { ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

function App() {
  return (
    <Router>
        <Header />
        <Navbar />
        <Breadcrumb />
        <ScrollToTop />
        <ToastContainer position="top-right" autoClose={2000} />
        <Routes>


          <Route path="/" element={<Home />} />

           {/* All products */}
          <Route path="/collections" element={<Collections />} />
          <Route path="/industry" element={<Collections />} />
          <Route path="/products" element={<Collections />} />

           {/* Category only */}
          <Route path="/collections/:categorySlug" element={<Collections />} />

          {/* Category + Subcategory */}
          <Route path="/collections/:categorySlug/:subcategorySlug" element={<Collections />} />
          <Route path="/products/:slug" element={<ProductsDetail />} />

          
          {/*<Route path="/products-detail" element={<ProductsDetail />} />*/}
          <Route path="/about-us" element={<About />} />
          <Route path="/faqs" element={<FAQ />} />
          <Route path="/legal-notice" element={<LegalNotice />} />
          <Route path="/pages/product-documentation" element={<ProductDocumentation />} />
          <Route path="/pages" element={<ProductDocumentation />} />

          <Route path="/pages/:slug" element={<ProductDocsDetail />} />
          <Route path="/contact-us" element={<Contact />} />
          <Route path="/news" element={<News />} />
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />
          <Route path="/forgot-password" element={<ForgotPassword />} />
          <Route path="/my-account" element={<MyAccount />} />
          <Route path="/my-orders/:id" element={<OrderDetail />} />
          <Route path="/shopping-cart" element={<ShoppingCart />} />
          <Route path="/checkout" element={<Checkout />} />
          <Route path="/search" element={<Search />} />
          <Route path="/checkout" element={<ProtectedRoute> <Checkout /> </ProtectedRoute>} />
          <Route path="/thank-you" element={<ThankYou />} />
        </Routes>
        <Footer />
    </Router>

  );
}

export default App
