// src/pages/OrderDetail.jsx
import { useEffect, useState } from "react";
import { useParams, Link } from "react-router-dom";
import { useAuth } from "../utils/AuthContext";
import axiosInstance from "../axios";

export default function OrderDetail() {
  const { id } = useParams();
  const [order, setOrder] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const { user } = useAuth();
  useEffect(() => {
    const fetchOrder = async () => {
      try {
        const response = await axiosInstance.get(`/api/my-orders/${id}`);
        console.log(response)
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
                    <span className="ms-2">${order.amount}</span>
                  </div>
                  <div className="col-md-6 mb-2">
                    <strong>Status:</strong>
                    <span className="ms-2">{order.status = 0 ? (
															        <span>Pending</span>
															      ) : order.status = 1 ? (
															        <span>Success</span>
															      ): order.status = 2 ? (
															        <span>Fail</span>
															      ) : (
															        <span>Cancel</span>
															      )}</span>
                  </div>
                  <div className="col-md-6 mb-2">

                    <h2>Shipping Address</h2>
                      {order?.shipping ? (
                        <div className="address-block">
                          <p className="mb-1"><b>Name: </b>{order.shipping.first_name} {order.shipping.last_name}</p>
                          <p className="mb-1"><strong>Address: </strong>{order.shipping.address}</p>
                          <p className="mb-1"><strong>Apartment: </strong>{order.shipping.apartment}</p>
                          <p className="mb-1"><strong>City: </strong>{order.shipping.city}</p>
                          <p className="mb-1"><strong>State: </strong>{order.shipping.state_name.name}</p>
                          <p className="mb-1"><strong>Country: </strong>{order.shipping.country_name.country_name} </p>
                          <p className="mb-1"><strong>Pincode: </strong>{order.shipping.pincode}</p>
                        </div>
                      ) : (
                        <p>No Shipping address available</p>
                      )}
                  </div>
                  <div className="col-md-6 mb-2">
                    <h2>Billing Address</h2>
                      {order?.billing ? (
                        <div className="address-block">
                          <p className="mb-1"><b>Name: </b>{order.billing.first_name} {order.billing.last_name}</p>
                          <p className="mb-1"><strong>Address: </strong>{order.billing.address}</p>
                          <p className="mb-1"><strong>Apartment: </strong>{order.billing.apartment}</p>
                          <p className="mb-1"><strong>City: </strong>{order.billing.city}</p>
                          <p className="mb-1"><strong>State: </strong>{order.billing.state_name.name}</p>
                          <p className="mb-1"><strong>Country: </strong>{order.billing.country_name.country_name} </p>
                          <p className="mb-1"><strong>Pincode: </strong>{order.billing.pincode}</p>
                        </div>
                      ) : (
                        <p>No Billing address available</p>
                      )}
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
                                  item.product.image_url ||
                                  "/images//no-image.jpg"
                                }
                               
                                className="imgResponsive"
                              />
                            </div>
                            <Link
                              to={`/products/${item.product?.slug}`}
                              className="productName ms-2"
                            >
                              {item.product?.name}
                            </Link>
                          </div>
                        </div>
                        <div className="col-md-4 col-sm-4">
                          <div className="d-flex justify-content-between">
                            <div className="productQuantity">
                              {item.qty}
                            </div>
                            <div className="productPriceOuter d-flex">
                              <div className="productPrice">
                                ${parseFloat(item.price).toFixed(2)}
                              </div>
                            </div>
                            <div className="productPriceOuter d-flex">
                              <div className="productPrice">
                                ${parseFloat(item.price * item.qty).toFixed(2)}
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
                          Subtotal <span>${order.amount}</span>
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
