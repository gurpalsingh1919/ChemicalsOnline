// src/pages/Home.jsx
//import Layout from '../components/Layout';
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
					<a href="#"><img src="/images/collections/distilled-spirits.jpg" alt="" className="imgResponsive" /></a>
				</div>
				<div className="col-md-4 col-sm-6">
					<a href="#"><img src="/images/collections/extraction.jpg" alt="" className="imgResponsive" /></a>
				</div>
				<div className="col-md-4 col-sm-6">
					<a href="#"><img src="/images/collections/food-flavor.jpg" alt="" className="imgResponsive" /></a>
				</div>
				<div className="col-md-4 col-sm-6">
					<a href="#"><img src="/images/collections/industrial.jpg" alt="" className="imgResponsive" /></a>
				</div>
				<div className="col-md-4 col-sm-6">
					<a href="#"><img src="/images/collections/life-science.jpg" alt="" className="imgResponsive" /></a>
				</div>
				<div className="col-md-4 col-sm-6">
					<a href="#"><img src="/images/collections/personal-care.jpg" alt="" className="imgResponsive" /></a>
				</div>
			</div>
			<div className="row">
				<div className="col-md-12">
					<h2 className="text-center mt-4">FOR MORE INFORMATION ABOUT WHO WE ARE AND WHAT WE DO, <a href="#" className="text-blue">PLEASE CLICK HERE!</a></h2>
				</div>
			</div>
		</div>
   </section>
 </main>
);
}
export default Home;