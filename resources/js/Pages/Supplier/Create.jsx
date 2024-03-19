import React from "react";
import AppLayouts from "../Layouts/AppLayouts";
import { Head, useForm } from "@inertiajs/react";
import PageHeader from "../Component/PageHeader";

function Create() {
    const { data, setData, post, processing, errors } = useForm({
        name: "",
        email: "",
        phone: "",
        address: "",
        city: "",
        state: "",
        country: "",
        postal: "",
    });

    const handleSubmit = () => {
      post(route('suppliers.store'))
    }

    return (
        <AppLayouts>
            <Head>
                <title>Supplier Create - Dashboard</title>
            </Head>

            <PageHeader
                title={"Add Supplier"}
                subtitle={"Create new supplier"}
            />

            <div className="card">
                <div className="card-body">
                    <div className="row">
                        <div className="col-lg-4 col-sm-4 col-12">
                            <div className="form-group">
                                <label>Name</label>
                                <input type="text" placeholder="Enter Name" value={data.name} onChange={e => setData('name',e.target.value)} />
                                { errors.name && <div className="invalid-feedback d-block">{errors.name}</div>}
                            </div>            
                        </div>

                        <div className="col-lg-4 col-sm-4 col-12">
                            <div className="form-group">
                                <label>Email</label>
                                <input type="text" placeholder="example@email.com" value={data.email} onChange={e => setData('email',e.target.value)} />
                                { errors.email && <div className="invalid-feedback d-block">{errors.email}</div>}
                            </div>            
                        </div>

                        <div className="col-lg-4 col-sm-4 col-12">
                            <div className="form-group">
                                <label>Phone</label>
                                <input type="text" placeholder="+91 9917xxxx55" value={data.phone} onChange={e => setData('phone',e.target.value)} />
                                { errors.phone && <div className="invalid-feedback d-block">{errors.phone}</div>}
                            </div>            
                        </div>

                        <div className="col-lg-4 col-sm-4 col-12">
                            <div className="form-group">
                                <label>Address</label>
                                <input type="text" placeholder="Enter address" value={data.address} onChange={e => setData('address',e.target.value)} />
                                { errors.address && <div className="invalid-feedback d-block">{errors.address}</div>}
                            </div>            
                        </div>

                        <div className="col-lg-4 col-sm-4 col-12">
                            <div className="form-group">
                                <label>City</label>
                                <input type="text" placeholder="Enter City" value={data.city} onChange={e => setData('city',e.target.value)} />
                                { errors.city && <div className="invalid-feedback d-block">{errors.city}</div>}
                            </div>            
                        </div>

                        <div className="col-lg-4 col-sm-4 col-12">
                            <div className="form-group">
                                <label>State</label>
                                <input type="text" placeholder="Enter State" value={data.state} onChange={e => setData('state',e.target.value)} />
                                { errors.state && <div className="invalid-feedback d-block">{errors.state}</div>}
                            </div>            
                        </div>

                        <div className="col-lg-4 col-sm-4 col-12">
                            <div className="form-group">
                                <label>Country</label>
                                <input type="text" placeholder="Enter Unit Name" value={data.country} onChange={e => setData('country',e.target.value)} />
                                { errors.country && <div className="invalid-feedback d-block">{errors.country}</div>}
                            </div>            
                        </div>

                        <div className="col-lg-4 col-sm-4 col-12">
                            <div className="form-group">
                                <label>Postal code</label>
                                <input type="text" placeholder="Enter Unit Name" value={data.postal} onChange={e => setData('postal',e.target.value)} />
                                { errors.postal && <div className="invalid-feedback d-block">{errors.postal}</div>}
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
