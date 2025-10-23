import { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import axiosInstance from "../axios"; // adjust path
function ProductDocsDetail() {
  const { slug } = useParams();
  const [product, setProduct] = useState(null);
//import axiosInstance from "../axios"; // adjust path
  // useEffect(() => {
  //   fetch(`/api/product-docs/${slug}`)
  //     .then(res => res.json())
  //     .then(data => setProduct(data));
  // }, [slug]);


useEffect(() => {
    axiosInstance.get(`/api/product-docs/${slug}`).then((res) => {
      console.log(res.data)
      setProduct(res.data);
      setLoading(false);
    });
  }, [slug]);


  if (!product) return <p>Loading...</p>;

  return (
    <section className="contentContainer contentInfo">
      <div className="container">
        <div className="row">
          <div className="col-md-12"><h1>{product.name}</h1></div>

          <div className="col-md-4">
            {product.image && (
              <div><img src={product.image} alt={product.name} className="imgResponsive" /></div>
            )}

            <h3 className="text-center mt-2">{product.code}</h3>
          </div>

          <div className="col-md-8">
            <div className="productDetailInfo">
              <table className="tableProductDdescription">
                <tbody>
                  <tr>
                    <td>CATEGORY</td>
                    <td>{product.category}</td>
                  </tr>
                  <tr>
                    <td>ATTRIBUTE(S)</td>
                    <td>{product.attributes}</td>
                  </tr>
                  <tr>
                    <td>PACKAGING</td>
                    <td>{product.packaging}</td>
                  </tr>
                   {product.formula && (
                  <tr>
                    <td>FORMULA</td>
                    <td>{product.formula}</td>
                  </tr> )}
                   {product.proof_strength && (
                  <tr>
                    <td>PROOF/STRENGTH</td>
                    <td>{product.proof_strength}</td>
                  </tr> )}
                  {product.grades && (
                  <tr>
                    <td>GRADES</td>
                    <td>{product.grades}</td>
                  </tr>
                   )}
                </tbody>
              </table>

              {product.certification && (
                <div className="certifications mt-4">
                  <h3 className="mb-2">CERTIFICATIONS</h3>
                  <div><img src={product.certification} alt="Certification" className="imgResponsive" /></div>
                </div>
              )}
            </div>
          </div>
        </div>

        <div className="supportingDocuments mt-3">
          <div className="row">
            <div className="col-md-12"><h2>SUPPORTING DOCUMENTS</h2></div>
          </div>
          <div className="row d-flex">
            {product.supporting_documents.map((doc, i) => (
              <div className="column" key={i}>
                <a href={doc.file} className="text-center d-block" target="_blank" rel="noopener noreferrer">
                  <div><img src="/images/pdf.svg" alt="PDF icon" /></div>
                  {doc.name}
                </a>
              </div>
            ))}
          </div>
        </div>

        <div className="additionalNotes mt-3">
          <div className="row">
            <div className="col-md-12">
              <h2>ADDITIONAL NOTES</h2>
              <p>{product.notes}</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

export default ProductDocsDetail;