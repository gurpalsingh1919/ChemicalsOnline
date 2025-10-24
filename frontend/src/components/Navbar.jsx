import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';

const Nav = () => {
  
  return (
    <>
        <nav className="navbar navbar-expand-lg">
          <div className="container">
            <button
              className="navbar-toggler collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarNavDropdown"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span className="navbar-toggler-icon"></span>
            </button>
            <div className="collapse navbar-collapse" id="navbarNavDropdown">
              {/*<div className="search-container d-flex" id="searchBox">
                <input type="text" className="search-input" id="searchInput" placeholder="Search all products..." />
                <button className="search-btn" id="searchBtn"><i className="fas fa-search"></i></button>
              </div>*/}
              <ul className="navbar-nav">
                <li className="nav-item dropdown">
                  <Link to={`/collections/organic-alcohols`} className="nav-link">SHOP BY PRODUCTS</Link>
                  <span className="icon"><i className="fa-solid fa-chevron-down dropdown-icon"></i></span>
                  <ul className="subMenu">
                    <li><Link to={`/collections/organic-alcohols`}>ORGANIC ALCOHOLS</Link></li>
                    <li><Link to={`/collections/non-gmo-alcohol`}>NON-GMO ALCOHOLS</Link></li>
                    <li><Link to={`/collections/pure-ethanol`}>PURE ETHANOL</Link></li>
                    <li><Link to={`/collections/tax-free-ethanol`}>TAX FREE ETHANOL</Link></li>
                    <li><Link to={`/collections/denatured-alcohols`}>DENATURAL ALCOHOL</Link></li>
                    <li><Link to={`/collections/ipa-isopropyl-alcohol`}>IPA (ISOPROPYL ALCOHOL) </Link></li>

                    <li><Link to={`/collections/acetone`}>ACETONE</Link></li>
                    <li><Link to={`/collections/water`}>WATER</Link></li>
                    <li><Link to={`/collections/ethyl-acetate`}>ETHYLACETATE</Link></li>
                    <li><Link to={`/collections/n-heptane`}>N-HEPTANE</Link></li>
                    <li><Link to={`/collections/acetonitrile`}>ACETONITRILE</Link></li>
                    <li><Link to={`/collections/glycerin`}>GLYCERIN <i className="fa-solid fa-chevron-right dropdown-icon subMenuIcon"></i></Link>
                      <ul className="subMenu02">
                        <li><Link to={`/collections/glycerin/usp-kosher`}>USP KOSHER</Link></li>
                       </ul>
                    </li>
                    <li><Link to={`/collections/mct-oil`}>MCT OIL</Link></li>
                    <li><Link to={`/collections/additives-modifiers`}>ADDITIVES & MODIFIERS <i className="fa-solid fa-chevron-right dropdown-icon subMenuIcon"></i></Link>
                      <ul className="subMenu02">
                        <li><Link to={`/collections/additives-modifiers/polymers-additives`}>POLYMERS ADDITIVES <i className="fa-solid fa-chevron-right dropdown-icon subMenuIcon"></i></Link></li>
                       </ul>
                    </li>
                    <li><Link to={`/collections/cosmetic-compounds`}>COSMETIC COMPOUNDS</Link></li>
                    <li><Link to={`/collections/chelants`}>CHELANTS</Link></li>
                    <li><Link to={`/collections/polymers-resins`}>POLYMERS & RESINS</Link></li>
                    <li><Link to={`/collections/polybutene-pib`}>POLYBUTENE (PIB)</Link></li>
                    <li><Link to={`/collections/oleochemicals`}>OLEOCHEMICALS</Link></li>
                    <li><Link to={`/collections/water-treatment`}>WATER TREATMENT</Link></li>
                    <li><Link to={`/collections/silicones`}>SILICONES <i className="fa-solid fa-chevron-right dropdown-icon subMenuIcon"></i></Link>
                      <ul className="subMenu02">
                        <li><Link to={`/collections/silicones/silicones-emulsion`}>SILICONE EMULSION</Link></li>
                        <li><Link to={`/collections/silicones/silicone-fluids`}>SILICONE FLUIDS</Link></li>
                        <li><Link to={`/collections/silicones/additional-silicones`}>ADDITIONAL SILICONES</Link></li>
                       </ul>
                    </li>
                    <li><Link to={`/collections/surfactants`}>SURFACTANTS <i className="fa-solid fa-chevron-right dropdown-icon subMenuIcon"></i></Link>
                      <ul className="subMenu02">
                        <li><Link to={`/collections/surfactants/lauramine-oxide`}>LAURAMINE OXIDE</Link></li>
                        <li><Link to={`/collections/surfactants/anionics`}>ANIONICS</Link></li>
                      </ul>
                    </li>
                    <li><Link to={`/collections/essential-ingredients`}>ESSENTIAL INGREDIENTS <i className="fa-solid fa-chevron-right dropdown-icon subMenuIcon"></i></Link>
                      <ul className="subMenu02">
                        <li><Link to={`/collections/essential-ingredients/caustic-soda`}>CAUSTIC SODA</Link></li>
                        <li><Link to={`/collections/essential-ingredients/enzymes`}>ENZYMES</Link></li>
                        <li><Link to={`/collections/essential-ingredients/hydroxides`}>HYDROXIDES</Link></li>
                        <li><Link to={`/collections/essential-ingredients/vitamins`}>VITAMINS</Link></li>
                        <li><Link to={`/collections/essential-ingredients/acids`}>ACIDS</Link></li>
                        <li><Link to={`/collections/essential-ingredients/citric-acid`}>CITRIC ACID</Link></li>
                        <li><Link to={`/collections/essential-ingredients/lactic-acid`}>LACTIC ACID</Link></li>
                        <li><Link to={`/collections/essential-ingredients/phosphoric-acid`}>PHOSPHORIC ACID</Link></li>
                        <li><Link to={`/collections/essential-ingredients/acids`}>ACIDS</Link></li>
                        <li><Link to={`/collections/essential-ingredients/organic-acids`}>ORGANIC ACIDS</Link></li>
                        <li><Link to={`/collections/essential-ingredients/salts`}>SALTS</Link></li>
                        <li><Link to={`/collections/essential-ingredients/organic-salts`}>ORGANIC SALTS</Link></li>
                        <li><Link to={`/collections/essential-ingredients/carbonates`}>CARBONATES</Link></li>
                        <li><Link to={`/collections/essential-ingredients/calcium-carbonates`}>CALCIUM CARBONATES</Link></li>
                        <li><Link to={`/collections/essential-ingredients/sodium-carbonates`}>SODIUM  CARBONATES</Link></li>
                        <li><Link to={`/collections/essential-ingredients/additional-essentials`}>ADDITIONAL ESSENTIALS</Link></li>
                      </ul>
                    </li>
                    <li><Link to={`/collections/solvents`}>SOLVENTS <i className="fa-solid fa-chevron-right dropdown-icon subMenuIcon"></i></Link>
                      <ul className="subMenu02">
                        <li><Link to={`/collections/solvents/amines`}>AMINES</Link></li>
                        <li><Link to={`/collections/solvents/amides`}>AMIDES</Link></li>
                        <li><Link to={`/collections/solvents/deionized-water`}>DEIONIZED WATER</Link></li>
                        <li><Link to={`/collections/solvents/alcohols`}>ALCOHOLS</Link></li>
                        <li><Link to={`/collections/solvents/isopropyl-alcohol`}>ISOPROPYL ALCOHOL</Link></li>
                        <li><Link to={`/collections/solvents/butanol`}>BUTANOL</Link></li>
                        <li><Link to={`/collections/solvents/propanol`}>PROPANOL</Link></li>
                        <li><Link to={`/collections/solvents/benzyl-alcohol`}>BENZYL ALCOHOL</Link></li>
                        <li><Link to={`/collections/solvents/esters`}>ESTERS</Link></li>
                        <li><Link to={`/collections/solvents/ester-eep`}>ESTER EEP</Link></li>
                        <li><Link to={`/collections/solvents/ethyl-acetate-ester`}>ETHYL ACETATE (ESTER)</Link></li>
                        <li><Link to={`/collections/solvents/tert-butyl-acetate`}>TERT-BUTYL ACETATE</Link></li>
                        <li><Link to={`/collections/solvents/glycols`}>GLYCOLS</Link></li>
                        <li><Link to={`/collections/solvents/propylene-glycol`}>PROPYLENE GLYCOL</Link></li>
                        <li><Link to={`/collections/solvents/diethylene-glycol`}>DIETHYLENE GLYCOL</Link></li>
                        <li><Link to={`/collections/solvents/hexylene-glycol`}>HEXYLENE GLYCOL</Link></li>
                        <li><Link to={`/collections/solvents/butylene-glycols`}>BUTYLENE GLYCOLS</Link></li>
                        <li><Link to={`/collections/solvents/glycol-ether-db`}>GLYCOL ETHER DB</Link></li>
                        <li><Link to={`/collections/solvents/glycol-ethers-dpnb`}>GLYCOL ETHERS DPNB</Link></li>
                        <li><Link to={`/collections/solvents/glycol-ethers-eb`}>GLYCOL ETHERS EB</Link></li>
                        <li><Link to={`/collections/solvents/glycol-ethers-pm`}>GLYCOL ETHERS PM</Link></li>
                        <li><Link to={`/collections/solvents/hydrocarbons`}>HYDROCARBONS</Link></li>
                        <li><Link to={`/collections/solvents/aromatics`}>AROMATICS</Link></li>
                        <li><Link to={`/collections/solvents/mineral-spirits`}>MINERAL SPIRITS</Link></li>
                        <li><Link to={`/collections/solvents/vmp-naphtha`}>VM&P NAPHTHA</Link></li>
                        <li><Link to={`/collections/solvents/xylene`}>XYLENE</Link></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li className="nav-item dropdown">
                  <Link to="#" className="nav-link">SHOP BY INDUSTRY</Link>
                  <span className="icon"><i className="fa-solid fa-chevron-down dropdown-icon"></i></span>
                  <ul className="subMenu">
                    <li><Link to={`/collections/small-molecule-pharma`}>SMALL MOLECULE PHARMA</Link></li>
                    <li><Link to={`/collections/large-molecule-pharmabioprocessing`}>LARGE MOLECULE PHARMA/BIOPROCESSING</Link></li>
                    <li><Link to={`/collections/labs`}>LABS</Link></li>
                    <li><Link to={`/collections/beverage`}>BEVERAGE</Link></li>
                    <li><Link to={`/collections/industrial`}>INDUSTRIAL</Link></li>
                    <li><Link to={`/collections/personal-carecosmetics`}>PERSONAL CARE/COSMETICS</Link></li>
                    <li><Link to={`/collections/herbal-extraction`}>HERBAL EXTRACTION</Link></li>
                    <li><Link to={`/collections/medical-device`}>MEDICAL DEVICE</Link></li>
                    <li><Link to={`/collections/nutraceutical`}>NUTRACEUTICAL</Link></li>
                    <li><Link to={`/collections/foodflavorfragrance`}>FOOD/FLAVOR/FRAGRANCE</Link></li>
                   {/*<li><Link to={`/collections/glycerin`}>SMALL MOLECULE PHARMA</Link></li>
                    <li><Link to={`/collections/surfactants`}>LARGE MOLECULE PHARMA/BIOPROCESSING</Link></li>
                    <li><Link to={`/collections/non-gmo-alcohol`}>LABS</Link></li>
                    <li><Link to={`/collections/water-treatment`}>BEVERAGE</Link></li>
                    <li><Link to={`/collections/essential-ingredients`}>INDUSTRIAL</Link></li>
                    <li><Link to={`/collections/solvents`}>PERSONAL CARE/COSMETICS</Link></li>
                    <li><Link to={`/collections/tax-free-ethanol`}>HERBAL EXTRACTION</Link></li>
                    <li><Link to={`/collections/cosmetic-compounds`}>MEDICAL DEVICE</Link></li>
                    <li><Link to={`/collections/silicones`}>NUTRACEUTICAL</Link></li>
                    <li><Link to={`/collections/solvents`}>FOOD/FLAVOR/FRAGRANCE</Link></li>*/}
                  </ul>
                </li>
                <li className="nav-item dropdown">
                  <Link to="#" className="nav-link">SUPPORT</Link>
                  <span className="icon"><i className="fa-solid fa-chevron-down dropdown-icon"></i></span>
                  <ul className="subMenu">
                    <li><Link to="/pages/product-documentation">Product Documentation</Link></li>
                    <li><Link to="/faqs">FAQ'S</Link></li>
                    {/*<li><Link to="#">Terms & Conditions</Link></li>*/}
                    <li><Link to="/contact-us">Contact Us</Link></li>
                  </ul>
                </li>
                <li className="nav-item"><Link to="/news" className="nav-link">NEWS</Link></li>
                <li className="nav-item"><Link to="/login" className="nav-link d-none">Sign In</Link></li>
                <li className="nav-item"><Link to="/register" className="nav-link  d-none">Create an Account</Link></li>
                <li className="nav-item"><Link to="/login" className="nav-link  d-none">Logout</Link></li>
              </ul>
            </div>
          </div>
        </nav>
    </>
  );
}

export default Nav;
