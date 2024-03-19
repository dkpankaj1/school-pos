import React from "react";
import { Head, Link } from "@inertiajs/react";
import AppLayout from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import AddIcon from "../../../assets/img/icons/plus.svg";
import DeleteBtn from "../Component/DeleteBtn";
import EditBtn from "../Component/EditBtn";

function List({ supplier }) {
    return (
        <AppLayout>
            <Head>
                <title>Supplier List - Dashboard</title>
            </Head>

            <PageHeader title="Supplier" subtitle="Manage Supplier">
                <div className="page-btn d-flex gap-1">
                    <Link href={route("suppliers.create")} className="btn btn-added">
                        <img src={AddIcon} alt="Add Icon" className="me-1" />
                        Add Supplier
                    </Link>
                </div>
            </PageHeader>

            <div className="card">
                <div className="card-body">
                    <div className="table-responsive">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {supplier.length === 0 ? (
                                    <tr>
                                        <td colSpan="8" className="text-center">
                                            No supplier found.
                                        </td>
                                    </tr>
                                ) : (
                                    supplier.map((item,index) => (
                                        <tr key={index}>
                                            <td>{item.name}</td>
                                            <td>{item.email}</td>
                                            <td>{item.phone}</td>
                                            <td>{item.address}</td>
                                            <td>{item.city}</td>
                                            <td>{item.state}</td>
                                            <td>{item.country}</td>
                                            <td>
                                                <EditBtn url={route("suppliers.edit", item.id)} />
                                                <DeleteBtn routeName="suppliers.destroy" resource={item.id} />
                                            </td>
                                        </tr>
                                    ))
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}



export default List;
