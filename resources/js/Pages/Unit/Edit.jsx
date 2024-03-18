import React from "react";
import AppLayouts from "../Layouts/AppLayouts";
import { Head, useForm } from "@inertiajs/react";
import PageHeader from "../Component/PageHeader";

function Edit({unit}) {
    const { data, setData, put, processing, errors } = useForm({
        _method : "PUT",
        name: unit.name,
        short_name: unit.short_name,
        description: unit.description,
    });

    const handleSubmit = () => {
      put(route('units.update',unit.id))
    }

    return (
        <AppLayouts>
            <Head>
                <title>Unit Edit - Dashboard</title>
            </Head>

            <PageHeader
                title={"Edit Unit"}
                subtitle={"Edit product Unit"}
            />

            <div className="card">
                <div className="card-body">
                    <div className="row">
                        <div className="col-lg-6 col-sm-6 col-12">
                            <div className="form-group">
                                <label>Name</label>
                                <input type="text" placeholder="Enter Unit Name" value={data.name} onChange={e => setData('name',e.target.value)} />
                                { errors.name && <div className="invalid-feedback d-block">{errors.name}</div>}
                            </div>
                            <div className="form-group">
                                <label>Short Name</label>
                                <input type="text" placeholder="Enter  Short Name" value={data.short_name} onChange={e => setData('short_name',e.target.value)} />
                                { errors.short_name && <div className="invalid-feedback d-block">{errors.short_name}</div>}
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
                                {processing ? "Loading.." : "Update"}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayouts>
    );
}

export default Edit;
