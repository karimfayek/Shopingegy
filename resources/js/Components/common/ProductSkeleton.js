import React from 'react';

import Skeleton from 'react-loading-skeleton';
const ProductSkeleton = () => {
    return (
        <article className="product product-horizontal mb-4">
            <div className="media media-lg flex-column flex-xs-row align-items-xs-center">
                <div className="media-left">
                    <div className="product-figure">
                        <Skeleton height={336} width={300} />
                    </div>
                </div>
                <div className="media-body">
                    <div className="product-title h6 mb-3">
                        <Skeleton height={20} width={100} />
                    </div>
                    <div className="product-price mb-5 ">
                        <Skeleton height={20} width={100} />
                    </div>
                    <div className="product-text  mb-3">

                        <Skeleton height={113} width={308} />
                    </div>
                    <a>
                        <Skeleton height={50} width={124} /></a>
                </div>
            </div>
        </article>
    )
}

export default ProductSkeleton