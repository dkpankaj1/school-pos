import React from "react";
import {  useForm, usePage } from "@inertiajs/react";
function BasicFilter({routeName}) {

    const { request } = usePage().props;
    const { data, setData, get, processing } = useForm({
        search: request.query?.search || "",
    });

    const handleSearch = () => {
        get(route(routeName, data));
    };

    return (
        <div className="row">
            <div className="col-12 col-lg-4 col-md-4 ms-auto">
                <div className="form-group d-flex gap-3">
                    <input
                        type="text"
                        placeholder="Search..."
                        value={data.search}
                        onChange={(e) => setData("search", e.target.value)}
                    />

                    <button
                        type="button"
                        onClick={handleSearch}
                        className={`btn btn-primary ${!processing && "px-4"}`}
                        disabled={processing}
                    >
                        {processing ? "Loading." : "Filter"}
                    </button>
                </div>
            </div>
        </div>
    );
}

export default BasicFilter;
