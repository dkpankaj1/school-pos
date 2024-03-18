import React from "react";
import { Head, Link } from "@inertiajs/react";
import AppLayout from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import AddIcon from "../../../assets/img/icons/plus.svg";
import DeleteBtn from "../Component/DeleteBtn";
import EditBtn from "../Component/EditBtn";

function List({ units }) {
    return (
        <AppLayout>
            <Head>
                <title>Unit List - Dashboard</title>
            </Head>

            <PageHeader title="Unit" subtitle="Manage Units">
                <div className="page-btn">
                    <Link href={route("units.create")} className="btn btn-added">
                        <img src={AddIcon} alt="Add Icon" className="me-1" />
                        Add Unit
                    </Link>
                </div>
            </PageHeader>

            <div className="card">
                <div className="card-body">
                    <div className="table-responsive">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>Unit Name</th>
                                    <th>Short Name</th>
                                    <th>Description</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {units.data.length === 0 ? (
                                    <tr>
                                        <td colSpan="4" className="text-center">
                                            No unit found.
                                        </td>
                                    </tr>
                                ) : (
                                    units.data.map((unit) => (
                                        <UnitRow key={unit.id} unit={unit} />
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

function UnitRow({ unit }) {
    return (
        <tr>
            <td className="text-bolds">{unit.name}</td>
            <td className="text-bolds">{unit.shortName}</td>
            <td>{unit.description}</td>
            <td>{unit.created}</td>
            <td>
                <EditBtn url={route("units.edit", unit.id)} />
                <DeleteBtn routeName="units.destroy" resource={unit.id} />
            </td>
        </tr>
    );
}

export default List;
