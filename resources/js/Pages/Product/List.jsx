import React from "react";
import { Head, Link } from "@inertiajs/react";
import AppLayout from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import AddIcon from "../../../assets/img/icons/plus.svg";
import DeleteBtn from "../Component/DeleteBtn";
import EditBtn from "../Component/EditBtn";

function List({ products }) {
    return (
        <AppLayout>
            <Head>
                <title>ProductL List - Dashboard</title>
            </Head>

            <PageHeader title="Product" subtitle="Manage Product">
                <div className="page-btn d-flex gap-1">
                    <Link href={route("products.create")} className="btn btn-added">
                        <img src={AddIcon} alt="Add Icon" className="me-1" />
                        Add Product
                    </Link>
                </div>
            </PageHeader>

            <div className="card">
                <div className="card-body">
                    <div className="table-responsive">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Code</th>
                                    <th>Name</th>
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
                                        <td colSpan="4" className="text-center">
                                            No categories found.
                                        </td>
                                    </tr>
                                ) : (
                                    products.data.map((product,index) => (
                                        <tr key={index}>
                                            <td>
                                                <div class="avatar avatar-lg">
                                                    <img class="avatar-img rounded-circle" alt={product.name} src={product.images}/>
                                                </div>
                                            </td>
                                            <td>{product.code}</td>
                                            <td>{product.name}</td>
                                            <td>{product.category.name}</td>
                                            <td>{product.unit.short_name}</td>
                                            <td>{product.cost}</td>
                                            <td>{product.mrp}</td>
                                            <td>
                                                <EditBtn url={route("products.edit", product.id)} />
                                                <DeleteBtn routeName="products.destroy" resource={product.id} />
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
