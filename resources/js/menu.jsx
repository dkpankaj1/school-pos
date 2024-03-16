import DashboardIcon from '../assets/img/icons/dashboard.svg'
import ProductIcon from '../assets/img/icons/product.svg'

export const menu = [
    {
        label: "Dashboard",
        url: route('dashboard'),
        icon: DashboardIcon,
    },
    {
        label: "Product",
        url: "",
        icon: ProductIcon,
        sub: [
            {
                label: "List",
                url: "#",
            },
            {
                label: "Add",
                url: "#",
            }
        ],
    },
];
