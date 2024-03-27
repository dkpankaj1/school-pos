import { Link } from "@inertiajs/react";
import React from "react";
import ShowIcon from '../../../assets/img/icons/eye1.svg';

function ShowBtn({routeUrl}) {
    return (
        <Link className="btn me-3 p-0" href={routeUrl}>
            <img src={ShowIcon} alt="img" />
        </Link>
    );
}

export default ShowBtn;
