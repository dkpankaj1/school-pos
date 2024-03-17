import { Link, usePage } from "@inertiajs/react";
import React, { useState, useEffect } from "react";

function SidebarItem({ item }) {
    const [open, setOpen] = useState(false);
    const { url } = usePage();
    const [isActive, setIsActive] = useState(false);

    useEffect(() => {
        setIsActive(window.location.href === item.url);
    }, [url, item.url]);

    if (item.sub) {
        return (
            <li className={`submenu ${isActive ? "active" : ""}`} onClick={() => setOpen(!open)}>
                <a className={`sub-drop ${open ? "active" : ""}`}>
                    <img src={item.icon} alt="img" />
                    <span>{item.label}</span>
                    <span className="menu-arrow"></span>
                </a>
                <ul style={{ display: open ? "block" : "none" }}>
                    {item.sub.map((subitem, index) => (
                        <li key={index} className={window.location.href === subitem.url ? "active" : ""}>
                            <Link href={subitem.url}>{subitem.label}</Link>
                        </li>
                    ))}
                </ul>
            </li>
        );
    } else {
        return (
            <li className={`sub-drop ${isActive ? "active" : ""}`}>
                <Link href={item.url}>
                    <img src={item.icon} alt="img" />
                    <span>{item.label}</span>
                </Link>
            </li>
        );
    }
}

export default SidebarItem;
