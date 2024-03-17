import React from "react";
import EditIcon from "../../../assets/img/icons/edit.svg";
import { Link } from "@inertiajs/react";

function EditBtn({ url }) {
    return (
        <Link className="btn me-3 p-0" href={url}>
            <img src={EditIcon} alt="img" />
        </Link>
    );
}

export default EditBtn;
