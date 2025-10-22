<style type="text/css">
   /*.dropdown-menu {
   right: auto;
    left: 50%;
    -webkit-transform: translate(-50%, 0);
    -o-transform: translate(-50%, 0);
    transform: translate(-50%, 0);
 }
 .dropdown-menu .dropdown-submenu {
   right: inherit;
    left: 100%;
    -webkit-transform: translate(0%, 0);
    -o-transform: translate(0%, 0);
    transform: translate(0%, 0);
 }*/
 .menu-item {
    margin: 0px 20px;
}
.dropdown-menu .menu-item {
   margin: 0px 0px;
 }
 ul.navbar-nav.cas-1-wr {
    margin-right: 50px;
 }
 .navbar-nav {
    padding-left: 0px;
}
.navbar-brand {
   margin-right: 0px;
}
</style>

  <!--nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav w-100 justify-content-between">
          <div class="d-flex">
            <li class="nav-item">
              <a class="nav-link active" href="#">Menu 1</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Menu 2</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Menu 3</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Menu 4</a>
            </li>
          </div>

          <!-- Centered Header -->
          <!--span class="navbar-brand mx-auto d-none d-lg-block">Centered Header</span>

          <div class="d-flex">
            <li class="nav-item">
              <a class="nav-link" href="#">Menu 5</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Menu 6</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Menu 7</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Menu 8</a>
            </li>
          </div>
        </ul>
      </div>
    </div>
  </nav-->




