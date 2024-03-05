import React, { useState, useEffect } from 'react'

import { fetchWishlist, addToWishlist } from '../store/WishlistSlice';

import { useDispatch } from 'react-redux';
import Axios from 'axios';
import Toaste from './Toaste';

//begin Component
const AddToWLBtn = ({ pr, title, qv, prPage }) => {

    const dispatch = useDispatch();
    const [loadingProductIds, setLoadingProductIds] = useState(null);
    const [product, setProduct] = useState({});
    const [loading, setLoading] = useState({});
    const [user, setUser] = useState({});
    const [authinticated, setAuthinticated] = useState(false);
    const [qty, setQty] = useState(1);

    const { local, addtocarttrans, buyitnow , addedtowl , addtowl} = headings

    const addToWL = (id, event) => {
        event.preventDefault();
        if (authinticated && user && user.wishlists.some(item => item.product_id === id)) {
            return window.location.assign('/wishlist/'+ local)
        }
        setLoadingProductIds(id);
        dispatch(addToWishlist(id));
        dispatch(fetchWishlist());
        setTimeout(() => {
            dispatch(fetchWishlist());
            setLoadingProductIds(null);

        }, 600);

    };
    const getClassName = (productId) => {
        if (authinticated && user && user.wishlists.some(item => item.product_id === productId)) {
            return 'product-btn added';
        }
        if(loadingProductIds == productId){
            return 'product-btn added';

        }
        return 'product-btn'; // Default class when conditions are not met
    }
    
    const getTitle = (productId) => {
        if (authinticated && user && user.wishlists.some(item => item.product_id === productId)) {
            return addedtowl;
        }
        if(loadingProductIds == productId){
            return addtowl;

        }
        return addtowl; // Default class when conditions are not met
    }
    useEffect(() => {
        setLoading(true);
        Axios.get(`/user/get`)
            .then((response) => {
                const responseData = response.data;
                if (responseData.auth) {
                    setUser(responseData.user)
                }
                setAuthinticated(responseData.auth)
            })
            .catch((error) => {
                console.error("API request failed:", error);
            })
            .finally(() => {
                setLoading(false);
            });
    }, [loadingProductIds])

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


                <div className="btn-wishlist" data-title="Wishlist">
                    <button className="product-btn">Add to wishlist </button>
                </div>
                <div className="btn-compare" data-title="Compare">
                    <button className="product-btn">Compare</button>
                </div>
            </>
        )
    }
    if (qv) {
        return (
            <>
                <button

                    className={loadingProductIds == pr.id ? 'button alt loading' : 'button alt'}
                    onClick={(event) => addToWL(pr.id, event)}
                >
                    Add to wishlist
                </button>

            </>
        )
    }

    return (
        <>

            <button

                className={getClassName(pr.id)}
                onClick={(event) => addToWL(pr.id, event)}
            >
                {title && getTitle(pr.id)}
            </button>



        </>
    )
}

export default AddToWLBtn