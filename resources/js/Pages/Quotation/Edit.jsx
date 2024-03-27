import React, { useEffect, useState } from "react";
import { Head, useForm, usePage } from "@inertiajs/react";
import AppLayouts from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import ScannerIcon from "../../../assets/img/icons/scanners.svg";
import DeleteIcon from "../../../assets/img/icons/delete.svg";

function Edit({ products,quotation }) {
    quotation = quotation.data
    const { setting } = usePage().props;
    const [searchQuery, setSearchQuery] = useState("");
    const [searchResult, setSearchResult] = useState([]);

    const { data, setData, put, processing, errors } = useForm({
        date: quotation.date,
        code: quotation.code,
        cart_items: quotation.items,
        other_charges: quotation.other_charges,
        discount: quotation.discount,
        grand_total: quotation.total_amt,
    });

    // Function to handle adding product to cart
    const handleAddToCart = (item) => {
        const newItem = {
            id: item.id,
            name: item.name,
            code: item.code,
            quantity: 1,
            mrp: item.mrp,
            unit: item.unit,
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
    const handleModifyCartItem = (index, field, value) => {
        if (value != "") {
            const updatedCartItems = [...data.cart_items];
            updatedCartItems[index][field] = parseFloat(value);
            setData("cart_items", updatedCartItems);
        }
    };

    const handleSubmit = () => {
        put(route("quotations.update",quotation.id));
    };

    useEffect(() => {
        if (searchQuery === "") {
            setSearchResult([]);
        } else {
            const timeOutId = setTimeout(() => {
                const filteredProduct = products.data.filter((product) => {
                    return (
                        product.name
                            .toLowerCase()
                            .includes(searchQuery.toLowerCase()) ||
                        product.code
                            .toLowerCase()
                            .includes(searchQuery.toLowerCase())
                    );
                });
                setSearchResult(filteredProduct);
            }, 500);
            return () => clearTimeout(timeOutId);
        }
    }, [searchQuery]);

    useEffect(() => {
        let result = 0;
        data.cart_items.forEach((item) => {
            result +=
                (parseFloat(item.mrp) || 0) * (parseFloat(item.quantity) || 1); // Add item mrp to result or 0 if NaN
        });
        result += parseFloat(data.other_charges) || 0; // Add otherCharges to result or 0 if NaN
        result -= parseFloat(data.discount) || 0; // Subtract discount from result or 0 if NaN
        setData("grand_total", result);
    }, [data.cart_items, data.other_charges, data.discount]);

    return (
        <AppLayouts>
            <Head>
                <title>Edit Quotation - Dashboard</title>
            </Head>

            <PageHeader
                title={"Edit Quotation"}
                subtitle={"edit quotation"}
            />
            <div className="card">
                <div className="card-body">
                    <div className="row">
                        <div className="col-lg-3 col-sm-6 col-12">
                            <div className="form-group">
                                <label>Quotation Code</label>
                                <input
                                    value={data.code}
                                    onChange={(e) =>
                                        setData("code", e.target.value)
                                    }
                                    type="text"
                                    className="form-control custom-form-control"
                                    placeholder="Enter Quotation code"
                                />
                                {errors.code && (
                                    <div className="invalid-feedback d-block">
                                        {errors.code}
                                    </div>
                                )}
                            </div>
                        </div>
                        <div className="col-lg-3 col-sm-6 col-12">
                            <div className="form-group">
                                <label>Date</label>
                                <input
                                    value={data.date}
                                    onChange={(e) =>
                                        setData("date", e.target.value)
                                    }
                                    type="date"
                                    className="form-control custom-form-control"
                                />
                                {errors.date && (
                                    <div className="invalid-feedback d-block">
                                        {errors.date}
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
                                        <th>Unit</th>
                                        <th>QTY</th>
                                        <th>
                                            Sale Price({setting.currency_symbol}
                                            )
                                        </th>
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
                                                    <th>{item.unit}</th>
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
                                                                handleModifyCartItem(
                                                                    index,
                                                                    "quantity",
                                                                    parseInt(
                                                                        e.target
                                                                            .value
                                                                    )
                                                                )
                                                            }
                                                        />
                                                    </th>
                                                    <th>
                                                        <input
                                                            type="number"
                                                            style={{
                                                                width: "5rem",
                                                                border: "none",
                                                                padding:
                                                                    ".25rem",
                                                            }}
                                                            value={item.mrp}
                                                            onChange={(e) =>
                                                                handleModifyCartItem(
                                                                    index,
                                                                    "mrp",
                                                                    parseFloat(
                                                                        e.target
                                                                            .value
                                                                    )
                                                                )
                                                            }
                                                        />
                                                    </th>
                                                    <th>
                                                        {parseFloat(
                                                            item.quantity
                                                        ) *
                                                            parseFloat(
                                                                item.mrp
                                                            )}
                                                    </th>
                                                    <th>
                                                        <button
                                                            className=" btn p-0 delete-set"
                                                            onClick={() =>
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
                                            Order Charges (
                                            {setting.currency_symbol})
                                        </h4>
                                        <h5>
                                            <input
                                                type="number"
                                                className="float-md-right p-1"
                                                style={{
                                                    width: "5rem",
                                                    border: "none",
                                                }}
                                                value={data.other_charges}
                                                onChange={(e) =>
                                                    setData(
                                                        "other_charges",
                                                        e.target.value
                                                    )
                                                }
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
                                                style={{
                                                    width: "5rem",
                                                    border: "none",
                                                }}
                                                value={data.discount}
                                                onChange={(e) =>
                                                    setData(
                                                        "discount",
                                                        e.target.value
                                                    )
                                                }
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
                            <button
                                href="#"
                                className="btn btn-submit me-2"
                                onClick={handleSubmit}
                                disabled={processing}
                            >
                                {processing ? "Loading..." : "Save"}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayouts>
    );
}

export default Edit;
