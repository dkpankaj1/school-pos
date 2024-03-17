import React from "react";
import { Head, Link } from "@inertiajs/react";
import AppLayout from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import AddIcon from "../../../assets/img/icons/plus.svg";
import DeleteBtn from "../Component/DeleteBtn";
import EditBtn from "../Component/EditBtn";

function List({ categories }) {
    return (
        <AppLayout>
            <Head>
                <title>Categories List - Dashboard</title>
            </Head>

            <PageHeader title="Categories" subtitle="Manage Categories">
                <div className="page-btn">
                    <Link href={route("categories.create")} className="btn btn-added">
                        <img src={AddIcon} alt="Add Icon" className="me-1" />
                        Add Categories
                    </Link>
                </div>
            </PageHeader>

            <div className="card">
                <div className="card-body">
                    <div className="table-responsive">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>Categories Name</th>
                                    <th>Description</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {categories.data.length === 0 ? (
                                    <tr>
                                        <td colSpan="4" className="text-center">
                                            No categories found.
                                        </td>
                                    </tr>
                                ) : (
                                    categories.data.map((category) => (
                                        <CategoryRow key={category.id} category={category} />
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

function CategoryRow({ category }) {
    return (
        <tr>
            <td className="text-bolds">{category.name}</td>
            <td>{category.description}</td>
            <td>{category.created}</td>
            <td>
                <EditBtn url={route("categories.edit", category.id)} />
                <DeleteBtn routeName="categories.destroy" resource={category.id} />
            </td>
        </tr>
    );
}

export default List;
