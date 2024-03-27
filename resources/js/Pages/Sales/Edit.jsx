import React, { useEffect, useState } from "react";
import { Head, useForm, usePage } from "@inertiajs/react";
import AppLayouts from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import ScannerIcon from "../../../assets/img/icons/scanners.svg";
import DeleteIcon from "../../../assets/img/icons/delete.svg";
import AvailableStock from "../Component/AvailableStock";

function Create({ stocks, classes, sale }) {
    
    const saleDate = sale.data;
    const { setting } = usePage().props;
    const [searchQuery, setSearchQuery] = useState("");
    const [searchResult, setSearchResult] = useState([]);
    const { data, setData, put, processing, errors } = useForm({
        date: saleDate.date,
        status: saleDate.order_status,
        other_charges: saleDate.other_amount,
        discount: saleDate.discount,
        grand_total: saleDate.total_amount,
        note: saleDate.note,
        cart_items: saleDate.sale_items,
    });

    const handleAddToCart = (item) => {
        const newItem = {
            id: item.id,
            name: item.name,
            code: item.code,
            available: item.quantity,
            quantity: 1,
            unit: item.unit,
            mrp: item.mrp,
        };

        const found = data.cart_items.some(
            (cartItem) => cartItem.id == item.id
        );

        !found && setData("cart_items", [...data.cart_items, newItem]);

        setSearchQuery("");
    };

    // Function to handle removing product from cart
    const handleRemoveFromCart = (index) => {
        const updatedCartItems = [...data.cart_items];
        updatedCartItems.splice(index, 1);
        setData("cart_items", updatedCartItems);
    };

    // Function to handle modifying cart item
    const handleUpdateQuantity = (index, value) => {
        const timeOutId = setTimeout(() => {
            const newQnt = value !== "" ? parseFloat(value) : 0;
            const updatedCartItems = [...data.cart_items];

            if (parseFloat(updatedCartItems[index]["available"]) >= newQnt) {
                updatedCartItems[index]["quantity"] = newQnt;
            } else {
                updatedCartItems[index]["quantity"] = 0;
            }

            setData("cart_items", updatedCartItems);
        }, 0);
        return () => clearTimeout(timeOutId);
    };

    useEffect(() => {
        let result = 0;
        data.cart_items.forEach((item) => {
            result +=
                (parseFloat(item.mrp) || 0) * (parseFloat(item.quantity) || 1); // Add item cost to result or 0 if NaN
        });
        result += parseFloat(data.other_charges) || 0; // Add otherCharges to result or 0 if NaN
        result -= parseFloat(data.discount) || 0; // Subtract discount from result or 0 if NaN
        setData("grand_total", result);
    }, [data.cart_items, data.other_charges, data.discount]);

    useEffect(() => {
        if (searchQuery === "") {
            setSearchResult([]);
        } else {
            const timeOutId = setTimeout(() => {
                const filteredProduct = stocks.data.filter((stock) => {
                    return (
                        stock.name
                            .toLowerCase()
                            .includes(searchQuery.toLowerCase()) ||
                        stock.code
                            .toLowerCase()
                            .includes(searchQuery.toLowerCase())
                    );
                });
                setSearchResult(filteredProduct);
            }, 500);
            return () => clearTimeout(timeOutId);
        }
    }, [searchQuery]);

    const handleSubmit = () => {
        put(route("sales.update",saleDate.id));
    };

    return (
        <AppLayouts>
            <Head>
                <title>Edit Sale - Dashboard</title>
            </Head>

            <PageHeader title={"Edit Sale"} subtitle={"Edit Sale"} />

            <div className="card">
                <div className="card-body">
                    <div className="row">
                        <div className="col-lg-3 col-sm-6 col-12">
                            <div className="form-group">
                                <label>Class</label>
                                <input type="text" disabled={true} value={saleDate.student.class_name} />
                            </div>
                        </div>

                        <div className="col-lg-3 col-sm-6 col-12">
                            <div className="form-group">
                                <label>Student</label>
                                <input type="text" disabled={true} value={saleDate.student.student_name} />

                            </div>
                        </div>

                        <div className="col-lg-3 col-sm-6 col-12">
                            <div className="form-group">
                                <label>Purchase Date </label>
                                <div className="input-groupicon">
                                    <input
                                        type="date"
                                        placeholder="DD-MM-YYYY"
                                        className="form-control custom-form-control"
                                        value={data.date}
                                        onChange={(e) =>
                                            setData("date", e.target.value)
                                        }
                                    />
                                    {errors.date && (
                                        <div className="invalid-feedback d-block">
                                            {errors.date}
                                        </div>
                                    )}
                                </div>
                            </div>
                        </div>

                        <div className="col-lg-3 col-sm-6 col-12">
                            <div className="form-group">
                                <label>Order Status</label>
                                <select
                                    className="form-control custom-form-control"
                                    value={data.status}
                                    onChange={(e) =>
                                        setData("status", e.target.value)
                                    }
                                >
                                    <option value="">Select</option>
                                    <option value="pending">Pending</option>
                                    <option value="order">Order</option>
                                    <option value="received">Received</option>
                                </select>
                                {errors.status && (
                                    <div className="invalid-feedback d-block">
                                        {errors.status}
                                    </div>
                                )}
                            </div>
                        </div>

                        <div className="col-12">
                            <div className="form-group">
                                <label>Search Product</label>

                                <div className="input-groupicon">
                                    <input
                                        type="text"
                                        placeholder="Scan/Search Product by code and select..."
                                        value={searchQuery}
                                        onChange={(e) =>
                                            setSearchQuery(e.target.value)
                                        }
                                    />
                                    <div className="addonset">
                                        <img src={ScannerIcon} alt="img" />
                                    </div>
                                </div>

                                {searchResult.length > 0 && (
                                    <ul className="searchResultContainer">
                                        {searchResult.map((item, index) => {
                                            return (
                                                <li
                                                    key={index}
                                                    className="searchResultItem"
                                                    onClick={() =>
                                                        handleAddToCart(item)
                                                    }
                                                >
                                                    {item.name} | {item.code}
                                                </li>
                                            );
                                        })}
                                    </ul>
                                )}
                                {errors.cart_items && (
                                    <div className="invalid-feedback d-block">
                                        {errors.cart_items}
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="table-responsive">
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Available</th>
                                        <th>Unit</th>
                                        <th>
                                            Price(
                                            {setting.currency_symbol})
                                        </th>
                                        <th>QTY</th>
                                        <th>
                                            Total({setting.currency_symbol})
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {data.cart_items.length === 0 ? (
                                        <tr>
                                            <td
                                                colSpan={8}
                                                className="text-center"
                                            >
                                                no selected items
                                            </td>
                                        </tr>
                                    ) : (
                                        data.cart_items.map((item, index) => {
                                            return (
                                                <tr key={index}>
                                                    <th>{index + 1}</th>
                                                    <th>{item.name}</th>
                                                    <th>{item.code}</th>
                                                    <th>
                                                        <AvailableStock
                                                            stock={
                                                                item.available
                                                            }
                                                        />
                                                    </th>
                                                    <th>{item.unit}</th>
                                                    <th>{item.mrp}</th>
                                                    <th>
                                                        <input
                                                            type="number"
                                                            style={{
                                                                width: "5rem",
                                                                border: "none",
                                                                padding:
                                                                    ".25rem",
                                                            }}
                                                            value={
                                                                item.quantity
                                                            }
                                                            onChange={(e) =>
                                                                handleUpdateQuantity(
                                                                    index,
                                                                    e.target
                                                                        .value
                                                                )
                                                            }
                                                        />
                                                    </th>
                                                    <th>
                                                        {item.mrp *
                                                            item.quantity}
                                                    </th>
                                                    <th></th>
                                                    <th>
                                                        <button
                                                            className=" btn p-0 delete-set"
                                                            onClick={(e) =>
                                                                handleRemoveFromCart(
                                                                    index
                                                                )
                                                            }
                                                        >
                                                            <img
                                                                src={DeleteIcon}
                                                                alt="svg"
                                                            />
                                                        </button>
                                                    </th>
                                                </tr>
                                            );
                                        })
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-lg-12 float-md-right">
                            <div className="total-order">
                                <ul>
                                    <li>
                                        <h4>
                                            Other Charges (
                                            {setting.currency_symbol})
                                        </h4>
                                        <h5>
                                            <input
                                                type="number"
                                                className="float-md-right p-1"
                                                value={data.other_charges}
                                                onChange={(e) =>
                                                    setData(
                                                        "other_charges",
                                                        e.target.value
                                                    )
                                                }
                                                style={{
                                                    width: "5rem",
                                                    border: "none",
                                                }}
                                            />
                                        </h5>
                                    </li>
                                    <li>
                                        <h4>
                                            Discount ({setting.currency_symbol}){" "}
                                        </h4>
                                        <h5>
                                            <input
                                                type="number"
                                                className="float-md-right p-1"
                                                value={data.discount}
                                                onChange={(e) =>
                                                    setData(
                                                        "discount",
                                                        e.target.value
                                                    )
                                                }
                                                style={{
                                                    width: "5rem",
                                                    border: "none",
                                                }}
                                            />
                                        </h5>
                                    </li>

                                    <li className="total">
                                        <h4>
                                            Grand Total (
                                            {setting.currency_symbol})
                                        </h4>
                                        <h5>{data.grand_total}</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-lg-12">
                            <div className="form-group">
                                <label>Description</label>
                                <textarea
                                    className="form-control"
                                    value={data.note}
                                    onChange={(e) =>
                                        setData("note", e.target.value)
                                    }
                                ></textarea>
                            </div>
                        </div>
                        <div className="col-lg-12">
                            <button
                                href="#"
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

export default Create;
