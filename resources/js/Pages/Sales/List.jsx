import React from "react";
import { Head, Link, usePage } from "@inertiajs/react";
import AppLayout from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import AddIcon from "../../../assets/img/icons/plus.svg";
import DeleteBtn from "../Component/DeleteBtn";
import EditBtn from "../Component/EditBtn";
import ShowBtn from "../Component/ShowBtn";
import Pagination from "../Component/Pagination";
import PaymentStatus from "../Component/PaymentStatus";
import OrderStatus from "../Component/OrderStatus";
import IconBtn from "../Component/IconBtn";
import BasicFilter from "../Component/BasicFilter";
import CreatePaymentIcon from "../../../assets/img/icons/plus-circle.svg";
import ShowPaymentIcon from "../../../assets/img/icons/dollar-square.svg";
import DownloadIcon from "../../../assets/img/icons/download.svg";

function List({ sales }) {
    const { setting } = usePage().props;

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
                    {/* filters ::begin */}
                    <BasicFilter routeName={"sales.index"} />
                    {/* filters :: end */}

                    <div className="table-responsive mb-3">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Reference No.</th>
                                    <th>Class</th>
                                    <th>Student</th>
                                    <th>Order Status</th>
                                    <th>
                                        Total Amount ({setting.currency_symbol})
                                    </th>
                                    <th>
                                        Paid Amount ({setting.currency_symbol})
                                    </th>
                                    <th>Due ({setting.currency_symbol})</th>
                                    <th>Payment Status</th>
                                    <th>Payment</th>
                                    <th>PDF</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {sales.data.length === 0 ? (
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
                                            <td>{sale.class}</td>
                                            <td>{sale.student}</td>
                                            <td>
                                                <OrderStatus
                                                    status={sale.order_status}
                                                />
                                            </td>
                                            <td>{sale.total_amount}</td>
                                            <td>{sale.paid_amount}</td>
                                            <td>
                                                {sale.total_amount -
                                                    sale.paid_amount}
                                            </td>
                                            <td>
                                                <PaymentStatus
                                                    status={sale.payment_status}
                                                />
                                            </td>
                                            <td>
                                                <IconBtn
                                                    icon={CreatePaymentIcon}
                                                    title={"Create Payment"}
                                                    url={route(
                                                        "sales.payment.create",
                                                        sale.id
                                                    )}
                                                />
                                                <IconBtn
                                                    icon={ShowPaymentIcon}
                                                    title={"Show All Payment"}
                                                    url={route(
                                                        "sales.payment.index",
                                                        sale.id
                                                    )}
                                                />
                                            </td>
                                            <td>
                                                <a
                                                    className="btn me-3 p-0"
                                                    href={route(
                                                        "print.sale",
                                                        sale.id
                                                    )}
                                                    title={"Download PDF"}
                                                    target={"_blank"}
                                                >
                                                    <img src={DownloadIcon} alt="img" />
                                                </a>
                                            </td>
                                            <td>
                                                {/* <ShowBtn
                                                    routeUrl={route(
                                                        "sales.index"
                                                    )}
                                                /> */}
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
                                )}
                            </tbody>
                        </table>
                    </div>
                    <Pagination links={sales.meta.links} />
                </div>
            </div>
        </AppLayout>
    );
}

export default List;
