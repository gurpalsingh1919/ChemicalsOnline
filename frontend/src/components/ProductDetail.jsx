import React, { useEffect, useState } from "react";
import { useParams,useNavigate } from "react-router-dom";
import axiosInstance from "../axios";
import DOMPurify from "dompurify";
import ProductSpecs from './ProductSpecs';
import { useCart  } from "../utils/CartContext";

export default function ProductDetail() {
  const { slug } = useParams();
  const [product, setProduct] = useState(null);
  const [loading, setLoading] = useState(true);
  const [quantity, setQuantity] = useState(1);
  const { addToCart } = useCart();
  const navigate = useNavigate();
   const handleChange = (e) => {
   let val = parseInt(e.target.value);
      if (isNaN(val) || val < 1) {
      setQuantity(1);
   } else {
      setQuantity(val);
   }
}

const handleBuyNow = () => {
    addToCart(product, 1); // ensure it’s in cart
    navigate("/checkout"); // redirect
  };


  useEffect(() => {
    axiosInstance.get(`/api/products/${slug}`).then((res) => {
      console.log(res.data.product)
      setProduct(res.data.product);
      setLoading(false);
    });
  }, [slug]);
  

  if (loading) return <p>Loading...</p>;
  if (!product) return <p>Product not found.</p>;

const cleanHtml = DOMPurify.sanitize(product.description || "");
return (
<>
<div className="row">
   <div className="col-md-5">
      <div className="productLargeThumbCol m-auto">
         <div className="productLargeThumb">
            {/*<img src="/images/products/single-bottle_360x.jpg" alt="" className="imgResponsive" />*/}
             {product.image_url ? (
            <img
              src={product.image_url}
              alt={product.name}
              className="img-fluid"
            />
          ) : (
            <img
              src="/no-image.jpg"
              alt="No Image"
              className="img-fluid"
            />
          )}
         </div>
      </div>
   </div>
   <div className="col-md-7">
      <div className="productDetailInfo">
         <div className="row">
            <div className="col-md-12">
               <h2>{product.name}</h2>
               <h1 className="">${parseFloat(product.price).toFixed(2)}</h1>
            </div>
            <div className="col-md-12">
               
               {/* Parse option_1 */}
              {product.option_1 && (
                <ProductSpecs option_1={product.option_1} />
              )}
              {product.option_2 && (
                <ProductSpecs option_1={product.option_2} />
              )}
              {product.option_3 && (
                <ProductSpecs option_1={product.option_3} />
              )}

               
            </div>
            <div className="col-md-12">
               <div className="productQuantity mb-3">
                  <label>Quantity</label>
                  <div className="d-flex align-items-center">
                     <button
                        className="btn btn-outline-secondary"
                        onClick={() => setQuantity((q) => Math.max(1, q - 1))}
                     >
                     <i className="fa-solid fa-minus"></i>
                     </button>
                     <input
                     type="text"
                     className="form-control text-center"
                     style={{ width: "60px" }}
                     value={quantity}
                     min="1"
                     onChange={handleChange} // 
                     />
                     <button
                        className="btn btn-outline-secondary"
                        onClick={() => setQuantity((q) => q + 1)}
                     >
                     <i className="fa-solid fa-plus"></i>
                     </button>
                  </div>
               </div>
            </div>
            <div className="col-md-12">
               <button className="btn btn-primary customBtn01 mt-2" id="AddToCart-product-template" onClick={() => addToCart(product)}>
               <i className="fa-solid fa-cart-shopping me-2"></i>
               Add to Cart
               </button>
               <button className="btn btn-primary ms-3 mt-2 customBtn01 customBtn01Fill" onClick={() => handleBuyNow(product)} id="buynow-product-template">
               Buy It Now
               </button>
            </div>
            <div className="col-md-12">
              {/* <div className="productDescription">
                  <p>{product.description}</p>
               </div>*/}
                <div className="productDescription"
                    dangerouslySetInnerHTML={{ __html: cleanHtml }}
                  />

            </div>

         </div>
      </div>
   </div>
</div>
</>
);
}
