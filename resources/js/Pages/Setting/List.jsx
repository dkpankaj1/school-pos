import React from "react";
import AppLayouts from "../Layouts/AppLayouts";
import { Head, useForm } from "@inertiajs/react";
import PageHeader from "../Component/PageHeader";
import PageTitle from "../Component/PageTitle";

function List({ settings, financeYear }) {
    console.log(financeYear);

    const { data, setData, put, processing, errors } = useForm({
        company: settings.company,
        phone: settings.phone,
        email: settings.email,
        address: settings.address,
        city: settings.city,
        state: settings.state,
        country: settings.country,
        currency_code: settings.currency_code,
        currency_symbol: settings.currency_symbol,
        default_finance_year : settings.finance_year_id
    });

    const handleSubmit = () => {
        put(route("setting.update"));
    };

    return (
        <AppLayouts>
            <Head>
                <title>General Setting - Dashboard</title>
            </Head>

            <PageHeader title={"Settings"} subtitle={"Manage Settings"} />

            <div className="card">
                <div className="card-body">
                    <div className="row">
                        <div className="col-12">
                            <div className="form-group">
                                <label>
                                    Company Name
                                    <span className="manitory">*</span>
                                </label>
                                <input
                                    type="text"
                                    placeholder="Enter company name"
                                    value={data.company}
                                    onChange={(e) =>
                                        setData("company", e.target.value)
                                    }
                                />
                                 { errors.company && <div className="invalid-feedback d-block">{errors.company}</div>}
                            </div>
                        </div>

                        <div className="col-lg-4 col-sm-6 col-12">
                            <div className="form-group">
                                <label>
                                    Phone <span className="manitory">*</span>
                                </label>
                                <input
                                    type="text"
                                    placeholder="Enter phone"
                                    value={data.phone}
                                    onChange={(e) =>
                                        setData("phone", e.target.value)
                                    }
                                />
                                 { errors.phone && <div className="invalid-feedback d-block">{errors.phone}</div>}
                            </div>
                        </div>

                        <div className="col-lg-4 col-sm-6 col-12">
                            <div className="form-group">
                                <label>
                                    Email <span className="manitory">*</span>
                                </label>
                                <input
                                    type="text"
                                    placeholder="Enter email"
                                    value={data.email}
                                    onChange={(e) =>
                                        setData("email", e.target.value)
                                    }
                                />
                                 { errors.email && <div className="invalid-feedback d-block">{errors.email}</div>}
                            </div>
                        </div>

                        <div className="col-lg-4 col-sm-6 col-12">
                            <div className="form-group">
                                <label>
                                    Address <span className="manitory">*</span>
                                </label>
                                <input
                                    type="text"
                                    placeholder="Enter address"
                                    value={data.address}
                                    onChange={(e) =>
                                        setData("address", e.target.value)
                                    }
                                />
                                 { errors.address && <div className="invalid-feedback d-block">{errors.address}</div>}
                            </div>
                        </div>

                        <div className="col-lg-4 col-sm-6 col-12">
                            <div className="form-group">
                                <label>
                                    City <span className="manitory">*</span>
                                </label>
                                <input
                                    type="text"
                                    placeholder="Enter Title"
                                    value={data.city}
                                    onChange={(e) =>
                                        setData("city", e.target.value)
                                    }
                                />
                                 { errors.city && <div className="invalid-feedback d-block">{errors.city}</div>}
                            </div>
                        </div>

                        <div className="col-lg-4 col-sm-6 col-12">
                            <div className="form-group">
                                <label>
                                    State <span className="manitory">*</span>
                                </label>
                                <input
                                    type="text"
                                    placeholder="Enter Title"
                                    value={data.state}
                                    onChange={(e) =>
                                        setData("state", e.target.value)
                                    }
                                />
                                 { errors.state && <div className="invalid-feedback d-block">{errors.state}</div>}
                            </div>
                        </div>

                        <div className="col-lg-4 col-sm-6 col-12">
                            <div className="form-group">
                                <label>
                                    Country <span className="manitory">*</span>
                                </label>
                                <input
                                    type="text"
                                    placeholder="Enter Title"
                                    value={data.country}
                                    onChange={(e) =>
                                        setData("country", e.target.value)
                                    }
                                />
                                 { errors.country && <div className="invalid-feedback d-block">{errors.country}</div>}
                            </div>
                        </div>

                        <div className="col-lg-3 col-sm-6 col-12">
                            <div className="form-group">
                                <label>
                                    Currency Code
                                    <span className="manitory">*</span>
                                </label>
                                <input
                                    type="text"
                                    placeholder="Enter Title"
                                    value={data.currency_code}
                                    onChange={(e) =>
                                        setData("currency_code", e.target.value)
                                    }
                                />
                                 { errors.currency_code && <div className="invalid-feedback d-block">{errors.currency_code}</div>}
                            </div>
                        </div>

                        <div className="col-lg-3 col-sm-6 col-12">
                            <div className="form-group">
                                <label>
                                    Currency Symbol
                                    <span className="manitory">*</span>
                                </label>
                                <input
                                    type="text"
                                    placeholder="Enter Title"
                                    value={data.currency_symbol}
                                    onChange={(e) =>
                                        setData(
                                            "currency_symbol",
                                            e.target.value
                                        )
                                    }
                                />
                                 { errors.currency_symbol && <div className="invalid-feedback d-block">{errors.currency_symbol}</div>}
                            </div>
                        </div>

                        <div className="col-lg-6 col-sm-6 col-12">
                            <div className="form-group">
                                <label>
                                    Default Finance Year
                                    <span className="manitory">*</span>
                                </label>
                                <select className="form-control form-select" style={{outline : "none"}} defaultValue={data.default_finance_year} onChange={e => setData('default_finance_year',e.target.value)}>
                                    <option value="">-- Choose -- </option>
                                    {
                                        financeYear.map((item) => {
                                            return <option key={item.id} value={item.id}>{item.name}</option>
                                        })
                                    }
                                </select>
                                { errors.default_finance_year && <div className="invalid-feedback d-block">{errors.default_finance_year}</div>}
                            </div>
                        </div>

                        <div className="row">
                            <div className="col-lg-12">
                                <button
                                    disabled={processing}
                                    className="btn btn-btn btn-primary"
                                    onClick={handleSubmit}
                                >
                                    {processing ? "Loading.." : "Update"}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayouts>
    );
}

export default List;
