import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import axiosInstance from "../axios"; // adjust path

const ProductDocumentation = () => {
	 const [products, setProducts] = useState({});

  useEffect(() => {
    axiosInstance.get('/api/product-docs').then(res => {
      setProducts(res.data);
    });
  }, []);

return (
   <section className="contentContainer contentInfo">
		<div className="container">
			<div className="row">
				<div className="col-md-12">
					<h1 className="text-uppercase">Product Documentation</h1>
					<div className="ProductDocumentationList">
						<h2>PRODUCT LIST</h2>
						<p>Select any product to access more information including specifications, safety data sheets and more.</p>
						{Object.entries(products).map(([letter, items]) => (

						<div className=""  key={letter}>
							<h3>{letter}</h3>

							<ul>
							 {items.map(product => (
				              <li key={product.slug}>
				                <Link to={`/pages/${product.slug}`}>{product.name}</Link>
				              </li>
				            ))}

							</ul>
						</div>
						 ))}

						
					</div>
				</div>
			</div>
		</div>
   </section>
);
}
export default ProductDocumentation;