import React, { createContext, useContext, useState, useEffect } from "react";
import { toast } from "react-toastify";

const CartContext = createContext();
const CART_KEY = "cart";

// helper to read from storage
const getStoredCart = () => {
  try {
    return JSON.parse(localStorage.getItem(CART_KEY)) || [];
  } catch {
    return [];
  }
};

export const CartProvider = ({ children }) => {
  const [cart, setCart] = useState(getStoredCart());

  // persist cart to storage whenever it changes
  useEffect(() => {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
  }, [cart]);

  // sync across tabs
  useEffect(() => {
    const syncCart = () => setCart(getStoredCart());
    window.addEventListener("storage", syncCart);
    return () => window.removeEventListener("storage", syncCart);
  }, []);

  // --- actions ---
  const addToCart = (product, qty = 1) => {
    
    console.log(product)
    setCart((prev) => {
      const index = prev.findIndex((item) => item.id === product.id);
      if (index > -1) {
        const updated = [...prev];
        updated[index].quantity += qty;
        return updated;
      }
      return [...prev, { ...product, quantity: qty }];
    });

      // ✅ Show success toast
    toast.success(`${product.name || "Product"} added to cart!`, {
      position: "top-right",
      autoClose: 2000,
    });

  };

  const removeFromCart = (productId) => {
    console.log('remove-'+productId)
    setCart((prev) => prev.filter((item) => item.id !== productId));
  };

  const updateQuantity = (productId, qty) => {
    setCart((prev) =>
      prev.map((item) =>
        item.id === productId ? { ...item, quantity: qty } : item
      )
    );
  };

  const clearCart = () => setCart([]);

  // --- derived values ---
  const distinctCount = cart.length;
  const itemCount = cart.reduce((sum, i) => sum + (i.quantity || 0), 0);
  const total = cart
    .reduce((sum, i) => sum + (parseFloat(i.price) || 0) * (i.quantity || 0), 0)
    .toFixed(2);

  return (
    <CartContext.Provider
      value={{ cart, addToCart, removeFromCart, updateQuantity, clearCart, itemCount,distinctCount, total }}
    >
      {children}
    </CartContext.Provider>
  );
};

export const useCart = () => useContext(CartContext);
