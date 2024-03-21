import React from "react";

function PaymentStatus({ status }) {
    switch (status) {
        case "received":
            return <span className="badges bg-lightgreen">Received</span>;
        case "pending":
            return <span className="badges bg-lightred">Pending</span>;
        case "order":
            return <span className="badges bg-lightyellow">Order</span>;
    }
}

export default PaymentStatus;
