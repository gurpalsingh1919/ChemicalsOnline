import React, { useEffect, useState } from 'react';

import { Link, useLocation } from 'react-router-dom';

const Breadcrumb = () => {
   
  const location = useLocation();
  const paths = location.pathname.split("/").filter(Boolean);

  return (

   <section className="contentContainer pt-0">
      <div className="container">
         <div className="row">
            <div className="col-md-12">
               <ul className="breadcrumb">
                  <li><Link to="/" className="text-blue-600 hover:underline">Home</Link></li>
                  
                     {paths.map((path, index) => {
                        const fullPath = "/" + paths.slice(0, index + 1).join("/");
                        const isLast = index === paths.length - 1;
                        if(path !='collections'){
                        return (
                           <li key={fullPath} className="flex items-center">
                              <span className="divider">{`>`}</span>
                              {isLast ? (
                                <span className="text-gray-500">{path}</span>
                              ) : (
                                <Link to={fullPath} className="text-blue-600 hover:underline capitalize">
                                 {path}
                                </Link>
                              )}
                           </li>
                        );
                      }
                     })}
                  
               </ul>
            </div>
         </div>
      </div>
   </section>
  );
};

export default Breadcrumb;