<header class="tob-bar-fix home-page-nav">
   <div id="app" class="cus-header-nav">
      @include('layout.top-navbar')
      <div class="container">
         <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarNavDropdown" class="navbar-collapse collapse w-100">
               <ul id="navbar-nav mr-auto cas-1-wr" class="navbar-nav cas-1-wr w-100 align-items-center justify-content-between">
                 <div class="d-flex">
                  <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-3586" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown menu-item-3586 nav-item cust-derp">
                     <a title="About" href="{{route('about_us')}}" class="nav-link cau-te-n">About US</a>
                     <ul class="dropdown-menu" role="menu">
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-82" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-82 nav-item cust-derp">
                           <a title="Our Company" href="{{route('our_company')}}" class="dropdown-item">
                           Our Company
                           </a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-3957" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3957 nav-item cust-derp">
                           <a title="Missions, values &amp; Strategies" href="{{route('mission_strategy')}}" class="dropdown-item">Missions, values &amp; Strategies
                           </a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4017" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4017 nav-item cust-derp">
                           <a title="Organization Chart" href="{{route('organization_chart')}}" class="dropdown-item">Organization Chart
                           </a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-112" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-112 nav-item cust-derp">
                           <a title="Why Choose United Foods Corporation" href="{{route('why_choose_united_food')}}" class="dropdown-item">Why Choose United Foods Corporation</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-116" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-116 nav-item cust-derp">
                           <a title="Our Culture" href="{{route('our_culture')}}" class="dropdown-item">Our Culture</a>
                        </li>
                        <!--li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-105" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-105 nav-item cust-derp">
                           <a title="Jobs" href="{{route('jobs')}}" class="dropdown-item">Careers</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2087" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2087 nav-item cust-derp">
                           <a title="News" href="{{route('news')}}" class="dropdown-item">News</a>
                        </li-->
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2629" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2629 nav-item cust-derp">
                           <a title="Code of Conduct" href="{{route('code_of_conduct')}}" class="dropdown-item">Code of Conduct</a>
                        </li>
                     </ul>
                  </li>
                  <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-107" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children dropdown menu-item-107 nav-item cust-derp">
                     <a title="Product Lines" href="{{route('processed_foods')}}" class="nav-link cau-te-n">Product Lines</a>
                     <ul class="dropdown-menu" role="menu">
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2283" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2283 nav-item cust-derp">
                           <a title="Bakery &amp; Desserts" href="{{route('bakery_desserts')}}" class="dropdown-item">Bakery &amp; Desserts</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4159" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4159 nav-item cust-derp">
                           <a title="Beverages" href="{{route('beverages')}}" class="dropdown-item">Beverages</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2278" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2278 nav-item cust-derp">
                           <a title="Candies" href="{{route('candies')}}" class="dropdown-item">Candies</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2276" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2276 nav-item cust-derp">
                           <a title="Condiments" href="{{route('spices_condiments')}}" class="dropdown-item">Condiments</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4160" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4160 nav-item cust-derp">
                           <a title="Dairy Products" href="{{route('dairy_products')}}" class="dropdown-item">Dairy Products</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2285" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2285 nav-item cust-derp">
                           <a title="Fresh Vegetables &amp; Produce" href="{{route('fresh_vegetable')}}" class="dropdown-item">Fresh Vegetables &amp; Produce</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4155" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4155 nav-item cust-derp">
                           <a title="Meat &amp; Poultry" href="{{route('meat_poultry')}}" class="dropdown-item">Meat &amp; Poultry</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2280" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2280 nav-item cust-derp">
                           <a title="Nutritional Products" href="{{route('nutritional_products')}}" class="dropdown-item">Nutritional Products</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4156" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4156 nav-item cust-derp">
                           <a title="Seafood" href="{{route('sea_food')}}" class="dropdown-item">Seafood</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4165" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4165 nav-item cust-derp">
                           <a title="Snacks" href="{{route('snacks')}}" class="dropdown-item">Snacks</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2282" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2282 nav-item cust-derp">
                           <a title="Spices &amp; Pickles" href="{{route('pickles')}}" class="dropdown-item">Spices &amp; Pickles</a>
                        </li>
                        
                     </ul>
                  </li>
                  <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2437" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown menu-item-2437 nav-item cust-derp">
                     <a title="Brands" href="#" class="nav-link cau-te-n">Brands</a>
                     <ul class="dropdown-menu" role="menu">
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-265" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-265 nav-item cust-derp">
                           <a title="List of Brands" href="{{route('our_brands')}}" class="dropdown-item">List of Brands</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2440" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2440 nav-item cust-derp">
                           <a title="Brand Promotion" href="{{route('brand_promotion')}}" class="dropdown-item">Brand Promotion</a>
                        </li>
                     </ul>
                  </li>
                  <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2441" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown menu-item-2441 nav-item cust-derp">
                     <a title="Key Partners" href="#" class="nav-link cau-te-n">Key Partners</a>
                     <ul class="dropdown-menu" role="menu">
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-959" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-959 nav-item cust-derp">
                           <a title="List of Key Partners" href="{{route('key_partners')}}" class="dropdown-item">List of Key Partners</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2250" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2250 nav-item cust-derp">
                           <a title="How to Become a Key Partner" href="{{route('how_partner')}}" class="dropdown-item">How to Become a Key Partner</a>
                        </li>
                     </ul>
                  </li>
                  </div>

                  <span class="navbar-brand mx-auto d-none d-lg-block"><a href="{{url('/')}}" class="navbar-brand logo-s temp-height rel=" home"="" itemprop="url">
            <img width="312" height="103" src="{{asset('public/img/UFC_Website_Logo_07.jpg')}}" class="temp-height alt=" united="" foods="" corporation"="" itemprop="logo" srcset="{{asset('public/img/UFC_Website_Logo_07.jpg')}} 312w, {{asset('public/img/UFC_Website_Logo_07.jpg')}} 300w" sizes="100vw">
            </a>                    <!-- <a class="navbar-brand logo-s temp-height" href="">
               <img src="/assets/images/logo.jpg"></a> -->
            <a class="navbar-brand sticky-logo temp-height" href=""><img src=""></a></span>

                  <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown  nav-item cust-derp">
                     <a title="Products" href="#" class="nav-link cau-te-n">Products</a>
                     <ul class="dropdown-menu" role="menu">
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown  nav-item cust-derp">
                           <a title="Plant Based Beverages" href="{{route('plant_based_beverages')}}" class="dropdown-item">Plant Based Beverages</a>
                           <ul class="dropdown-menu dropdown-submenu" role="menu">
                              <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-post_type menu-item-object-page nav-item cust-derp">
                                 <a title="Almondmilk" href="{{route('almond_milk')}}" class="dropdown-item">Almondmilk</a>
                              </li>
                              <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-post_type menu-item-object-page nav-item cust-derp">
                                 <a title="Oatmilk" href="{{route('oat_milk')}}" class="dropdown-item">Oatmilk</a>
                              </li>
                           </ul>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown  nav-item cust-derp">
                           <a title="Juice" href="{{route('juice')}}" class="dropdown-item">Juice</a>
                        <ul class="dropdown-menu dropdown-submenu" role="menu">
                           <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-post_type menu-item-object-page nav-item cust-derp">
                              <a title="Fruit Juice" href="{{route('fruit_juice')}}" class="dropdown-item">Fruit Juice</a>
                           </li>
                           <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-post_type menu-item-object-page nav-item cust-derp">
                              <a title="Vegetable Juice" href="{{route('vegetable_juice')}}" class="dropdown-item">Vegetable Juice</a>
                           </li>
                           <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-post_type menu-item-object-page nav-item cust-derp">
                              <a title="Fruit and Vegetable Juice" href="{{route('fruit_and_vegetable_juice')}}" class="dropdown-item">Fruit and Vegetable Juice</a>
                           </li>
                           <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-post_type menu-item-object-page nav-item cust-derp">
                              <a title="Concentrates" href="{{route('concentrates')}}" class="dropdown-item">Concentrates</a>
                           </li>
                           <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-post_type menu-item-object-page nav-item cust-derp">
                              <a title="Fruit Blends" href="{{route('fruit_blends')}}" class="dropdown-item">Fruit Blends</a>
                           </li>
                        </ul>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown  nav-item cust-derp">
                           <a title="Frozen Novelties" href="{{route('frozen_novelties')}}" class="dropdown-item">Frozen Novelties</a>
                           <ul class="dropdown-menu dropdown-submenu" role="menu">
                              <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-post_type menu-item-object-page nav-item cust-derp">
                                 <a title="Fruit" href="{{route('fruit')}}" class="dropdown-item">Fruit</a>
                              </li>
                              <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-post_type menu-item-object-page nav-item cust-derp">
                                 <a title="Vegetable" href="{{route('vegetable')}}" class="dropdown-item">Vegetable</a>
                              </li>
                              <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-post_type menu-item-object-page nav-item cust-derp">
                                 <a title="Seasonal Novelties" href="{{route('seasonal_novelties')}}" class="dropdown-item">Seasonal Novelties</a>
                              </li>
                           </ul>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown  nav-item cust-derp">
                           <a title="Lemonade, Tea, & Water" href="{{route('lemonade_tea_water')}}" class="dropdown-item">Lemonade, Tea, & Water</a>
                           <ul class="dropdown-menu dropdown-submenu" role="menu">
                              <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-post_type menu-item-object-page nav-item cust-derp">
                                 <a title="Water" href="{{route('water')}}" class="dropdown-item">Water</a>
                              </li>
                              <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="" class="menu-item menu-item-type-post_type menu-item-object-page nav-item cust-derp">
                                 <a title="Lemonade & Tea" href="{{route('lemonade_and_tea')}}" class="dropdown-item">Lemonade & Tea</a>
                              </li>
                           </ul>
                        </li>
                     </ul>
                  </li>
                  <div class="d-flex">
                  <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4061" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown menu-item-4061 nav-item cust-derp">
                     <a title="Locations" href="#" class="nav-link cau-te-n">Locations</a>
                     <ul class="dropdown-menu" role="menu">
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4078" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4078 nav-item cust-derp">
                           <a title="East Brunswick, New Jersey, USA" href="{{route('new_jersey')}}" class="dropdown-item">East Brunswick, New Jersey, USA</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4077" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4077 nav-item cust-derp">
                           <a title="Cerquilho, São Paulo, Brazil" href="{{route('cerquilho_brazil')}}" class="dropdown-item">Cerquilho, São Paulo, Brazil</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4094" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4094 nav-item cust-derp">
                           <a title="Buenos Aires, Argentina" href="{{route('caba_argentina')}}" class="dropdown-item">Buenos Aires, Argentina</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4103" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4103 nav-item cust-derp">
                           <a title="Chandigarh, India" href="{{route('chandigarh_india')}}" class="dropdown-item">Chandigarh, India</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4076" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4076 nav-item cust-derp">
                           <a title="Vadodara, India" href="{{route('vadodara_india')}}" class="dropdown-item">Ahmedabad, India</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4082" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4082 nav-item cust-derp">
                           <a title="Barranquilla, Colombia" href="{{route('columbia')}}" class="dropdown-item">Barranquilla, Colombia</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4092" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4092 nav-item cust-derp">
                           <a title="Shanghai, China" href="{{route('shanghai_china')}}" class="dropdown-item">Shanghai, China</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-4090" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4090 nav-item cust-derp">
                           <a title="Turkey" href="{{route('turkey')}}" class="dropdown-item">Turkey</a>
                        </li>
                     </ul>
                  </li>
                  <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2327" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children dropdown menu-item-2327 nav-item cust-derp">
                     <a title="Contact us" href="{{route('contact_us')}}" class="nav-link cau-te-n">Contact us</a>
                     <ul class="dropdown-menu" role="menu">
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-98" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-98 nav-item cust-derp">
                           <a title="Become A Customer" href="{{route('become_customer')}}" class="dropdown-item">Become A Customer</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-117" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-117 nav-item cust-derp">
                           <a title="Contact us" href="{{route('contact_us')}}" class="dropdown-item">Contact us</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-89" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-89 nav-item cust-derp">
                           <a title="Our Locations" href="{{route('our_locations')}}" class="dropdown-item">Our Locations</a>
                        </li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-2087" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2087 nav-item cust-derp">
                           <a title="Contact Form" href="{{route('product_line')}}" class="dropdown-item">Contact Form</a>
                        </li>
                     </ul>
                  </li>
                  <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-261" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-179 menu-item-261 nav-item cust-derp">
                     <a title="Home" href="{{url('/')}}" class="nav-link cau-te-n">Home</a>
                  </li>
               </div>
               </ul>
               <ul id="cdl-search-nav" class="navbar-nav search-icon">
                  <li class="nav-item">
                     <form role="search" method="get" class="search-form" action="{{route('search')}}">
                        <input type="search" placeholder="Search" autocomplete="off" class="form-control search-field search-input-cl" name="s">
                     </form>
                     </li>&nbsp; &nbsp;<li class="nav-item"><i class="fa fa-search ser-icon-cl" aria-hidden="true"></i></li>
                  <!--<li class="nav-item">
                  	<form role="search" method="get" class="search-form" action="{{route('search')}}">
                  		<input type="search" placeholder="Search" autocomplete="off" class="form-control search-field search-input-cl" name="s">
                  	</form>
                         <i class="fa fa-search ser-icon-cl" aria-hidden="true"></i>
                  </li>
                   <li class="nav-item">&nbsp;</li> -->
                  </ul>
            </div>
         </nav>
      </div>
   </div>
   <style type="text/css">
      ul.dropdown-menu li:hover ul.dropdown-menu.dropdown-submenu {
      display: block !important;
      }
      ul.dropdown-menu li:hover a {
      color: #56B146 !important;
      }
      ul.dropdown-menu.dropdown-submenu {
      display: none !important;
      }
      ul.dropdown-menu.dropdown-submenu li a {
      color: #fff !important;
      }
      ul.dropdown-menu.dropdown-submenu li:hover a {
      color: #56B146 !important;
      }
      a .productName {
      line-height: 17px;
      font-size: 15px;
      padding-top: 15px;
      padding-bottom: 10px;
      color: #212529;
      }
      a .productSize {
      font-size: 14px;
      padding-bottom: 15px;
      display: block;
      position: relative;
      color: #212529;
      }
      .productSize:before {
      background: #1533b7;
      content: "";
      height: .0625rem;
      left: 50%;
      margin-left: -0.90625rem;
      position: absolute;
      top: -4px;
      width: 1.8125rem;
      }
      #productDetailTab {
      width: 100%;
      max-width: 100%;
      margin-left: 0px !important;
      }
      #productDetailTab .nav-item {
      border-bottom: .0625rem solid #c1ccc2;
      color: #212529;
      text-align: center;
      width: 25%;
      padding: 8px;
      }
      #productDetailTab .nav-link {
      color: #212529;
      }
      #productDetailTab li.nav-item.active {
      background: #1533b7;
      }
      #productDetailTab .nav-item.active .nav-link {
      color: #ffffff;
      opacity: 1;
      }
      #productDetailTab .nav-link.active:after {
      display: none;
      }
      .productNutritionFactsInfo {
      width: 90%;
      }
      .productNutritionFactsInfo td {
      padding: 5px;
      }
      .company-brand-logo {
      max-width: 120px;
      }
      .prdouctDetailCol h2 {
      font-size: 48px;
      font-weight: 800;
      color: #1533b7;
      letter-spacing: 0.6;
      line-height: 50px;
      margin-bottom: 12px;
      }
      .prdouctDetailCol h5 {
      color: #2c402f;
      font-size: 22px;
      letter-spacing: .44px;
      margin-bottom: 35px;
      }
      .prdouctDetailCol ul {
      list-style-type: disc;
      font-size: 17px;
      margin-bottom: 45px !important;
      }
      .prdouctDetailCol ul li {
      margin-bottom: 13px;
      font-weight: 600;
      }
      .productPdfFile a {
      padding: 12px 16px !important;
      font-size: 18px;
      font-weight: 700;
      }
      .productTemperatureAndKosher {
      display: flex;
      }
      .productTemperatureAndKosherOuter {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: justify;
      -ms-flex-pack: justify;
      justify-content: space-between;
      max-width: 450px;
      }
      .productTemperatureAndKosher .leftCol {
      max-width: 104px;
      font-size: 18px;
      line-height: 24px;
      }
      .productTemperatureAndKosher .rightCol {
      position: relative;
      margin-left: 23px;
      }
      .productTemperatureAndKosher .rightCol img {
      height: 3.75rem;
      position: relative;
      z-index: 3;
      }
      .sideKicksvBlend {
      max-width: 200px;
      margin-bottom: 20px;
      }
      .sideKicks {
      max-width: 165px;
      margin-bottom: 20px;
      }
      .paddingLR140 {
       padding-left: 140px;
       padding-right: 140px;
       text-align: center;
      }
   </style>
</header>