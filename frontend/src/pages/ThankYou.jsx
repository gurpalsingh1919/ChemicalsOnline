// src/pages/Home.jsx
import { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';

const ThankYou = () => {
  
  const navigate = useNavigate();

  return (
    <div className="d-flex justify-content-center align-items-center">
      <div className="text-center" style={{ maxWidth: "800px", width: "100%", padding: "50px 0px 100px 0px" }}>
        <div className="card-body">
          <h1 className="card-title mb-3 text-primary"> <i
              className="fa-solid fa-circle-check text-success"
              style={{ fontSize: "1.3rem", padding: "0px 10px 0px 0px"  }}
            ></i>Thank You!</h1>
          <p className="card-text text-muted mb-4">
            Your order has been placed successfully.<br />
            We appreciate your time and effort!
          </p>
          <button
            className="btn btn-primary px-4"
            onClick={() => navigate("/")}
          >
            ⬅ Back to Home
          </button>
        </div>
      </div>
    </div>
  );
};
export default ThankYou;