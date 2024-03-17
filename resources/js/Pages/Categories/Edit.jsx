import React,{useState} from "react";
import AppLayouts from "../Layouts/AppLayouts";
import { Head, useForm } from "@inertiajs/react";
import PageHeader from "../Component/PageHeader";

function Edit({ category }) {
    const { data, setData, put, processing, errors } = useForm({
        _method: "PUT",
        name: category.name,
        description: category.description,
    });

    const handleSubmit = () => {
        put(route("categories.update", category.id));
    };

    return (
        <AppLayouts>
            <Head>
                <title>Categories Edit - Dashboard</title>
            </Head>

            <PageHeader
                title={"Edit Category"}
                subtitle={"Edit product Category"}
            />

            <div className="card">
                <div className="card-body">
                    <div className="row">
                        <div className="col-lg-6 col-sm-6 col-12">
                            <div className="form-group">
                                <label>Category Name</label>
                                <input
                                    type="text"
                                    placeholder="Enter Product Categories Name"
                                    value={data.name}
                                    onChange={(e) =>
                                        setData("name", e.target.value)
                                    }
                                />
                                {errors.name && (
                                    <div class="invalid-feedback d-block">
                                        {errors.name}
                                    </div>
                                )}
                            </div>
                            <div className="form-group">
                                <label>Description</label>
                                <textarea
                                    className="form-control"
                                    placeholder="Enter Description"
                                    value={data.description}
                                    onChange={(e) =>
                                        setData("description", e.target.value)
                                    }
                                ></textarea>
                                {errors.description && (
                                    <div class="invalid-feedback d-block">
                                        {errors.description}
                                    </div>
                                )}
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
