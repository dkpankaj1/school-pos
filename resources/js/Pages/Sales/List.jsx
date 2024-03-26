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

function List({ sales }) {
    console.log(sales)

    return (
        <AppLayout>
            <Head>
                <title>Sale List - Dashboard</title>
            </Head>

            <PageHeader title="Sale" subtitle="Manage Sale">
                <div className="page-btn d-flex gap-1">
                    <Link
                        href={route("sales.create")}
                        className="btn btn-added"
                    >
                        <img src={AddIcon} alt="Add Icon" className="me-1" />
                        Add sale
                    </Link>
                </div>
            </PageHeader>

            <div className="card">
                <div className="card-body">


                    <div className="table-responsive mb-3">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Reference No.</th>
                                    <th>Student</th>
                                    <th>Order Status</th>
                                    <th>Total Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {/* {sales.data.length === 0 ? (
                                    <tr>
                                        <td colSpan="8" className="text-center">
                                            No sale found.
                                        </td>
                                    </tr>
                                ) : (
                                    sales.data.map((sale, index) => (
                                        <tr key={index}>
                                            <td>{sale.date}</td>
                                            <td>{sale.reference_number}</td>
                                            <td>{sale.supplier}</td>
                                            <td>
                                                <OrderStatus
                                                    status={
                                                        sale.order_status
                                                    }
                                                />
                                            </td>
                                            <td>{sale.total_amount}</td>
                                            <td>{sale.paid_amount}</td>
                                            <td>
                                                <PaymentStatus
                                                    status={
                                                        sale.payment_status
                                                    }
                                                />
                                            </td>
                                            <td>
                                                <ShowBtn
                                                    routeUrl={route(
                                                        "sales.index"
                                                    )}
                                                />
                                                <EditBtn
                                                    url={route(
                                                        "sales.edit",
                                                        sale.id
                                                    )}
                                                />
                                                <DeleteBtn
                                                    routeName="sales.destroy"
                                                    resource={sale.id}
                                                />
                                            </td>
                                        </tr>
                                    ))
                                )} */}
                            </tbody>
                        </table>
                    </div>
                    <Pagination links={sales.links} />
                </div>
            </div>
        </AppLayout>
    );
}

export default List;
