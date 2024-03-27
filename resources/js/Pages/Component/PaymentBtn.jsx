import React from "react";
import CashIcon from "../../../assets/img/icons/cash.svg";
import { Link } from "@inertiajs/react";

function PaymentBtn({ url }) {
    return (
        <Link className="btn me-3 p-0" href={url} title="Payment">
            <img src={CashIcon} alt="img" />
        </Link>
    );
}

export default PaymentBtn;
