import React from "react";
import DashboardIcon from '../assets/img/icons/dashboard.svg';
import ProductIcon from '../assets/img/icons/product.svg';
import SettingIcon from '../assets/img/icons/settings.svg';
import SaleIcon from '../assets/img/icons/sales1.svg';
import PurchaseIcon from '../assets/img/icons/purchase1.svg';
import PeopleIcon from '../assets/img/icons/users1.svg';
import ReturnIcon from '../assets/img/icons/return1.svg';
import ReportIcon from '../assets/img/icons/time.svg';

export const menu = [
    {
        label: "Dashboard",
        url: route('dashboard'),
        icon: DashboardIcon,
    },
    {
        label: "Sales",
        url: "",
        icon: SaleIcon,
        sub: [
            { label: "List", url: "#" },
            { label: "New", url: "#" },
        ],
    },
    {
        label: "Purchase",
        url: "",
        icon: PurchaseIcon,
        sub: [
            { label: "List", url: "#" },
            { label: "New", url: "#" },
        ],
    },
    {
        label: "People",
        url: "",
        icon: PeopleIcon,
        sub: [
            { label: "Customer List", url: "#" },
            { label: "Add Customer", url: "#" },
            { label: "Supplier List", url: route('suppliers.index') },
            { label: "Add Supplier", url: route('suppliers.create') },
        ],
    },
    {
        label: "Product",
        url: "",
        icon: ProductIcon,
        sub: [
            { label: "List", url: route('products.index') },
            { label: "Add", url: route('products.create') },
            { label: "Categories", url: route('categories.index') },
            { label: "Unit", url: route('units.index') },
        ],
    },
    {
        label: "Return",
        url: "",
        icon: ReturnIcon,
        sub: [
            { label: "Sale Return List", url: "#" },
            { label: "Add Sale Return", url: "#" },
            { label: "Purchase Return List", url: "#" },
            { label: "Add Purchase Return", url: "#" },
        ],
    },
    {
        label: "Report",
        url: "",
        icon: ReportIcon,
        sub: [
            { label: "List", url: "#" },
            { label: "Add", url: "#" },
            { label: "Categories", url: "#" },
        ],
    },
    {
        label: "Settings",
        url: route('setting.index'),
        icon: SettingIcon,
    }
];
