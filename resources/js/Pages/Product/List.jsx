import React from "react";
import { Head, Link } from "@inertiajs/react";
import AppLayout from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import AddIcon from "../../../assets/img/icons/plus.svg";
import DeleteBtn from "../Component/DeleteBtn";
import EditBtn from "../Component/EditBtn";
import BasicFilter from "../Component/BasicFilter";
import Pagination from "../Component/Pagination";
import AvailableStock from "../Component/AvailableStock";

function List({ products }) {
    return (
        <AppLayout>
            <Head>
                <title>ProductL List - Dashboard</title>
            </Head>

            <PageHeader title="Product" subtitle="Manage Product">
                <div className="page-btn d-flex gap-1">
                    <Link
                        href={route("products.create")}
                        className="btn btn-added"
                    >
                        <img src={AddIcon} alt="Add Icon" className="me-1" />
                        Add Product
                    </Link>
                </div>
            </PageHeader>

            <div className="card">
                <div className="card-body">
                    <BasicFilter routeName={"products.index"} />

                    <div className="table-responsive mb-3">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Available</th>
                                    <th>Categories</th>
                                    <th>Unit</th>
                                    <th>Purchase Price</th>
                                    <th>Sale Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {products.data.length === 0 ? (
                                    <tr>
                                        <td colSpan="8" className="text-center">
                                            No product found.
                                        </td>
                                    </tr>
                                ) : (
                                    products.data.map((product, index) => (
                                        <tr key={index}>
                                            <td>
                                                <div className="avatar avatar-lg">
                                                    <img
                                                        className="avatar-img rounded-circle"
                                                        alt={product.name}
                                                        src={product.images}
                                                    />
                                                </div>
                                            </td>
                                            <td>{product.code}</td>
                                            <td>{product.name}</td>
                                            <td>
                                                <AvailableStock
                                                    stock={
                                                        product.stock_sum_quantity ||
                                                        0
                                                    }
                                                />
                                            </td>
                                            <td>{product.category.name}</td>
                                            <td>{product.unit.short_name}</td>
                                            <td>{product.cost}</td>
                                            <td>{product.mrp}</td>
                                            <td>
                                                <EditBtn
                                                    url={route(
                                                        "products.edit",
                                                        product.id
                                                    )}
                                                />
                                                <DeleteBtn
                                                    routeName="products.destroy"
                                                    resource={product.id}
                                                />
                                            </td>
                                        </tr>
                                    ))
                                )}
                            </tbody>
                        </table>
                    </div>
                    <Pagination links={products.links} />
                </div>
            </div>
        </AppLayout>
    );
}

export default List;
