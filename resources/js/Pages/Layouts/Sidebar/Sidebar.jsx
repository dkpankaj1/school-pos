import React from "react";
import SidebarItem from "./SidebarItem";
import dashboardIcon from "../../../../assets/img/icons/dashboard.svg";
import {menu} from "../../../menu";

function Sidebar() {
    return (
        <div className="sidebar" style={{ overflowY: "scroll" }}>
            <div className="sidebar-inner slim-scroll">
                <div id="sidebar-menu" className="sidebar-menu">
                    <ul>
                        {menu.map((item,index) => {
                            return <SidebarItem item={item} key={index} />
                        })}
                    </ul>
                </div>
            </div>
        </div>
    );
}

export default Sidebar;
