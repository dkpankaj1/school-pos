import React from "react";
import CartCheckIcon from "../../../assets/img/icons/cart-check.svg";
import { Link } from "@inertiajs/react";

function ConvertSaleBtn({ url }) {
    return (
        <Link className="btn me-3 p-0" href={url}>
            <img src={CartCheckIcon} alt="img" />
        </Link>
    );
}

export default ConvertSaleBtn;
