import React, { useEffect, useState } from 'react';
import Pagination from '../components/Pagination';
import "@fortawesome/fontawesome-free/css/all.min.css";
import { Link } from 'react-router-dom';
import axiosInstance from "../axios"; // adjust path

const api_url=import.meta.env.VITE_API_URL;

const ProductList = () => {
   const [products, setProducts] = useState([]);
   const [pagination, setPagination] = useState({});

   const [page, setPage] = useState(1);
   const [search, setSearch] = useState('');
   const pageGroupSize = 4;
   const currentGroup = Math.ceil(page / pageGroupSize);
   const startPage = (currentGroup - 1) * pageGroupSize + 1;
   const endPage = Math.min(startPage + pageGroupSize - 1, pagination.last_page);


   const fetchProducts = async (page, search) => {
    const res = await axiosInstance.get(`api/products`, {
      params: {
        page,
        search,
      },
      withCredentials: true,
    });
    console.log(res)
    setProducts(res.data.data);
    setPagination({
      current_page: res.data.current_page,
      last_page: res.data.last_page,
    });
    };
    const handleSearch = (e) => {
    setSearch(e.target.value);
    setPage(1); // reset page to 1
  };
//console.log( axiosInstance)

 useEffect(() => {
    fetchProducts(page, search);
    }, [page, search]);
const [isActive, setIsActive] = useState(false);
  return (
    <>

      <div className="row">
         <div className="col-md-3 d-flex">
            <div className="categoriesListCol">
               <h3>Shop By</h3>
               <ul className="categoriesList">
                  <li><a href="#" title="BEVERAGE">BEVERAGE</a></li>
                  <li><a href="#" title="FOOD/FLAVOR/FRAGRANCE">FOOD / FLAVOR / FRAGRANCE</a></li>
                  <li><a href="#" title="HERBAL EXTRACTION">HERBAL EXTRACTION</a></li>
                  <li><a href="#" title="LABS">LABS</a></li>
                  <li><a href="#" title="LARGE MOLECULE PHARMA/BIOPROCESSING">LARGE MOLECULE PHARMA/BIOPROCESSING</a></li>
                  <li><a href="#" title="MEDICAL DEVICE">MEDICAL DEVICE</a></li>
                  <li><a href="#" title="NON-GMO ALCOHOLS">NON-GMO ALCOHOLS</a></li>
                  <li><a href="#" title="NUTRACEUTICAL">NUTRACEUTICAL</a></li>
                  <li><a href="#" title="ORGANIC ALCOHOLS">ORGANIC ALCOHOLS</a></li>
                  <li><a href="#" title="PERSONAL CARE/COSMETICS">PERSONAL CARE/COSMETICS</a></li>
                  <li><a href="#" title="PURE ETHANOL">PURE ETHANOL</a></li>
                  <li><a href="#" title="SMALL MOLECULE PHARMA">SMALL MOLECULE PHARMA</a></li>
               </ul>
            </div>
         </div>
         <div className="col-md-9 d-flex ">
            <div className={`productList ${isActive ? "productListView" : ""}`}>
               <div className="row">
                  <div className="d-flex justify-content-between headingBar">
                     <h1 className="mb-0 w-100">ORGANIC ALCOHOLS</h1>
                     <div className="filterSelect w-100 d-flex align-items-center justify-content-end">
                        <div className="d-flex align-items-center">
                           <label className="mb-0">Sort by</label>
                           <select name="sortBy" id="sortBy" data-default-sort="best-selling" className="sortBy">
                             <option value="manual">Featured</option>
                             <option value="best-selling">Best Selling</option>
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
                {products.map((p) => (

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
                        <div className='productPrice'>${p.price}<sup>00</sup></div>
                      </Link>
                  </div>

                 
                 ))}
                  
                  
               </div>
            </div>
         </div>
      </div>
      
      <div className="row">
         <div className="col-md-12">
         <div className="pagination">
            <ul className="pagination-custom m-auto px-0">
               <li className="page-item disabled">
                  <button className="page-link"  disabled={page === 1} onClick={() => setPage((prev) => Math.max(1, startPage - 1))}>
                    <span aria-hidden="true">&laquo;</span>
                    <span className="sr-only">Previous</span>
                  </button>
               </li>
               {Array.from({ length: endPage - startPage + 1 }, (_, i) => startPage + i).map((num) => (
                 <li className="page-item" key={num}>
                 <button className={(page === num)?'page-link  active':'page-link'}
                   key={num}
                   onClick={() => setPage(num)}
                   style={{
                     fontWeight: page === num ? 'bold' : 'normal',
                     margin: '0 3px',
                   }}
                 >
                   {num}
                 </button>
                 </li>
               ))}

                       
               <li className="page-item">
                   <button className="page-link" disabled={page === pagination.last_page}
                 onClick={() => setPage((prev) => Math.min(pagination.last_page, endPage + 1))}>
                     <span aria-hidden="true">&raquo;</span>
                     <span className="sr-only">Next</span>
                   </button>
                 </li>
            </ul>
         </div>
         </div>
      </div>

    </>
  );
}

export default ProductList;
