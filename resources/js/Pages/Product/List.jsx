import React from "react";
import { Head, Link, useForm, usePage } from "@inertiajs/react";
import AppLayout from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import AddIcon from "../../../assets/img/icons/plus.svg";
import DeleteBtn from "../Component/DeleteBtn";
import EditBtn from "../Component/EditBtn";

function List({ products }) {

    const { request } = usePage().props;
    const { data, setData, get, processing } = useForm({
        search: request.query?.search || "",
    });

    const handleSearch = () => {
        get(route("products.index", data));
    };

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
                    <div className="row">
                        <div className="col-12 col-lg-4 col-md-4 ms-auto">
                            <div className="form-group d-flex gap-3">
                                <input
                                    type="text"
                                    placeholder="Search..."
                                    value={data.search}
                                    onChange={(e) =>
                                        setData("search", e.target.value)
                                    }
                                />

                                <button
                                    type="button"
                                    onClick={handleSearch}
                                    className={`btn btn-primary ${
                                        !processing && "px-4"
                                    }`}
                                    disabled={processing}
                                >
                                    {processing ? "Loading." : "Filter"}
                                </button>
                            </div>
                        </div>
                    </div>

                    <div className="table-responsive mb-3">
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
                    <nav aria-label="Page navigation">
                        <ul className="pagination">
                            {products.links.map((item, index) => {
                                return (
                                    <li
                                        key={index}
                                        className={`page-item ${
                                            item.active && "active"
                                        }`}
                                    >
                                        <Link
                                            className="page-link"
                                            href={item.url}
                                        >
                                            {item.label
                                                .replace(/&laquo;/g, "«")
                                                .replace(/&raquo;/g, "»")}
                                        </Link>
                                    </li>
                                );
                            })}
                        </ul>
                    </nav>
                </div>
            </div>
        </AppLayout>
    );
}

export default List;
