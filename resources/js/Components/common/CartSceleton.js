import React from 'react';

import Skeleton from 'react-loading-skeleton';
import "react-loading-skeleton/dist/skeleton.css";
const CartSceleton = () => {
    return (
        <>
            <li className="mini-cart-item">
                   
                    <a
                        className="product-image"

                    >
                        <Skeleton height={80} width={80} />
                    </a>
                    <a className="product-name">
                        <Skeleton height={10} width={60} />
                    </a>
                    <div className="quantity">
                        <Skeleton height={10} width={20} />
                    </div>
                <div className="price">
                    <Skeleton height={10} width={14} />
                    <button

                    ></button>
                </div>
            </li>

        </>
    )
}

export default CartSceleton