import React, { useEffect, useState } from 'react';


import { fetchCart, addToCart } from '../store/cartSlice';

import { useDispatch, useSelector } from 'react-redux';

const CatGrid = ({ products }) => {


    const dispatch = useDispatch();
    
  const [loadingProductIds, setLoadingProductIds] = useState(null);
    const addtoCart = (id, event) => {
        event.preventDefault();
        setLoadingProductIds(id);
        dispatch(addToCart(id));
        dispatch(fetchCart());
        setTimeout(() => {
    
          setLoadingProductIds(null);
        }, 600);
    
      };

    const ProductSalePercentage = ({ originalPrice, discountedPrice }) => {
        const percentage = ((originalPrice - discountedPrice) / originalPrice) * 100;
        const roundedPercentage = Math.round(percentage);

        return roundedPercentage
    };
    return (

        <>
            {products && products.map(
                (spr) =>
                    <div className="col-6 col-md-3" key={spr.id}>

                        <article className="product">

                            <div className="product-figure">
                                <div className="l-product-slide-header-actions">

                                    <button type="button" data-slug={spr.slug} className="l-product-slide-header-action ui-product-slide-header-action ui-product-slide-header-action--hoverable" data-toggle="modal" data-target="#shareModal"
                                        role="button">
                                        <svg viewBox="0 0 25 27" fill="none" >
                                            <path d="M20.299 18.161a4.83 4.83 0 0 0-3.477 1.448l-7.74-4.507a4.163 4.163 0 0 0 0-3.204l7.74-4.507a4.83 4.83 0 0 0 3.477 1.448C22.89 8.839 25 6.856 25 4.419S22.891 0 20.299 0c-2.593 0-4.702 1.982-4.702 4.42 0 .564.115 1.105.321 1.602l-7.74 4.506a4.83 4.83 0 0 0-3.477-1.447C2.11 9.08 0 11.063 0 13.5c0 2.437 2.109 4.42 4.701 4.42a4.829 4.829 0 0 0 3.477-1.448l7.74 4.506a4.168 4.168 0 0 0-.321 1.603c0 2.436 2.11 4.419 4.702 4.419S25 25.017 25 22.58c0-2.436-2.109-4.419-4.701-4.419ZM17.31 4.42c0-1.548 1.34-2.808 2.988-2.808 1.647 0 2.987 1.26 2.987 2.808 0 1.549-1.34 2.808-2.988 2.808-1.647 0-2.987-1.26-2.987-2.808ZM4.701 16.308c-1.647 0-2.987-1.26-2.987-2.808 0-1.548 1.34-2.808 2.987-2.808 1.648 0 2.987 1.26 2.987 2.808 0 1.548-1.34 2.808-2.987 2.808Zm12.61 6.273c0-1.549 1.34-2.808 2.988-2.808 1.647 0 2.987 1.26 2.987 2.808 0 1.548-1.34 2.808-2.988 2.808-1.647 0-2.987-1.26-2.987-2.808Z" fill="#686868"></path>
                                        </svg>
                                    </button>

                                </div>
                                <img className="lazy-img product-image"  src={spr.image !== null ?  '/storage/products/medium_photos/' + spr.image :'/storage/product-placeholder.jpg'}   alt="" width="290" height="372" />

                                <div className="product-link"><a className="icon icon-circle icon-xs icon-primary-filled int-eye-opened novi-icon"
                                 href={"/product/" + spr.slug}></a></div>
                                {spr.sale_price > 0 &&
                                    <span className="badge badge-danger product-badge"> <ProductSalePercentage
                                        originalPrice={spr.price}
                                        discountedPrice={spr.sale_price}
                                    />
                                        % off</span>
                                }
                            </div>
                            <div className="product-title h6"><a href={"/product/" + spr.slug}>{spr.name}</a></div>
                            <div className="product-price">
                                <span>L.E {spr.price}</span>
                                {spr.sale_price > 0 ? 
                                    <p className="m-0">(save {(spr.sale_price - spr.price)} L.E)</p> : 
                                    <p></p>
                                }

                            </div>
                            {spr.quantity > 0 ?
                                <a  className={loadingProductIds == spr.id ? 'btn btn-primary product-btn disabled' : 'btn btn-primary product-btn'}
                                 href="#add"  onClick={(event) => addtoCart(spr.id, event)}>
                                      {loadingProductIds == spr.id ? <><span className="btn-icon int-clock novi-icon"></span ><span>Adding</span></> : 'Add to Cart'}
                                 </a>
                                :
                                <a className="btn btn-dark product-btn mb-4" href="#out">Out Of stock</a>
                            }

                        </article>
                    </div>
            )}


        </>

    )
}
export default CatGrid