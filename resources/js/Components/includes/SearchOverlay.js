import React, { useEffect,  } from 'react'
import { createPortal } from 'react-dom';
import './Qickview.css'
import Slider from "react-slick";
import { closeModal } from '../store/modalSlice';
import {stripTagsAndLimit} from '../functions/utils'
import { useDispatch, useSelector } from 'react-redux';
import AddToCartBtn from '../common/AddToCartBtn';
import AddToWLBtn from '../common/AddToWLBtn';
const QuickViewModal = () => {

    const product = useSelector((state) => state.modal.shareProductContent);
    
    const isModalOpened = useSelector((state) => state.modal.opened);
    const dispatch = useDispatch()
    const settings = {
        dots: true,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        lazyLoad: true,

    };
    
    const closeQVModal = () => {
        dispatch(closeModal());
      };

    const {customerreview} = headings
if(!isModalOpened ){
return (
    <p style={{ display:'none' }}>loading ..</p>
)
}
    return (
        <>
       
      
            <div className={`quickview-popup ${isModalOpened ? 'active' : ''}`} >
                <div className="quickview-container"> 
                    <a href="#close" className="quickview-close" onClick={()=> closeQVModal()}></a>
                    <div className="quickview-notices-wrapper"></div>
                    <div className="product single-product product-type-simple">
                        <div className="product-detail">
                            <div className="row">
                                <div className="img-quickview">
                                    <div className="product-images-slider">
                                        <div id="quickview-slick-carousel">
                                            <div className="images">
                                                <div className="scroll-image">
                                                    <div className="slick-wrap">
                                                        <div className="slick-sliders image-additional" >
                                                            <Slider {...settings}>
                                                                {product.images && product.images.map((image) =>
                                                                    <div className="img-thumbnail slick-slide" key={image.id}>
                                                                        <a href={"/storage/products/medium_photos/" + image.full} className="image-scroll" title="">
                                                                            <img width="900" height="900" src={"/storage/products/medium_photos/" + image.full} alt="Image" />
                                                                        </a>
                                                                    </div>
                                                                )}

                                                            </Slider>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="quickview-single-info">
                                    <div className="product-content-detail entry-summary">
                                        <h1 className="product-title entry-title">{product.LocalName}</h1>
                                        <div className="price-single">
                                            <div className="price">
                                            {product.sale_price && 
                                                <del><span>L.E {product.sale_price}
                                                </span></del>}
                                                <span>L.E{product.price}</span>
                                            </div>
                                        </div>
                                        <div className="product-rating">
                                            <div className="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                                <span style={{ width: "80%" }}>Rated <strong className="rating">4.00</strong> out of 5 based on <span className="rating">1</span> customer rating</span>
                                            </div>
                                            <a href="#" className="review-link">(<span className="count">1</span> {customerreview})</a>
                                        </div>
                                        <div className="description">
                                            <p>
                                               { product && stripTagsAndLimit(product.LocalDescription , 200)}
                                                </p>
                                        </div>
                                        <AddToCartBtn pr={product} qv={true} />
                                        
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="clearfix"></div>
                </div>
            </div>
        </>
        


    )
}
export default QuickViewModal
