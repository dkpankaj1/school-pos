import React from "react";
import { Head, Link } from "@inertiajs/react";
import AppLayout from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import AddIcon from "../../../assets/img/icons/plus.svg";
import DeleteBtn from "../Component/DeleteBtn";
import EditBtn from "../Component/EditBtn";
import BuildingIcon from '../../../assets/img/icons/building.svg';

function List({ classes }) {
    return (
        <AppLayout>
            <Head>
                <title>Class List - Dashboard</title>
            </Head>

            <PageHeader title="Class" subtitle="Manage Class">
                <div className="page-btn">
                    <Link href={route("student-class.create")} className="btn btn-added">
                        <img src={AddIcon} alt="Add Icon" className="me-1" />
                        Add Class
                    </Link>
                </div>
            </PageHeader>

            <div className="card">
                <div className="card-body">
                    <div className="table-responsive">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {classes.length === 0 ? (
                                    <tr>
                                        <td colSpan="4" className="text-center">
                                            No class found.
                                        </td>
                                    </tr>
                                ) : (
                                    classes.map((item) => (
                                        <tr key={item.id}>
                                            <td><img src={BuildingIcon} alt="class icon" /></td>
                                            <td>{item.name}</td>
                                            <td>
                                                <EditBtn url={route("student-class.edit", item.id)} />
                                                <DeleteBtn routeName="student-class.destroy" resource={item.id} />
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
