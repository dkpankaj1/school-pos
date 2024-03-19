import React,{useState} from "react";
import AppLayouts from "../Layouts/AppLayouts";
import { Head, useForm } from "@inertiajs/react";
import PageHeader from "../Component/PageHeader";

function Create({ units, categories }) {

    const [imagePreview, setImagePreview] = useState("https://placehold.co/200x200")

    const { data, setData, post, processing, progress,errors } = useForm({
        code: "",
        name: "",
        description: "",
        mrp: "",
        cost: "",
        image: undefined,
        category: "",
        unit: "",
    });


    const handleSubmit = () => {
        post(route("products.store"));
    };

    const handleImageInput = (e) => {
        setData('image', e.target.files[0])
        const reader = new FileReader();
        reader.onloadend = () => {
            setImagePreview(reader.result);
        };
        reader.readAsDataURL(e.target.files[0]);
    }

    return (
        <AppLayouts>
            <Head>
                <title>Product Create - Dashboard</title>
            </Head>

            <PageHeader title={"Add Product"} subtitle={"Create new product"} />

            <div className="card">
                <div className="card-body">
                    <div className="row">
                        <div className="col-lg-6 col-12">
                            <div className="row">
                                <div className="col-lg-6 col-sm-6 col-12">
                                    <div className="form-group">
                                        <label>Category Code</label>
                                        <div className="input-group">
                                            <span className="input-group-text">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    className="bi bi-upc-scan"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z" />
                                                </svg>
                                            </span>
                                            <input
                                                type="text"
                                                className="form-control"
                                                placeholder="Product code"
                                                value={data.code}
                                                onChange={(e) =>
                                                    setData(
                                                        "code",
                                                        e.target.value
                                                    )
                                                }
                                            />
                                        </div>
                                        {errors.code && (
                                            <div className="invalid-feedback d-block">
                                                {errors.code}
                                            </div>
                                        )}
                                    </div>
                                </div>

                                <div className="col-lg-6 col-sm-6 col-12">
                                    <div className="form-group">
                                        <label>Product Name</label>
                                        <input
                                            type="text"
                                            placeholder="Enter Product Name"
                                            value={data.name}
                                            onChange={(e) =>
                                                setData("name", e.target.value)
                                            }
                                        />
                                        {errors.name && (
                                            <div className="invalid-feedback d-block">
                                                {errors.name}
                                            </div>
                                        )}
                                    </div>
                                </div>

                                <div className="col-lg-6 col-sm-6 col-12">
                                    <div className="form-group">
                                        <label>Category</label>
                                        <select
                                            className="form-control form-select"
                                            onChange={(e) =>
                                                
                                                setData(
                                                    "category",
                                                    e.target.value
                                                )
                                            }
                                        >
                                            <option value="">
                                                -- select --
                                            </option>
                                            {categories.map((item) => {
                                                return (
                                                    <option key={item.id} value={item.id}>
                                                        {item.name}
                                                    </option>
                                                );
                                            })}
                                        </select>
                                        {errors.category && (
                                            <div className="invalid-feedback d-block">
                                                {errors.category}
                                            </div>
                                        )}
                                    </div>
                                </div>

                                <div className="col-lg-6 col-sm-6 col-12">
                                    <div className="form-group">
                                        <label>Unit</label>
                                        <select
                                            className="form-control form-select"
                                            onChange={(e) =>
                                                setData("unit", e.target.value)
                                            }
                                        >
                                            <option value="">
                                                -- select --
                                            </option>
                                            {units.map((item) => {
                                                return (
                                                    <option key={item.id} value={item.id}>
                                                        {item.short_name}
                                                    </option>
                                                );
                                            })}
                                        </select>
                                        {errors.unit && (
                                            <div className="invalid-feedback d-block">
                                                {errors.unit}
                                            </div>
                                        )}
                                    </div>
                                </div>

                                <div className="col-lg-6 col-sm-6 col-12">
                                    <div className="form-group">
                                        <label>Purchase Price</label>
                                        <input
                                            type="text"
                                            placeholder="Enter Product Name"
                                            value={data.cost}
                                            onChange={(e) =>
                                                setData("cost", e.target.value)
                                            }
                                        />
                                        {errors.cost && (
                                            <div className="invalid-feedback d-block">
                                                {errors.cost}
                                            </div>
                                        )}
                                    </div>
                                </div>

                                <div className="col-lg-6 col-sm-6 col-12">
                                    <div className="form-group">
                                        <label>Sale Price</label>
                                        <input
                                            type="text"
                                            placeholder="Enter Product Name"
                                            value={data.mrp}
                                            onChange={(e) =>
                                                setData("mrp", e.target.value)
                                            }
                                        />
                                        {errors.mrp && (
                                            <div className="invalid-feedback d-block">
                                                {errors.mrp}
                                            </div>
                                        )}
                                    </div>
                                </div>

                                <div className="w-100"></div>

                                <div className="col-12">
                                    <div className="form-group">
                                        <label>Description</label>
                                        <textarea
                                            className="form-control"
                                            placeholder="Enter Description"
                                            value={data.description}
                                            onChange={(e) =>
                                                setData(
                                                    "description",
                                                    e.target.value
                                                )
                                            }
                                        ></textarea>
                                        {errors.description && (
                                            <div className="invalid-feedback d-block">
                                                {errors.description}
                                            </div>
                                        )}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="col-lg-6 col-12">
                            <div className="col-lg-6 col-12">
                                <div className="form-group">
                                    <label>Product Image</label>
                                    <img
                                        src={imagePreview}
                                        alt=""
                                    />

                                    {progress && (
                                        <progress
                                            value={progress.percentage}
                                            max="100"
                                            className="progress w-100 my-2 "
                                        >
                                            {progress.percentage}%
                                        </progress>
                                    )}

                                    <input
                                        type="file"
                                        className="form-control"
                                        onChange={handleImageInput}
                                    />
                                    {errors.image && (
                                        <div className="invalid-feedback d-block">
                                            {errors.image}
                                        </div>
                                    )}
                                </div>
                            </div>
                        </div>

                        <div className="col-12">
                            <hr />
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
