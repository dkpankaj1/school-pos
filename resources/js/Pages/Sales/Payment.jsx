import React, { useEffect } from "react";
import AppLayouts from "../Layouts/AppLayouts";
import { Head, useForm } from "@inertiajs/react";
import PageHeader from "../Component/PageHeader";

function Payment({ sale }) {
    const { data, setData, post, processing, errors, setError,clearErrors } = useForm({
        payment_date: sale.current,
        paid_amount: 0,
        payment_method: "",
    });

    const handleSubmit = () => {
        post(route("sales.payment.store", sale.id));
    };

    useEffect(() => {
        if (sale.amount < data.paid_amount) {
            setError("paid_amount", "Paid amount is grater then sale amount");
        }else{
            clearErrors('paid_amount')
        }
    }, [data.paid_amount]);

    return (
        <AppLayouts>
            <Head>
                <title>Make Payment - Dashboard</title>
            </Head>

            <PageHeader title={"Payment"} subtitle={"Payment"} />

            <div className="card">
                <div className="card-body">
                    <div className="row">
                        <div className="col-md-4">
                            <div className="row">
                                <div className="col-6">
                                    <div className="form-group">
                                        <label>Reference Number</label>
                                        <input
                                            type="text"
                                            placeholder="Enter Product Categories Name"
                                            disabled={true}
                                            value={sale.reference_number}
                                        />
                                    </div>
                                </div>
                                <div className="col-6">
                                    <div className="form-group">
                                        <label>Sale Date</label>
                                        <input
                                            type="text"
                                            placeholder="Enter Product Categories Name"
                                            disabled={true}
                                            value={sale.date}
                                        />
                                    </div>
                                </div>
                            </div>

                            <div className="form-group">
                                <label>Student </label>
                                <input
                                    type="text"
                                    placeholder="Enter Product Categories Name"
                                    disabled={true}
                                    value={sale.student}
                                />
                            </div>

                            <div className="form-group">
                                <label>Payment Date</label>
                                <input
                                    type="date"
                                    className="form-control custom-form-control"
                                    value={data.payment_date}
                                    onChange={(e) =>
                                        setData("payment_date", e.target.value)
                                    }
                                />
                                {errors.payment_date && (
                                    <div className="invalid-feedback d-block">
                                        {errors.payment_date}
                                    </div>
                                )}
                            </div>

                            <div className="row">
                                <div className="col-6">
                                    <div className="form-group">
                                        <label>Total Amount</label>
                                        <input
                                            type="text"
                                            placeholder="Enter Amount"
                                            value={sale.amount}
                                            disabled={true}
                                        />
                                    </div>
                                </div>
                                <div className="col-6">
                                    <div className="form-group">
                                        <label>Amount</label>
                                        <input
                                            type="text"
                                            placeholder="Enter Amount"
                                            value={data.paid_amount}
                                            onChange={(e) =>
                                                setData(
                                                    "paid_amount",
                                                    e.target.value
                                                )
                                            }
                                        />
                                        {errors.paid_amount && (
                                            <div className="invalid-feedback d-block">
                                                {errors.paid_amount}
                                            </div>
                                        )}
                                    </div>
                                </div>
                            </div>

                            <div className="form-group">
                                <label>Payment Method</label>
                                <select
                                    className="form-control custom-form-control"
                                    defaultValue={data.payment_method}
                                    onChange={(e) =>
                                        setData(
                                            "payment_method",
                                            e.target.value
                                        )
                                    }
                                >
                                    <option value={""}> -- select -- </option>
                                    <option value={"cash"}>cash</option>
                                    <option value={"online"}>online</option>
                                    <option value={"cheques"}>cheques</option>
                                    <option value={"bankAccount"}>
                                        bank account
                                    </option>
                                </select>
                                {errors.payment_method && (
                                    <div className="invalid-feedback d-block">
                                        {errors.payment_method}
                                    </div>
                                )}
                            </div>

                            <button
                                disabled={processing}
                                className="btn btn-submit me-2"
                                onClick={handleSubmit}
                            >
                                {processing ? "Loading.." : "Save"}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayouts>
    );
}

export default Payment;
