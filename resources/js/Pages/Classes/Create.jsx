import React from "react";
import AppLayouts from "../Layouts/AppLayouts";
import { Head, useForm } from "@inertiajs/react";
import PageHeader from "../Component/PageHeader";

function Create() {
    const { data, setData, post, processing, errors } = useForm({
        name: "",
        description: "",
    });

    const handleSubmit = () => {
      post(route('student-class.store'))
    }

    return (
        <AppLayouts>
            <Head>
                <title>Class Create - Dashboard</title>
            </Head>

            <PageHeader
                title={"Add Class"}
                subtitle={"Create new Class"}
            />

            <div className="card">
                <div className="card-body">
                    <div className="row">
                        <div className="col-lg-6 col-sm-6 col-12">
                            <div className="form-group">
                                <label>Name</label>
                                <input type="text" placeholder="Enter Class Name" value={data.name} onChange={e => setData('name',e.target.value)} />
                                { errors.name && <div className="invalid-feedback d-block">{errors.name}</div>}
                            </div>
                            <div className="form-group">
                                <label>Description</label>
                                <textarea className="form-control" placeholder="Enter Description" value={data.description} onChange={e => setData('description',e.target.value)} ></textarea>
                                { errors.description && <div className="invalid-feedback d-block">{errors.description}</div>}
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
        </AppLayouts>
    );
}

export default Create;
