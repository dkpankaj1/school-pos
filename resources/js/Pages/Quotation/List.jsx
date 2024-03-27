import React from "react";
import { Head, Link } from "@inertiajs/react";
import AppLayout from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import AddIcon from "../../../assets/img/icons/plus.svg";
import DeleteBtn from "../Component/DeleteBtn";
import EditBtn from "../Component/EditBtn";
import ConvertSaleBtn from "../Component/ConvertSaleBtn";
import BasicFilter from "../Component/BasicFilter";
import Pagination from "../Component/Pagination";

function List({ quotations }) {
    return (
        <AppLayout>
            <Head>
                <title>Quotation List - Dashboard</title>
            </Head>

            <PageHeader title="Quotation" subtitle="Manage Quotation">
                <div className="page-btn d-flex gap-1">
                    <Link
                        href={route("quotations.create")}
                        className="btn btn-added"
                    >
                        <img src={AddIcon} alt="Add Icon" className="me-1" />
                        Add Quotation
                    </Link>
                </div>
            </PageHeader>

            <div className="card">
                <div className="card-body">
                    {/* <BasicFilter routeName={"quotations.index"} /> */}

                    <div className="table-responsive mb-3">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Code</th>
                                    <th>Other Charges</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {quotations.data.length === 0 ? (
                                    <tr>
                                        <td colSpan="8" className="text-center">
                                            No product found.
                                        </td>
                                    </tr>
                                ) : (
                                    quotations.data.map((quotation, index) => (
                                        <tr key={index}>
                                            <td>{index + 1}</td>
                                            <td>{quotation.date}</td>
                                            <td>{quotation.code}</td>
                                            <td>{quotation.other_charges}</td>
                                            <td>{quotation.discount}</td>
                                            <td>{quotation.total_amt}</td>
                                            <td>
                                                {/* <ConvertSaleBtn
                                                    url={route(
                                                        "quotations.edit",
                                                        quotation.id
                                                    )}
                                                /> */}
                                                <EditBtn
                                                    url={route(
                                                        "quotations.edit",
                                                        quotation.id
                                                    )}
                                                />
                                                <DeleteBtn
                                                    routeName="quotations.destroy"
                                                    resource={quotation.id}
                                                />
                                            </td>
                                        </tr>
                                    ))
                                )}
                            </tbody>
                        </table>
                    </div>
                    <Pagination links={quotations.meta.links} />
                </div>
            </div>
        </AppLayout>
    );
}

export default List;
