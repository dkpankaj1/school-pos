import React from "react";

function AvailableStock({ stock }) {

    if(stock == 0){
        return <span className="badges bg-lightyellow">{stock}</span>;
    }else{
        return <span className="badges bg-lightgreen">{stock}</span>;
    }
}

export default AvailableStock;
