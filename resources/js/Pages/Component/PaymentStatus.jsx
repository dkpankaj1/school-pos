import React from "react";

function PaymentStatus({ status }) {
    switch (status) {
        case "paid":
            return <span className="badges bg-lightgreen">Paid</span>;
        case "pending":
            return <span className="badges bg-lightred">Pending</span>;
        case "partial":
            return <span className="badges bg-lightyellow">Partial</span>;
    }
}

export default PaymentStatus;
