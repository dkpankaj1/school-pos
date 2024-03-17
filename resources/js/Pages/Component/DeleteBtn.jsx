import React from "react";
import DeleteIcon from "../../../assets/img/icons/delete.svg";
import Swal from "sweetalert2";
import { Link, useForm } from "@inertiajs/react";

function DeleteBtn({ routeName, resource }) {
    const { delete: destroy, processing } = useForm();
    const handleDelete = () => {
        Swal.fire({
            title: "Delete",
            text: "Do you want to delete",
            confirmButtonText: "Delete",
            confirmButtonColor: "#f00",
            showCancelButton: !0,
        }).then((e) => {
            e.isConfirmed && destroy(route(routeName, resource));
        });
    };

    return (
        <Link
            as="button"
            disabled={processing}
            className="btn p-0"
            onClick={handleDelete}
        >
            {processing ? (
                <div className="spinner-border spinner-border-sm text-danger" role="status">
                    <span className="sr-only">Loading...</span>
                </div>
            ) : (
                <img src={DeleteIcon} alt="img" />
            )}
        </Link>
    );
}

export default DeleteBtn;
