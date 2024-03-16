import React from "react";
import { Head } from "@inertiajs/react";
import AppLayouts from "../Layouts/AppLayouts";

import Dash1 from '../../../assets/img/icons/dash1.svg';
import Dash2 from '../../../assets/img/icons/dash2.svg';
import Dash3 from '../../../assets/img/icons/dash3.svg';
import Dash4 from '../../../assets/img/icons/dash4.svg';

import Product22 from '../../../assets/img/product/product22.jpg'
import Product23 from '../../../assets/img/product/product23.jpg'
import Product24 from '../../../assets/img/product/product24.jpg'
import Product6 from '../../../assets/img/product/product6.jpg'

function Dashboard() {
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
                                <img
                                    src={Dash1}
                                    alt="img"
                                />
                            </span>
                        </div>
                        <div className="dash-widgetcontent">
                            <h5>
                                $
                                <span
                                    className="counters"
                                    data-count="307144.00"
                                >
                                    $307,144.00
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
                                <img
                                    src={Dash2}
                                    alt="img"
                                />
                            </span>
                        </div>
                        <div className="dash-widgetcontent">
                            <h5>
                                $
                                <span className="counters" data-count="4385.00">
                                    $4,385.00
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
                                <img
                                    src={Dash3}
                                    alt="img"
                                />
                            </span>
                        </div>
                        <div className="dash-widgetcontent">
                            <h5>
                                $
                                <span
                                    className="counters"
                                    data-count="385656.50"
                                >
                                    385,656.50
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
                                <img
                                    src={Dash4}
                                    alt="img"
                                />
                            </span>
                        </div>
                        <div className="dash-widgetcontent">
                            <h5>
                                $
                                <span
                                    className="counters"
                                    data-count="40000.00"
                                >
                                    400.00
                                </span>
                            </h5>
                            <h6>Total Sale Amount</h6>
                        </div>
                    </div>
                </div>
                <div className="col-lg-3 col-sm-6 col-12 d-flex">
                    <div className="dash-count">
                        <div className="dash-counts">
                            <h4>100</h4>
                            <h5>Customers</h5>
                        </div>
                        <div className="dash-imgs">
                            <i data-feather="user"></i>
                        </div>
                    </div>
                </div>
                <div className="col-lg-3 col-sm-6 col-12 d-flex">
                    <div className="dash-count das1">
                        <div className="dash-counts">
                            <h4>100</h4>
                            <h5>Suppliers</h5>
                        </div>
                        <div className="dash-imgs">
                            <i data-feather="user-check"></i>
                        </div>
                    </div>
                </div>
                <div className="col-lg-3 col-sm-6 col-12 d-flex">
                    <div className="dash-count das2">
                        <div className="dash-counts">
                            <h4>100</h4>
                            <h5>Purchase Invoice</h5>
                        </div>
                        <div className="dash-imgs">
                            <i data-feather="file-text"></i>
                        </div>
                    </div>
                </div>
                <div className="col-lg-3 col-sm-6 col-12 d-flex">
                    <div className="dash-count das3">
                        <div className="dash-counts">
                            <h4>105</h4>
                            <h5>Sales Invoice</h5>
                        </div>
                        <div className="dash-imgs">
                            <i data-feather="file"></i>
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
                                        <a
                                            href="#"
                                            className="dropdown-item"
                                        >
                                            Product List
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="#"
                                            className="dropdown-item"
                                        >
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
                                        <tr>
                                            <td>1</td>
                                            <td className="productimgname">
                                                <a
                                                    href="productlist.html"
                                                    className="product-img"
                                                >
                                                    <img
                                                        src={Product22}
                                                        alt="product"
                                                    />
                                                </a>
                                                <a href="productlist.html">
                                                    Apple Earpods
                                                </a>
                                            </td>
                                            <td>$891.2</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td className="productimgname">
                                                <a
                                                    href="productlist.html"
                                                    className="product-img"
                                                >
                                                    <img
                                                        src={Product23}
                                                        alt="product"
                                                    />
                                                </a>
                                                <a href="productlist.html">
                                                    iPhone 11
                                                </a>
                                            </td>
                                            <td>$668.51</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td className="productimgname">
                                                <a
                                                    href="productlist.html"
                                                    className="product-img"
                                                >
                                                    <img
                                                        src={Product24}
                                                        alt="product"
                                                    />
                                                </a>
                                                <a href="productlist.html">
                                                    samsung
                                                </a>
                                            </td>
                                            <td>$522.29</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td className="productimgname">
                                                <a
                                                    href="productlist.html"
                                                    className="product-img"
                                                >
                                                    <img
                                                        src={Product6}
                                                        alt="product"
                                                    />
                                                </a>
                                                <a href="productlist.html">
                                                    Macbook Pro
                                                </a>
                                            </td>
                                            <td>$291.01</td>
                                        </tr>
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
                                        <a
                                            href="productlist.html"
                                            className="dropdown-item"
                                        >
                                            Product List
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="addproduct.html"
                                            className="dropdown-item"
                                        >
                                            Product Add
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div className="card-body">
                            <div className="table-responsive dataview">
                                <table className="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Products</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td className="productimgname">
                                                <a
                                                    href="productlist.html"
                                                    className="product-img"
                                                >
                                                    <img
                                                        src={Product22}
                                                        alt="product"
                                                    />
                                                </a>
                                                <a href="productlist.html">
                                                    Apple Earpods
                                                </a>
                                            </td>
                                            <td>$891.2</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td className="productimgname">
                                                <a
                                                    href="productlist.html"
                                                    className="product-img"
                                                >
                                                    <img
                                                        src={Product23}
                                                        alt="product"
                                                    />
                                                </a>
                                                <a href="productlist.html">
                                                    iPhone 11
                                                </a>
                                            </td>
                                            <td>$668.51</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td className="productimgname">
                                                <a
                                                    href="productlist.html"
                                                    className="product-img"
                                                >
                                                    <img
                                                        src={Product24}
                                                        alt="product"
                                                    />
                                                </a>
                                                <a href="productlist.html">
                                                    samsung
                                                </a>
                                            </td>
                                            <td>$522.29</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td className="productimgname">
                                                <a
                                                    href="productlist.html"
                                                    className="product-img"
                                                >
                                                    <img
                                                        src={Product6}
                                                        alt="product"
                                                    />
                                                </a>
                                                <a href="productlist.html">
                                                    Macbook Pro
                                                </a>
                                            </td>
                                            <td>$291.01</td>
                                        </tr>
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
