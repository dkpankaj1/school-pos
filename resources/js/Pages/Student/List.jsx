import React from "react";
import { Head, Link } from "@inertiajs/react";
import AppLayout from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import AddIcon from "../../../assets/img/icons/plus.svg";
import DeleteBtn from "../Component/DeleteBtn";
import EditBtn from "../Component/EditBtn";
import StudentIcon from '../../../assets/img/icons/student.svg';

function List({ students }) {

    return (
        <AppLayout>
            <Head>
                <title>Student List - Dashboard</title>
            </Head>

            <PageHeader title="Student" subtitle="Manage Student">
                <div className="page-btn d-flex gap-1">
                    <Link href={route("student.create")} className="btn btn-added">
                        <img src={AddIcon} alt="Add Icon" className="me-1" />
                        Add Student
                    </Link>
                </div>
            </PageHeader>

            <div className="card">
                <div className="card-body">
                    <div className="table-responsive mb-3">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Enrolment</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Father</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {students.data.length === 0 ? (
                                    <tr>
                                        <td colSpan="8" className="text-center">
                                            No students found.
                                        </td>
                                    </tr>
                                ) : (
                                    students.data.map((item,index) => (
                                        <tr key={index}>
                                            <td><img src={StudentIcon} alt="student-icon" /></td>
                                            <td>{item.enrolment_no}</td>
                                            <td>{item.name}</td>
                                            <td>{item.classes.name}</td>
                                            <td>{item.father}</td>
                                            <td>
                                                <EditBtn url={route("student.edit", item.id)} />
                                                <DeleteBtn routeName="student.destroy" resource={item.id} />
                                            </td>
                                        </tr>
                                    ))
                                )}
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation">
                        <ul className="pagination">
                            {
                              students.links.map((item,index) => {
                                return <li key={index} className={`page-item ${item.active && "active"}`}><Link className="page-link" href={item.url}>{item.label.replace(/&laquo;/g, '«').replace(/&raquo;/g, '»')}</Link></li>
                              })  
                            }
                          
                        </ul>
                    </nav>
                </div>
            </div>
        </AppLayout>
    );
}



export default List;
