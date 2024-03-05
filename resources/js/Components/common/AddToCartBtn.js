import React, { useState, useEffect } from 'react'

import { fetchCart, addToCart, addToCartQty } from '../store/cartSlice';

import { useDispatch, useSelector } from 'react-redux';
import Axios from 'axios';
import Toaste from './Toaste';
import AddToWLBtn from './AddToWLBtn';

//begin Component
const AddToCartBtn = ({ pr, title, qv, prPage }) => {

    const dispatch = useDispatch();
    const [loadingProductIds, setLoadingProductIds] = useState(null);
    const [product, setProduct] = useState({});
    const [loading, setLoading] = useState({});
    const [buyDispatched, setBuyDispatched] = useState(false);
    const [initialLoad, setInitialLoad] = useState(true);
    const [qty, setQty] = useState(1);
    const error = useSelector((state) => state.cart.error);

    const { local, addtocarttrans, buyitnow } = headings

    const addtoCart = (id, event) => {
        event.preventDefault();
        setLoadingProductIds(id);
        dispatch(addToCart(id));
        dispatch(fetchCart());
        setTimeout(() => {

            setLoadingProductIds(null);
        }, 600);

    };
    const handleQtyChange = (event) => {
        setQty(event.target.value);
        console.log('event target val', event.target.value); //
        console.log('inside handle qty', qty)
    };
    useEffect(() => {
        // Log the updated qty when it changes
        console.log(qty);
    }, [qty]);
    const increaseQty = () => {
        setQty(qty + 1);
        console.log(qty)
    };
    const decreaseQty = () => {
        if (qty == 1) {
            return
        }
        setQty(qty - 1);
    };
    const addtoCartWithQTY = (id, event) => {
        event.preventDefault();
        console.log(id)
        setLoadingProductIds(id);
        dispatch(addToCartQty(qty, id));
        dispatch(fetchCart());
        setTimeout(() => {

            setLoadingProductIds(null);
        }, 600);

    };
    const handleBuyNow = (id, event) => {
        event.preventDefault();
        setLoadingProductIds(id);
        dispatch(addToCartQty(qty, id));
        setBuyDispatched(true)
    };

    useEffect(() => {
        if (!initialLoad && error == null && buyDispatched) {
            window.location.assign('/checkout/' + local)
        }
        if (error !== null) {
            setInitialLoad(true)
            console.log('Error:', error);
        } else {
            setInitialLoad(false)
            console.log('No error');

        }
        setLoadingProductIds(null);
    }, [error]);
    if (prPage) {
        useEffect(() => {
            setLoading(true);

            Axios.get(`/api/product/${pr}`)
                .then((response) => {
                    const responseData = response.data;
                    setProduct(responseData.product);
                    console.log(responseData.product)
                })
                .catch((error) => {
                    console.error("API request failed:", error);
                })
                .finally(() => {
                    setLoading(false);
                });
        }, [prPage]);
        return (
            <>
                <Toaste />
                <div className="add-to-cart-wrap">
                    <div className="quantity">
                        <button type="button" className="plus" onClick={increaseQty}>+</button>
                        <input type="number" className="qty" step="1" min="0" max="" name="quantity" value={qty} onChange={handleQtyChange} title="Qty" size="4" />
                        <button type="button" className="minus" onClick={decreaseQty}>-</button>
                    </div>
                    <div className="btn-add-to-cart" onClick={(event) => addtoCartWithQTY(product.id, event)}>
                        <a href="#"
                            className={loadingProductIds == product.id ? ' button  loading' : 'button '}

                        >{addtocarttrans}</a>
                    </div>

                </div>
                <div className="btn-quick-buy" data-title="Wishlist">
                    <button className="product-btn" onClick={(event) => handleBuyNow(product.id, event)} >{buyitnow}</button>
                </div>
                <div className="btn-wishlist" data-title="Wishlist">
                    <AddToWLBtn pr={product} title='Add to wishlist' />
                </div>

            </>
        )
    }
    if (qv) {
        return (
            <>
                <form className="cart" method="post" encType="multipart/form-data">
                    <div className="quantity-button">
                        <div className="quantity">
                            <button type="button" className="plus" onClick={increaseQty}>+</button>
                            <input type="number" className="qty" step="1" min="0" max="" name="quantity" value={qty} onChange={handleQtyChange} title="Qty" size="4" />
                            <button type="button" className="minus" onClick={decreaseQty}>-</button>
                        </div>
                        {pr.quantity > 0 &&

                            <button
                                rel="nofollow" href="#"
                                className={loadingProductIds == pr.id ? 'single-add-to-cart-button button alt loading' : 'single-add-to-cart-button button alt'}
                                onClick={(event) => addtoCartWithQTY(pr.id, event)}
                            >
                                {addtocarttrans}
                            </button>
                        }
                    </div>
                    <button className="button quick-buy" onClick={(event) => handleBuyNow(pr.id, event)} >{buyitnow}</button>
                </form>


                {pr.quantity < 1 &&
                    <button className="single-add-to-cart-button button alt  disabled" href="#out">Out Of stock</button>
                }
            </>
        )
    }

    return (
        <>
            {pr.quantity > 0 &&
                <a
                    rel="nofollow" href="#"
                    className={loadingProductIds == pr.id ? 'product-btn button loading' : 'product-btn button'}
                    onClick={(event) => addtoCart(pr.id, event)}
                >
                    {title && addtocarttrans}
                </a>
            }

            {pr.quantity < 1 &&
                <a className="product-btn button disabled" href="#out">Out Of stock</a>
            }
        </>
    )
}

export default AddToCartBtn