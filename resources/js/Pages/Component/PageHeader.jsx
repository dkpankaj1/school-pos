import React from "react";

function PageHeader({title,subtitle,children}) {
    return (
        <div className="page-header">
            <div className="page-title">
                <h4 className="text-uppercase">{title}</h4>
                <h6>{subtitle}</h6>
            </div>
            <div className="page-btn">
                {children}
            </div>
        </div>
    );
}

export default PageHeader;
