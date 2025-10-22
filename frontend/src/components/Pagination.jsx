import React from "react";

export default function Pagination({ currentPage, lastPage, onPageChange }) {
  const pages = Array.from({ length: lastPage }, (_, i) => i + 1);

  const handleClick = (e, page) => {
    e.preventDefault(); // prevent page reload
    if (page >= 1 && page <= lastPage && page !== currentPage) {
      onPageChange(page);
    }
  };

  return (
    <div className="row">
      <div className="col-md-12">
        <div className="pagination">
          <ul className="pagination-custom m-auto px-0">
            
            {/* First Page */}
            <li className={currentPage === 1 ? "disabled" : ""}>
              <a
                href="#"
                onClick={(e) => handleClick(e, 1)}
                className={currentPage === 1 ? "disabled-link" : ""}
              >
                First
              </a>
            </li>

            {/* Previous Page */}
            <li className={currentPage === 1 ? "disabled" : ""}>
              <a
                href="#"
                onClick={(e) => handleClick(e, currentPage - 1)}
                className={currentPage === 1 ? "disabled-link" : ""}
              >
                Prev
              </a>
            </li>

            {/* Numbered Pages */}
            {pages.map((p) => (
              <li key={p} className={p === currentPage ? "active" : ""}>
                <a href="#" onClick={(e) => handleClick(e, p)}>
                  {p}
                </a>
              </li>
            ))}

            {/* Next Page */}
            <li className={currentPage === lastPage ? "disabled" : ""}>
              <a
                href="#"
                onClick={(e) => handleClick(e, currentPage + 1)}
                className={currentPage === lastPage ? "disabled-link" : ""}
              >
                Next
              </a>
            </li>

            {/* Last Page */}
            <li className={currentPage === lastPage ? "disabled" : ""}>
              <a
                href="#"
                onClick={(e) => handleClick(e, lastPage)}
                className={currentPage === lastPage ? "disabled-link" : ""}
              >
                Last
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  );
}
