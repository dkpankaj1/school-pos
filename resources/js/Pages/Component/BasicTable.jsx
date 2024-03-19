import React from 'react'
function BasicTable({column,data}) {
    return (
        <table className="table">
        <thead>
            <tr>
                {column.map((item, index) => {
                    return <th key={index}>{item.heading}</th>;
                })}
            </tr>
        </thead>
        <tbody>
            {data.map((item,index) => {
                return (
                    <tr key={index}>
                        {column.map((col,index) => {
                            return <td key={index}>{item[col.value]}</td>;
                        })}
                    </tr>
                );
            })}
        </tbody>
    </table>
    );
}

export default BasicTable;
