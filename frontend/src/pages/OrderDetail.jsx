// src/pages/OrderDetail.jsx
import { useEffect, useState } from "react";
import { useParams, Link } from "react-router-dom";
import axiosInstance from "../axios";

export default function OrderDetail() {
  const { id } = useParams();
  const [order, setOrder] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  useEffect(() => {
    const fetchOrder = async () => {
      try {
        const response = await axiosInstance.get(`/api/my-orders/${id}`);
        setOrder(response.data);
      } catch (err) {
        setError("Unable to fetch order details.");
      } finally {
        setLoading(false);
      }
    };

    fetchOrder();
  }, [id]);

  if (loading) return <p className="text-center mt-5">Loading...</p>;
  if (error) return <p className="text-danger text-center mt-5">{error}</p>;
  if (!order) return <p className="text-center mt-5">Order not found.</p>;

  return (
    <section className="contentContainer myAccount">
      <div className="container">
        <div className="row">
          <div className="col-md-12">
            <div className="d-flex align-items-center justify-content-between">
              <h1 className="text-uppercase">Order Details</h1>
              <Link to="/my-account" className="editButton">
                Back
              </Link>
            </div>
          </div>
        </div>

        <div className="myProfile mt-2">
          <div className="row">
            <div className="col-lg-12">
              <div className="orderInformation">
                <div className="row">
                  <div className="col-md-6 mb-2">
                    <strong>Order ID:</strong>
                    <span className="ms-2">{order.id}</span>
                  </div>
                  <div className="col-md-6 mb-2">
                    <strong>Order Date:</strong>
                    <span className="ms-2">
                      {new Date(order.created_at).toLocaleDateString()}
                    </span>
                  </div>
                  <div className="col-md-6 mb-2">
                    <strong>Total Cost:</strong>
                    <span className="ms-2">${order.total_amount}</span>
                  </div>
                  <div className="col-md-6 mb-2">
                    <strong>Status:</strong>
                    <span className="ms-2">{order.status}</span>
                  </div>
                  <div className="col-md-12 mb-2">
                    <strong>Shipping Address:</strong>
                    <span className="ms-2">{order.shipping_address}</span>
                  </div>
                </div>
              </div>
            </div>

            <div className="col-lg-12">
              <div className="orderItemsDetail mt-5">
                <h2>Items Details</h2>
                <div className="shoppingCartProducts checkoutCart">
                  {order.items.map((item) => (
                    <div className="cart-row mt-2" key={item.id}>
                      <div className="row align-items-center">
                        <div className="col-md-8 col-sm-8">
                          <div className="d-flex align-items-center">
                            <div className="productImage">
                              <img
                                src={
                                  item.product?.image?.url ||
                                  "/images/placeholder.png"
                                }
                                alt={item.product?.name}
                                className="imgResponsive"
                              />
                            </div>
                            <Link
                              to={`/product/${item.product?.slug}`}
                              className="productName ms-2"
                            >
                              {item.product?.name}
                            </Link>
                          </div>
                        </div>
                        <div className="col-md-4 col-sm-4">
                          <div className="d-flex justify-content-between">
                            <div className="productQuantity">
                              {item.quantity}
                            </div>
                            <div className="productPriceOuter d-flex">
                              <div className="productPrice">
                                ${item.price}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  ))}

                  <div className="cart-row">
                    <div className="row">
                      <div className="col-md-12 text-end">
                        <div className="totalPrice mb-2">
                          Subtotal <span>${order.total_amount}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
