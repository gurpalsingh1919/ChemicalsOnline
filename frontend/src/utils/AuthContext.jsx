// src/utils/AuthContext.jsx
import { createContext, useContext, useState, useEffect } from "react";
import axiosInstance from "../axios";

const AuthContext = createContext();

export function AuthProvider({ children }) {
  const [user, setUser] = useState(undefined); // undefined = not yet loaded
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchUser = async () => {
      try {
        // 👇 get Sanctum CSRF cookie first
        await axiosInstance.get("/sanctum/csrf-cookie");
        const res = await axiosInstance.get("/api/user");
        setUser(res.data);
      } catch (err) {
        setUser(null); // not logged in
      } finally {
        setLoading(false);
      }
    };

    fetchUser();
  }, []);

  const login = (userData) => setUser(userData);

  const logout = async () => {
    try {
      await axiosInstance.post("/logout");
      setUser(null);
    } catch (err) {
      console.error("Logout failed:", err);
    }
  };

  return (
    <AuthContext.Provider value={{ user, setUser, login, logout, loading }}>
      {children}
    </AuthContext.Provider>
  );
}

export const useAuth = () => useContext(AuthContext);
