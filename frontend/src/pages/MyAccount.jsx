// src/pages/Home.jsx
import React, { useEffect ,useState } from 'react';

import {useNavigate, Link } from 'react-router-dom';
import { Tabs, Tab, Accordion, useAccordionButton } from "react-bootstrap";
import { useAuth } from "../utils/AuthContext";
import axiosInstance from "../axios";

const MyAccount = () => {

const [key, setKey] = useState("tab1");
const navigate = useNavigate(); 
  const { user, loading } = useAuth();
const [orders, setOrders] = useState([]);
useEffect(() => {
    if (!loading && !user) {
      navigate("/login", { state: { from: "/checkout" } });
    }



     const fetchOrders = async () => {
      try {
        const response = await axiosInstance.get("/api/my-orders");
        setOrders(response.data);
      } catch (error) {
        console.error("Error fetching orders:", error);
      } finally {
        setLoading(false);
      }
    };

	fetchOrders();

  }, [user, loading, navigate]);



const [form, setForm] = useState({
    current_password: "",
    new_password: "",
    new_password_confirmation: "",
  });
  const [message, setMessage] = useState("");
  const [error, setError] = useState("");

  const handleChange = (e) =>
    setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setMessage("");
    setError("");

    try {
      const res = await axiosInstance.post("/api/change-password", form);
      setMessage(res.data.message);
      setForm({
        current_password: "",
        new_password: "",
        new_password_confirmation: "",
      });
    } catch (err) {
      setError(
        err.response?.data?.message ||
          "Failed to change password. Please try again."
      );
    }
  };


  if (loading) return <p>Loading user...</p>;

  if (!user) return null;

return (
   <section className="contentContainer myAccount">
		<div className="container">
			<div className="row">
				<div className="col-md-12">
					<div className="d-flex align-items-center justify-content-between">
						<h1 className="text-uppercase">My Account</h1>
						{/*<a href="#" className="editButton">Edit</a>*/}
					</div>
				</div>
			</div>
			<div className="myProfile mt-4">
				<div className="row">
					<div className="col-lg-3 col-md-4 text-center">
						{/*<div className="userImage text-center m-auto position-relative">
							<img src="/images/user-image-02.jpg" alt="User" className="rounded-circle img-fluid shadow" />
							<a href="#" className="d-none">Edit</a>
						</div>*/}
					</div>
					<div className="col-lg-9 col-md-8">
						<div className="userInformation pt-2">
							<div className="row">
								<div className="col-md-6">
									<div className="mb-2">
									   <strong>Name:</strong><span className="ms-2">{user.name}</span>
									   <input type="text" className="min-width-auto w-100 mb-0" placeholder="" aria-describedby="" />
									</div>
								</div>
								<hr/>
								{/*<div className="col-md-6">
									<div className="mb-2">
									   <strong>Phone:</strong><span className="ms-2">{user.phone}</span>
									   <input type="text" className="min-width-auto w-100 mb-0" placeholder="" aria-describedby="" />
									</div>
								</div>*/}
								<div className="col-md-6">
									<div className="mb-2">
									   <strong>Email:</strong><span className="ms-2">{user.email}</span>
									   <input type="text" className="min-width-auto w-100 mb-0" placeholder="" aria-describedby="" />
									</div>
								</div>
								<hr/>
								{/*<div className="col-md-12">
									<div className="mb-2">
									   <strong>Address:</strong><span className="ms-2">123 Main Street, New Delhi, India</span>
									   <input type="text" className="min-width-auto w-100 mb-0" placeholder="" aria-describedby="" />
									</div>
								</div>*/}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div className="myAccountInformation mt-5">
				<div className="row">
					<div className="col-lg-12">
						<Tabs
			          id="controlled-tabs"
			          activeKey={key}
			          onSelect={(k) => setKey(k)}
			          className="mb-3"
			         >
				         <Tab eventKey="tab1" title="Order History">
				            <div className="row">
									<div className="col-md-12">
										<h2>Order History</h2>
										<div className="table-responsive">
								         <table className="table table-bordered table-hover text-center align-middle">
								            <thead className="table-dark">
									            <tr>
									              <th>Order ID</th>
									              <th>Items</th>
									              <th>Date</th>
									              <th>Status</th>
									              <th>Amount</th>
									            </tr>
								          	</thead>
								            <tbody>
								             {orders.map((order) => (
								            	<tr key={order.id} >
									              <td><Link to ={`/my-orders/${order.id}`}>{order.id}</Link></td>
									              <td> <ul >
											            {order.items.map((item) => (
											              <li key={item.id} className="py-2 flex justify-between">
											                <span>{item.product?.name || "Product removed"}</span><br/>
											                <span>
											                 [ ${item.price} * {item.qty} = {item.price * item.qty}]
											                </span>
											              </li>
											            ))}
											          </ul></td>
									              <td> {new Date(order.created_at).toLocaleString()}</td>
									              <td>{order.status = 0 ? (
															        <span>Pending</span>
															      ) : order.status = 1 ? (
															        <span>Success</span>
															      ): order.status = 2 ? (
															        <span>Fail</span>
															      ) : (
															        <span>Cancel</span>
															      )}

									              </td>
									              <td>${order.amount}</td>
									              </tr>
									            ))}
									            
								            </tbody>
								         </table>
								      </div>
									</div>
								</div>
				         </Tab>
				         <Tab eventKey="tab2" title="Change Password">
				            <div className="row">
									<div className="col-md-12">
										<h2>Change Password</h2>
										<form onSubmit={handleSubmit} className="mt-3">
										<div className="form-group mb-0">
											<label>Old Password</label>
											<input type="Password" className="w-50" name="current_password"
						            value={form.current_password}
						            onChange={handleChange}
						            required />
										</div>
										<div className="form-group mb-0">
											<label>New Password</label>
											<input type="Password" className="w-50"  name="new_password"
						            value={form.new_password}
						            onChange={handleChange}
						            required
						            minLength="8" />
										</div>
										<div className="form-group mb-0">
											<label>Confirm New Password</label>
											 <input
							            type="password"
							            name="new_password_confirmation"
							            value={form.new_password_confirmation}
							            onChange={handleChange}
							            className="w-50"
							            required
							            minLength="8"
							          />
										</div>
										{error && <div className="alert alert-danger">{error}</div>}
        						{message && <div className="alert alert-success">{message}</div>}
										<div className="form-group mb-0">
											<button className="btn btn-primary mt-2 customBtn01 customBtn01Fill" id="">Submit</button>
										</div>
										</form>
									</div>
								</div>
				         </Tab>
			         </Tabs>
					</div>
				</div>
			</div>
		</div>
   </section>
);
}
export default MyAccount;