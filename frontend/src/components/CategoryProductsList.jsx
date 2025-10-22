import React, { useEffect, useState } from 'react';
import Pagination from './Pagination';
import "@fortawesome/fontawesome-free/css/all.min.css";
import { Link } from 'react-router-dom';
import axiosInstance from "../axios"; // adjust path
import { useParams } from "react-router-dom";
const api_url=import.meta.env.VITE_API_URL;

export default function CategoryProductsList() {
  const { categorySlug, subcategorySlug } = useParams();
  const [products, setProducts] = useState([]);
  const [subcategories, setSubcategories] = useState([]);
  const [category, setCategory] = useState(null);
  const [loading, setLoading] = useState(true);
   const [isActive, setIsActive] = useState(false);

   const [sortBy, setSortBy] = useState("title-ascending");
   const [page, setPage] = useState(1); // ✅ new state for pagination

  useEffect(() => {
    setLoading(true);

    // const url = subcategorySlug
    //   ? `/api/collections/${categorySlug}/${subcategorySlug}`
    //   : `/api/collections/${categorySlug}`;

      let url = `/api/collections`;

     if (categorySlug && subcategorySlug) {
       url += `/${categorySlug}/${subcategorySlug}`;
     } else if (categorySlug) {
       url += `/${categorySlug}`;
     }


    axiosInstance.get(url, { params: { sortBy, page } }).then((res) => {
      console.log(res.data)
      setProducts(res.data.products);
      setCategory(res.data.category);
      setSubcategories(res.data.subcategories || []);
      setLoading(false);
    });
  }, [categorySlug, subcategorySlug, sortBy, page]);

  if (loading) return <p>Loading...</p>;



  return (
    <>

      <div className="row">
         <div className="col-md-3 d-flex">
            <div className="categoriesListCol">
               <h3>Shop By</h3>
               { subcategories.length > 0 && (
               <ul className="categoriesList">
               
                  {subcategories.map((sub) => (
                     <li key={sub.id}>
                        <Link to={`/collections/${category.slug}/${sub.slug}`} title={sub.name}>{sub.name}</Link>
                     </li>
                  ))}
               
               </ul>)}
            </div>
         </div>
         <div className="col-md-9 d-flex ">
            <div className={`productList w-100 ${isActive ? "productListView" : ""}`}>
               <div className="row">
                  <div className="d-flex justify-content-between headingBar">
                     <h1 className="mb-0 w-100">{category?.name}</h1>
                     <div className="filterSelect w-100 d-flex align-items-center justify-content-end">
                        <div className="d-flex align-items-center">
                           <label className="mb-0">Sort by</label>
                           <select name="sortBy" id="sortBy" className="sortBy"  value={sortBy} onChange={(e) => {
                               setSortBy(e.target.value);
                               setPage(1);
                             }}>
                             <option value="title-ascending">Alphabetically, A-Z</option>
                             <option value="title-descending">Alphabetically, Z-A</option>
                             <option value="price-ascending">Price, low to high</option>
                             <option value="price-descending">Price, high to low</option>
                             <option value="created-descending">Date, new to old</option>
                             <option value="created-ascending">Date, old to new</option>
                           </select>
                        </div>
                        <div className="productView">
                           <a href="javascrpit:void();" title="Grid view" className="change-view" data-view="grid" onClick={() => setIsActive(false)}>
                              <i className="fa-solid fa-table-cells"></i>  
                           </a>
                           <a href="javascrpit:void();" title="List view" className="change-view ms-2" data-view="list" onClick={() => setIsActive(true)}  >
                              <i className="fa-solid fa-list"></i>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div className="row">
                {products.data.map((p) => (

                  <div key={p.id} className='col-lg-3 col-sm-4 col-xs-6'>
                     <Link to={`/products/${p.slug}`}  className='product'>
                    
                        <div className='productThumb'>
                        
                          
                             <img 
                               src={p.image_url} 
                               alt={p.name} 
                               className="imgResponsive" 
                             />
                          
                        </div>
                        <div className='productName'>{p.name}</div>
                        <div className='productPrice'>${parseFloat(p.price).toFixed(2)}</div>
                      </Link>
                  </div>

                 
                 ))}
                  
                  
               </div>
            </div>
         </div>
      </div>
      {products && products.last_page > 1 && (
      <Pagination 
        currentPage={products.current_page} 
        lastPage={products.last_page} 
        onPageChange={(page) => setPage(page)} 
      />
      )}

    </>
  );
}

