import React, { useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import ProductImage from './ProductImage';
import AddToCartBtn from '../common/AddToCartBtn';
import QuickViewModal from './QuickViewModal';

import { openModal, setShareProductContent } from '../store/modalSlice';
import AddToWLBtn from '../common/AddToWLBtn';

const local = headings.local
//begin component
const ProductList = ({ pr }) => {

    const dispatch = useDispatch();

    const isModalOpened = useSelector((state) => state.modal.opened);

    const openQVModal = (pr) => {
        dispatch(openModal());
        dispatch(setShareProductContent(pr))
        console.log('in product the pr is', pr)

    };




    const ProductSalePercentage = ({ originalPrice, discountedPrice }) => {
        const percentage = ((originalPrice - discountedPrice) / originalPrice) * 100;
        const roundedPercentage = Math.round(percentage);

        return roundedPercentage
    };
    return (
        <>
            <div className="products-entry clearfix product-wapper">
                <div className="row">

                    <div className="col-md-4">
                        <div className="products-thumb">
                            <div className="product-lable">
                                {pr.sale_price > pr.price &&
                                    <div class="onsale"><ProductSalePercentage originalPrice={pr.price} discountedPrice={pr.sale_price} /> %</div>
                                }
                            </div>
                            <div className="product-thumb-hover">
                                <a href={'/product/' + pr.slug  +'/'+local}>
                                    <ProductImage lastimage={pr.LastImage} firstimage={pr.FirstImage} localname={pr.LocalName} />
                                </a>
                            </div>
                            <span class="product-quickview" data-title="Quick View">
                                <a href="#qv" class="quickview quickview-button" onClick={() => openQVModal(pr)}>Quick View <i class="icon-search"></i></a>
                            </span>

                        </div>

                    </div>
                    <div className="col-md-8">
                        <div className="products-content">
                            <h3 className="product-title">
                                <a href={'/product/' + pr.slug  +'/'+local}>{pr.LocalName}</a></h3>
                            {pr.price > 0 &&
                                <span className="price">
                                    {pr.sale_price > pr.price &&
                                        <del aria-hidden="true"><span>{pr.sale_price}</span></del>
                                    }

                                    <ins><span>L.E {pr.price}</span></ins>
                                </span>
                            }
                            <div className="product-button">
                                <div className="btn-add-to-cart" data-title="Add to cart">
                                    <AddToCartBtn pr={pr} title="Add to cart" />

                                </div>
                                <div className="btn-wishlist" data-title="Wishlist">
                                    <AddToWLBtn pr={pr} />
                                </div>

                            </div>
                            <div className="product-description">{pr.LocalDescription.replace(/<[^>]*>/g, '')}</div>
                        </div>
                    </div>
                </div>

            </div>
           
        </>
    )
}
export default ProductList