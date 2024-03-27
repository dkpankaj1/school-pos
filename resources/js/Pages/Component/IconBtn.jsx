import React from "react";
import { Link } from "@inertiajs/react";

function IconBtn({icon,url,title="icon btn"}) {
    return (
        <Link className="btn me-3 p-0" href={url} title={title}>
            <img src={icon} alt="img" />
        </Link>
    );
}

export default IconBtn