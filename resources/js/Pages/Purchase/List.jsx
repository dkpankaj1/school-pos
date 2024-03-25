import React from "react";
import { Head, Link, useForm, usePage } from "@inertiajs/react";
import AppLayout from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import AddIcon from "../../../assets/img/icons/plus.svg";
import DeleteBtn from "../Component/DeleteBtn";
import EditBtn from "../Component/EditBtn";
import ShowBtn from "../Component/ShowBtn";
import Pagination from "../Component/Pagination";
import PaymentStatus from "../Component/PaymentStatus";
import OrderStatus from "../Component/OrderStatus";

function List({ purchases, suppliers }) {
    const { request } = usePage().props;

    const { data, setData, get, processing } = useForm({
        purchase_date: request.query?.purchase_date || "",
        reference: request.query?.reference || "",
        order_status: request.query?.order_status || "",
        payment_status: request.query?.payment_status || "",
        supplier: request.query?.supplier || "",
    });

    const filter = () => {
        get(route("purchases.index"), data);
    };

    return (
        <AppLayout>
            <Head>
                <title>Purchase List - Dashboard</title>
            </Head>

            <PageHeader title="Purchase" subtitle="Manage Purchase">
                <div className="page-btn d-flex gap-1">
                    <Link
                        href={route("purchases.create")}
                        className="btn btn-added"
                    >
                        <img src={AddIcon} alt="Add Icon" className="me-1" />
                        Add purchase
                    </Link>
                </div>
            </PageHeader>

            <div className="card">
                <div className="card-body">
                    <div className="row">
                        <div className="col-lg col-sm-6 col-12">
                            <div className="form-group">
                                <input
                                    type="date"
                                    className="form-control"
                                    style={{
                                        fontSize: "14px",
                                        padding: ".5rem",
                                        color: "#adb5bd",
                                    }}
                                    placeholder="Choose Date"
                                    value={data.purchase_date}
                                    onChange={(e) =>
                                        setData("purchase_date", e.target.value)
                                    }
                                />
                            </div>
                        </div>
                        <div className="col-lg col-sm-6 col-12">
                            <div className="form-group">
                                <input
                                    type="text"
                                    className="form-control"
                                    style={{
                                        fontSize: "14px",
                                        padding: ".5rem",
                                        color: "#adb5bd",
                                    }}
                                    placeholder="Enter Reference"
                                    value={data.reference}
                                    onChange={(e) =>
                                        setData("reference", e.target.value)
                                    }
                                />
                            </div>
                        </div>
                        <div className="col-lg col-sm-6 col-12">
                            <div className="form-group">
                                <select
                                    className="form-control"
                                    style={{
                                        fontSize: "14px",
                                        padding: ".5rem",
                                        color: "#adb5bd",
                                    }}
                                    defaultValue={data.supplier}
                                    onChange={(e) =>
                                        setData("supplier", e.target.value)
                                    }
                                >
                                    <option value="">Choose Supplier</option>
                                    {suppliers.map((supplier, index) => {
                                        return (
                                            <option
                                                key={index}
                                                value={supplier.id}
                                            >
                                                {supplier.name}
                                            </option>
                                        );
                                    })}
                                </select>
                            </div>
                        </div>
                        <div className="col-lg col-sm-6 col-12">
                            <div className="form-group">
                                <select
                                    className="form-control"
                                    style={{
                                        fontSize: "14px",
                                        padding: ".5rem",
                                        color: "#adb5bd",
                                    }}
                                    defaultValue={data.payment_status}
                                    onChange={(e) =>
                                        setData(
                                            "payment_status",
                                            e.target.value
                                        )
                                    }
                                >
                                    <option value="">Choose Payment</option>
                                    <option value="pending">Pending</option>
                                    <option value="partial">Partial</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                        </div>
                        <div className="col-lg col-sm-6 col-12">
                            <div className="form-group">
                                <select
                                    className="form-control"
                                    style={{
                                        fontSize: "14px",
                                        padding: ".5rem",
                                        color: "#adb5bd",
                                    }}
                                    defaultValue={data.order_status}
                                    onChange={(e) =>
                                        setData("order_status", e.target.value)
                                    }
                                >
                                    <option value="">Choose Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="order">Order</option>
                                    <option value="received">Received</option>
                                </select>
                            </div>
                        </div>
                        <div className="col-lg-1 col-sm-6 col-12">
                            <div className="form-group">
                                <button
                                    type="button"
                                    className="btn btn-primary"
                                    disabled={processing}
                                    style={{ width: "7rem" }}
                                    onClick={filter}
                                >
                                    {processing && (
                                        <span
                                            className="spinner-border spinner-border-sm me-2"
                                            role="status"
                                        ></span>
                                    )}
                                    Filter
                                </button>
                            </div>
                        </div>
                    </div>

                    <div className="table-responsive mb-3">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Reference No.</th>
                                    <th>Supplier</th>
                                    <th>Order Status</th>
                                    <th>Total Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {purchases.data.length === 0 ? (
                                    <tr>
                                        <td colSpan="8" className="text-center">
                                            No purchase found.
                                        </td>
                                    </tr>
                                ) : (
                                    purchases.data.map((purchase, index) => (
                                        <tr key={index}>
                                            <td>{purchase.date}</td>
                                            <td>{purchase.reference_number}</td>
                                            <td>{purchase.supplier}</td>
                                            <td>
                                                <OrderStatus
                                                    status={
                                                        purchase.order_status
                                                    }
                                                />
                                            </td>
                                            <td>{purchase.total_amount}</td>
                                            <td>{purchase.paid_amount}</td>
                                            <td>
                                                <PaymentStatus
                                                    status={
                                                        purchase.payment_status
                                                    }
                                                />
                                            </td>
                                            <td>
                                                {/* <ShowBtn
                                                    routeUrl={route(
                                                        "purchases.index"
                                                    )}
                                                /> */}
                                                <EditBtn
                                                    url={route(
                                                        "purchases.edit",
                                                        purchase.id
                                                    )}
                                                />
                                                <DeleteBtn
                                                    routeName="purchases.destroy"
                                                    resource={purchase.id}
                                                />
                                            </td>
                                        </tr>
                                    ))
                                )}
                            </tbody>
                        </table>
                    </div>
                    <Pagination links={purchases.meta.links} />
                </div>
            </div>
        </AppLayout>
    );
}

export default List;
