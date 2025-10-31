import React from "react";
import ReactDOM from "react-dom/client";
import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './App.css'
import App from './App.jsx'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import '@fortawesome/fontawesome-free/css/all.min.css';
import './assets/css/core.css';
import './assets/js/core.js';
import { PayPalScriptProvider } from "@paypal/react-paypal-js";

import { CartProvider } from "./utils/CartContext";
import { AuthProvider } from "./utils/AuthContext";


const initialOptions = {
  "client-id": import.meta.env.VITE_PAYPAL_CLIENT_ID, // 🔹 Replace with your actual PayPal client ID
  currency: "USD",
  intent: "capture",
};

ReactDOM.createRoot(document.getElementById('root')).render(
   // <React.StrictMode>
      <PayPalScriptProvider options={initialOptions}>
         <AuthProvider>
            <CartProvider>
               <App />
           </CartProvider>
         </AuthProvider>
      </PayPalScriptProvider>
   // </React.StrictMode>

)
