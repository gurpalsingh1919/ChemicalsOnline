import React from "react";

export default function ProductSpecs({ option_1 }) {
  let spec = null;

  try {
    spec = JSON.parse(option_1); // convert string to JS object
  } catch (e) {
    console.error("Invalid JSON:", e);
  }

  if (!spec.name) return null;

  return (
   

    <div className="productSizes">
      <label>{spec.name}</label>
      <select data-index="option1">
         <option value={spec.value}>{spec.value}</option>
      </select>
    </div>

  );
}
