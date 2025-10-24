import { useEffect, useState } from "react";
import { useSearchParams, Link,useNavigate } from "react-router-dom";
import axiosInstance from "../axios";

export default function Search() {
  const [products, setProducts] = useState([]);
  const [searchParams] = useSearchParams();
  const query = searchParams.get("q");
  const [searchTerm, setSearchTerm] = useState("");
  const navigate = useNavigate();
  
  useEffect(() => {
    if (!query) return;

    const fetchResults = async () => {
      try {
        const res = await axiosInstance.get(`/api/products/search?q=${query}`);
        setProducts(res.data);
      } catch (error) {
        console.error("Search error:", error);
      }
    };

    fetchResults();
  }, [query]);



const handleSearch = (e) => {
    e.preventDefault();
    if (searchTerm.trim() !== "") {
      navigate(`/search?q=${encodeURIComponent(searchTerm)}`);
      //setSearchTerm("");
    }
  };

return (
   <section className="contentContainer contentInfo text-center">
		<div className="container">
			<div className="row">
				<div className="col-md-12 mx-auto">
					<h2>Search for products on our site</h2>
               <form onSubmit={handleSearch}>
   					<div className="search-container d-flex searchHeader justify-content-center" id="searchBox">
                   <input type="text" value={query}  onChange={(e) => setSearchTerm(e.target.value)} className="w-50 mb-0"  placeholder="Search all products..." />
                   <button type="submit" className="search-btn greyBg" id="searchBtn"><i className="fas fa-search"></i></button>
                 </div>
               </form>
				</div>
			</div>
          {products.length === 0 ? (
        <h3 className="mt-4">No products found.</h3>
      ) : (
			<div className="searchListing mt-5">
				<div className="row">
             {products.map((product) => (
               <div key={product.id} className="col-lg-2 col-sm-3 col-xs-4">
                  <Link to={`/products/${product.slug}`} className="product">
                     <div className="productThumb">
                        <img 
                               src={product.image_url} 
                               alt={product.name} 
                               className="imgResponsive" 
                             />
                     </div>
                     <div className="productName">{product.name}</div>
                     <div className="productPrice">${parseFloat(product.price).toFixed(2)}</div>
                  </Link>
               </div>
               ))}
				</div>
			</div>
         )}
		</div>
   </section>
 );
}