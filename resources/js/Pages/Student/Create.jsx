import React from "react";
import AppLayouts from "../Layouts/AppLayouts";
import { Head, useForm } from "@inertiajs/react";
import PageHeader from "../Component/PageHeader";

function Create({classes}) {
    const { data, setData, post, processing, errors } = useForm({
        enrolment : "",
        name: "",
        class: "",
        father: "",
        remark: "",
    });

    const handleSubmit = () => {
      post(route('student.store'))
    }

    return (
        <AppLayouts>
            <Head>
                <title>Student Create - Dashboard</title>
            </Head>

            <PageHeader
                title={"Add Student"}
                subtitle={"Create new Student"}
            />

            <div className="card">
                <div className="card-body">
                    <div className="col-md-8 col-12">
                        <div className="row">

                            <div className="col-lg-6 col-sm-6 col-12">
                                <div className="form-group">
                                    <label>Enrolment</label>
                                    <input type="text" placeholder="Enter Enrolment Number" value={data.enrolment} onChange={e => setData('enrolment',e.target.value)} />
                                    { errors.enrolment && <div className="invalid-feedback d-block">{errors.enrolment}</div>}
                                </div>            
                            </div>

                            <div className="col-lg-6 col-sm-6 col-12">
                                <div className="form-group">
                                    <label>Name</label>
                                    <input type="text" placeholder="Enter Name" value={data.name} onChange={e => setData('name',e.target.value)} />
                                    { errors.name && <div className="invalid-feedback d-block">{errors.name}</div>}
                                </div>            
                            </div>

                            <div className="col-lg-6 col-sm-6 col-12">
                                <div className="form-group">
                                    <label>Class</label>
                                    <select className="form-control" onChange={e => setData('class',e.target.value)}>
                                        <option value=""> -- select --</option>
                                        {classes.map((item,index) => {
                                            return <option key={index} value={item.id}>{item.name}</option>
                                        })}
                                    </select>
                                    { errors.class && <div className="invalid-feedback d-block">{errors.class}</div>}
                                </div>            
                            </div>

                            <div className="col-lg-6 col-sm-6 col-12">
                                <div className="form-group">
                                    <label>Father</label>
                                    <input type="text" placeholder="Enter Father name" value={data.father} onChange={e => setData('father',e.target.value)} />
                                    { errors.father && <div className="invalid-feedback d-block">{errors.father}</div>}
                                </div>            
                            </div>

                            <div className="col-lg-12 col-sm-12 col-12">
                                <div className="form-group">
                                    <label>Remark</label>
                                    <textarea placeholder="Enter address" value={data.remark} onChange={e => setData('remark',e.target.value)} ></textarea>
                                    { errors.remark && <div className="invalid-feedback d-block">{errors.remark}</div>}
                                </div>            
                            </div>

                            <div className="col-lg-12">
                                <button
                                    disabled={processing}
                                    className="btn btn-submit me-2"
                                    onClick={handleSubmit}
                                >
                                    {processing ? "Loading.." : "Submit"}
                                </button>
                                <button
                                    disabled={processing}
                                    type="reset"
                                    className="btn btn-cancel"
                                >
                                    Reset
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </AppLayouts>
    );
}

export default Create;
