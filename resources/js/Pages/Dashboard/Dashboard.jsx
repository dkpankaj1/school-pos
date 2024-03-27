import React, { lazy } from "react";
import { Head, usePage } from "@inertiajs/react";
import AppLayouts from "../Layouts/AppLayouts";

import Dash1 from "../../../assets/img/icons/dash1.svg";
import Dash2 from "../../../assets/img/icons/dash2.svg";
import Dash3 from "../../../assets/img/icons/dash3.svg";
import Dash4 from "../../../assets/img/icons/dash4.svg";

import Product22 from "../../../assets/img/product/product22.jpg";
import Product23 from "../../../assets/img/product/product23.jpg";
import Product24 from "../../../assets/img/product/product24.jpg";
import Product6 from "../../../assets/img/product/product6.jpg";

function Dashboard({ dashboardData }) {
    console.log(dashboardData);
    const { setting } = usePage().props;

    return (
        <AppLayouts>
            <Head>
                <title>Dashboard</title>
            </Head>

            <div className="row">
                <div className="col-lg-3 col-sm-6 col-12">
                    <div className="dash-widget">
                        <div className="dash-widgetimg">
                            <span>
                                <img src={Dash1} alt="img" />
                            </span>
                        </div>
                        <div className="dash-widgetcontent">
                            <h5>
                                {setting.currency_symbol}
                                <span
                                    className="counters"
                                    data-count="307144.00"
                                >
                                    NaN
                                </span>
                            </h5>
                            <h6>Total Purchase Due</h6>
                        </div>
                    </div>
                </div>
                <div className="col-lg-3 col-sm-6 col-12">
                    <div className="dash-widget dash1">
                        <div className="dash-widgetimg">
                            <span>
                                <img src={Dash2} alt="img" />
                            </span>
                        </div>
                        <div className="dash-widgetcontent">
                            <h5>
                                {setting.currency_symbol}
                                <span className="counters" data-count="4385.00">
                                    NaN
                                </span>
                            </h5>
                            <h6>Total Sales Due</h6>
                        </div>
                    </div>
                </div>
                <div className="col-lg-3 col-sm-6 col-12">
                    <div className="dash-widget dash2">
                        <div className="dash-widgetimg">
                            <span>
                                <img src={Dash3} alt="img" />
                            </span>
                        </div>
                        <div className="dash-widgetcontent">
                            <h5>
                                {setting.currency_symbol}
                                <span
                                    className="counters"
                                    data-count="385656.50"
                                >
                                    NaN
                                </span>
                            </h5>
                            <h6>Total Sale Amount</h6>
                        </div>
                    </div>
                </div>
                <div className="col-lg-3 col-sm-6 col-12">
                    <div className="dash-widget dash3">
                        <div className="dash-widgetimg">
                            <span>
                                <img src={Dash4} alt="img" />
                            </span>
                        </div>
                        <div className="dash-widgetcontent">
                            <h5>
                                {setting.currency_symbol}
                                <span
                                    className="counters"
                                    data-count="40000.00"
                                >
                                    NaN
                                </span>
                            </h5>
                            <h6>Total Sale Amount</h6>
                        </div>
                    </div>
                </div>
                <div className="col-lg-3 col-sm-6 col-12 d-flex">
                    <div className="dash-count">
                        <div className="dash-counts">
                            <h4>{dashboardData.studentCount}</h4>
                            <h5>Customers</h5>
                        </div>
                        <div className="dash-imgs">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                className="bi bi-person"
                                viewBox="0 0 16 16"
                            >
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div className="col-lg-3 col-sm-6 col-12 d-flex">
                    <div className="dash-count das1">
                        <div className="dash-counts">
                            <h4>{dashboardData.supplierCount}</h4>
                            <h5>Suppliers</h5>
                        </div>
                        <div className="dash-imgs">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                className="bi bi-person-check"
                                viewBox="0 0 16 16"
                            >
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div className="col-lg-3 col-sm-6 col-12 d-flex">
                    <div className="dash-count das2">
                        <div className="dash-counts">
                            <h4>{dashboardData.productCount}</h4>
                            <h5>Product</h5>
                        </div>
                        <div className="dash-imgs">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                className="bi bi-box"
                                viewBox="0 0 16 16"
                            >
                                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div className="col-lg-3 col-sm-6 col-12 d-flex">
                    <div className="dash-count das3">
                        <div className="dash-counts">
                            <h4>NaN</h4>
                            <h5>Sales Invoice</h5>
                        </div>
                        <div className="dash-imgs">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                className="bi bi-file-earmark"
                                viewBox="0 0 16 16"
                            >
                                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div className="row">
                <div className="col-lg-6 col-sm-12 col-12 d-flex">
                    <div className="card flex-fill">
                        <div className="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 className="card-title mb-0">
                                Recently Added Products
                            </h4>
                            <div className="dropdown">
                                <ul
                                    className="dropdown-menu"
                                    aria-labelledby="dropdownMenuButton"
                                >
                                    <li>
                                        <a href="#" className="dropdown-item">
                                            Product List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" className="dropdown-item">
                                            Product Add
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div className="card-body">
                            <div className="table-responsive dataview">
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Products</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {dashboardData.product.map(
                                            (Item, index) => {
                                                return (
                                                    <tr>
                                                        <td>{++index}</td>
                                                        <td className="productimgname">
                                                            <a
                                                                href=""
                                                                className="product-img"
                                                            >
                                                                <img
                                                                    src={
                                                                        Item.images
                                                                    }
                                                                    alt="product"
                                                                />
                                                            </a>
                                                            <a href="">
                                                                {Item.name}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {
                                                                setting.currency_symbol
                                                            }
                                                            {Item.mrp}
                                                        </td>
                                                    </tr>
                                                );
                                            }
                                        )}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="col-lg-6 col-sm-12 col-12 d-flex">
                    <div className="card flex-fill">
                        <div className="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 className="card-title mb-0">
                                Recently Added Products
                            </h4>
                            <div className="dropdown">
                                <ul
                                    className="dropdown-menu"
                                    aria-labelledby="dropdownMenuButton"
                                >
                                    <li>
                                        <a href="#" className="dropdown-item">
                                            Product List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" className="dropdown-item">
                                            Product Add
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div className="card-body">
                            <div className="table-responsive dataview">
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Products</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {dashboardData.product.map(
                                            (Item, index) => {
                                                return (
                                                    <tr>
                                                        <td>{++index}</td>
                                                        <td className="productimgname">
                                                            <a
                                                                href=""
                                                                className="product-img"
                                                            >
                                                                <img
                                                                    src={
                                                                        Item.images
                                                                    }
                                                                    alt="product"
                                                                />
                                                            </a>
                                                            <a href="">
                                                                {Item.name}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {
                                                                setting.currency_symbol
                                                            }
                                                            {Item.mrp}
                                                        </td>
                                                    </tr>
                                                );
                                            }
                                        )}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayouts>
    );
}

export default Dashboard;
