import React, { useEffect, useRef, useState } from "react";
import { Head, useForm, usePage } from "@inertiajs/react";
import AppLayouts from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import ScannerIcon from "../../../assets/img/icons/scanners.svg";
import DeleteIcon from "../../../assets/img/icons/delete.svg";

function Edit({ purchase, suppliers, products }) {
    const { setting } = usePage().props;
    const [searchQuery, setSearchQuery] = useState("");
    const [searchResult, setSearchResult] = useState([]);

    const { data, setData, put, processing, errors, transform } = useForm({
        supplier: purchase.data.supplier_id,
        purchase_date: purchase.data.date,
        reference: purchase.data.reference_number,
        status: purchase.data.order_status,
        cart_items: purchase.data.purchase_items,
        other_charges: purchase.data.other_amount,
        discount: purchase.data.discount,
        grand_total: purchase.data.total_amount,
        notes: purchase.data.purchase_notes,
    });

    // Function to handle adding product to cart
    const handleAddToCart = (item) => {
        const newItem = {
            id: item.id,
            name: item.name,
            code: item.code,
            quantity: 1,
            mrp: item.mrp,
            cost: item.cost,
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
        put(route("purchases.update", purchase.data.id), data);
    };

    useEffect(() => {
        if (searchQuery === "") {
            setSearchResult([]);
        } else {
            const timeOutId = setTimeout(() => {
                const filteredProduct = products.filter((product) => {
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
                (parseFloat(item.cost) || 0) * (parseFloat(item.quantity) || 1); // Add item cost to result or 0 if NaN
        });
        result += parseFloat(data.other_charges) || 0; // Add otherCharges to result or 0 if NaN
        result -= parseFloat(data.discount) || 0; // Subtract discount from result or 0 if NaN
        setData("grand_total", result);
    }, [data.cart_items, data.other_charges, data.discount]);

    return (
        <AppLayouts>
            <Head>
                <title>New Purchase - Dashboard</title>
            </Head>

            <PageHeader
                title={"New Purchase"}
                subtitle={"Create new purchase"}
            />
            <div className="card">
                <div className="card-body">
                    <div className="row">
                        <div className="col-lg-3 col-sm-6 col-12">
                            <div className="form-group">
                                <label>Supplier Name</label>
                                <select
                                    className="form-control custom-form-control"
                                    defaultValue={data.supplier}
                                    onChange={(e) =>
                                        setData("supplier", e.target.value)
                                    }
                                >
                                    <option value="">Select</option>
                                    {suppliers.map((item, index) => {
                                        return (
                                            <option key={index} value={item.id}>
                                                {item.name}
                                            </option>
                                        );
                                    })}
                                </select>
                                {errors.supplier && (
                                    <div className="invalid-feedback d-block">
                                        {errors.supplier}
                                    </div>
                                )}
                            </div>
                        </div>

                        <div className="col-lg-3 col-sm-6 col-12">
                            <div className="form-group">
                                <label>Purchase Date </label>
                                <div className="input-groupicon">
                                    <input
                                        value={data.purchase_date}
                                        onChange={(e) =>
                                            setData(
                                                "purchase_date",
                                                e.target.value
                                            )
                                        }
                                        type="date"
                                        placeholder="DD-MM-YYYY"
                                        className="form-control custom-form-control"
                                    />
                                </div>
                                {errors.purchase_date && (
                                    <div className="invalid-feedback d-block">
                                        {errors.purchase_date}
                                    </div>
                                )}
                            </div>
                        </div>
                        <div className="col-lg-3 col-sm-6 col-12">
                            <div className="form-group">
                                <label>Reference No.</label>
                                <input
                                    value={data.reference}
                                    onChange={(e) =>
                                        setData("reference", e.target.value)
                                    }
                                    type="text"
                                    className="form-control custom-form-control"
                                    placeholder="Enter Reference Number"
                                />
                                {errors.reference && (
                                    <div className="invalid-feedback d-block">
                                        {errors.reference}
                                    </div>
                                )}
                            </div>
                        </div>

                        <div className="col-lg-3 col-sm-6 col-12">
                            <div className="form-group">
                                <label>Order Status</label>
                                <select
                                    className="form-control custom-form-control"
                                    defaultValue={data.status}
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
                                        <th>QTY</th>
                                        <th>
                                            Purchase Price(
                                            {setting.currency_symbol})
                                        </th>
                                        <th>
                                            Sale Price({setting.currency_symbol}
                                            )
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {data.cart_items.map((item, index) => {
                                        return (
                                            <tr key={index}>
                                                <th>{index + 1}</th>
                                                <th>{item.name}</th>
                                                <th>{item.code}</th>
                                                <th>
                                                    <input
                                                        type="number"
                                                        style={{
                                                            width: "5rem",
                                                            border: "none",
                                                            padding: ".25rem",
                                                        }}
                                                        value={item.quantity}
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
                                                    {" "}
                                                    <input
                                                        type="number"
                                                        style={{
                                                            width: "5rem",
                                                            border: "none",
                                                            padding: ".25rem",
                                                        }}
                                                        value={item.cost}
                                                        onChange={(e) =>
                                                            handleModifyCartItem(
                                                                index,
                                                                "cost",
                                                                parseFloat(
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
                                                            padding: ".25rem",
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
                                    })}
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
                            <div className="form-group">
                                <label>Description</label>
                                <textarea
                                    className="form-control"
                                    value={data.notes}
                                    onChange={(e) =>
                                        setData("notes", e.target.value)
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
                                Submit
                            </button>
                            <a
                                href="purchaselist.html"
                                className="btn btn-cancel"
                            >
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayouts>
    );
}

export default Edit;