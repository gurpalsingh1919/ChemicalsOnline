// src/pages/Home.jsx
// src/pages/Login.jsx
import { useState } from "react";
import { useNavigate, useLocation,Link } from "react-router-dom";
const Home = () => {
return (
<main>
   <section className="contentContainer">
		<div className="container">
			<div className="row">
			<div className="col-md-12">
				<img src="/images/banner.jpg" alt="" className="imgResponsive" />
			</div>
			</div>
		</div>
   </section>
   <section className="collections contentContainer">
		<div className="container">
			<div className="row">
				<div className="col-md-4 col-sm-6">
					<Link to={`/collections/beverage`}><img src="/images/collections/distilled-spirits.jpg" alt="" className="imgResponsive" /></Link>
				</div>
				<div className="col-md-4 col-sm-6">
					<Link to={`/collections/herbal-extraction`}><img src="/images/collections/extraction.jpg" alt="" className="imgResponsive" /></Link>
				</div>
				<div className="col-md-4 col-sm-6">
					<Link to={`/collections/foodflavorfragrance`}><img src="/images/collections/food-flavor.jpg" alt="" className="imgResponsive" /></Link>
				</div>
				<div className="col-md-4 col-sm-6">
					<Link to={`/collections/industrial`}><img src="/images/collections/industrial.jpg" alt="" className="imgResponsive" /></Link>
				</div>
				<div className="col-md-4 col-sm-6">
					<Link to={`/collections/small-molecule-pharma`}><img src="/images/collections/life-science.jpg" alt="" className="imgResponsive" /></Link>
				</div>
				<div className="col-md-4 col-sm-6">
					<Link to={`/collections/personal-carecosmetics`}><img src="/images/collections/personal-care.jpg" alt="" className="imgResponsive" /></Link>
				</div>
			</div>
			<div className="row">
				<div className="col-md-12">
					<h2 className="text-center mt-4">FOR MORE INFORMATION ABOUT WHO WE ARE AND WHAT WE DO, <a href="https://greenfield.com/pharmco/" className="text-blue">PLEASE CLICK HERE!</a></h2>
				</div>
			</div>
		</div>
   </section>
 </main>
);
}
export default Home;