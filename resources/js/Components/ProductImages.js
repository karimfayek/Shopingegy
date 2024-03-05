import React, { useEffect, useRef, useState } from "react";
import Slider from "react-slick";
import ReactImageZoom from 'react-image-zoom';


//begin component
const ProductImages = () => {
    const [nav1, setNav1] = useState(null);
    const [nav2, setNav2] = useState(null);
    const slider1 = useRef(null);
    const slider2 = useRef(null);

    useEffect(() => {
        setNav1(slider1.current);
        setNav2(slider2.current);
    }, []);

    return (
        <>         

            <div className="col-md-2">
                <div className="content-thumbnail-scroll">
                    <div className="image-thumbnail slick-carousel slick-vertical" >
                        <Slider
                            asNavFor={nav1}
                            ref={slider2}
                            slidesToShow={2}
                            swipeToSlide={true}
                            focusOnSelect={true}
                            vertical={true}
                        >
                            <div className="img-item slick-slide">
                                <span className="img-thumbnail-scroll">
                                    <img width="120" height="120" src="http://shopingegy.eit-host.com/storage/products/thumbnail/LzmznAy8fVypdulFP0q23WJhBbG9vU6zlNsvwErK.jpg" alt="" />
                                </span>
                            </div>
                            <div className="img-item slick-slide">
                                <span className="img-thumbnail-scroll">
                                    <img width="120" height="120" src="http://shopingegy.eit-host.com/storage/products/thumbnail/WK9rTxvvuK1ydUFVzK6W2NkX36Si3BbwrUsnpHBS.jpg" alt="" />
                                </span>
                            </div>

                        </Slider>

                    </div>
                </div>
            </div>
            <div className="col-md-10">
                <div className="scroll-image main-image">
                    <div className="image-additional slick-carousel">

                        <Slider asNavFor={nav2}  arrows = {true}  ref={slider1}>
                            <div className="img-item slick-slide">
                                <img width="120" height="120" src="http://shopingegy.eit-host.com/storage/products/original_photos/LzmznAy8fVypdulFP0q23WJhBbG9vU6zlNsvwErK.jpg" alt="" />
                            </div>
                            <div className="img-item slick-slide">
                                <img width="120" height="120" src="http://shopingegy.eit-host.com/storage/products/original_photos/WK9rTxvvuK1ydUFVzK6W2NkX36Si3BbwrUsnpHBS.jpg" alt="" />
                            </div>

                        </Slider>

                    </div>
                </div>
            </div>
        </>
    );
};

export default ProductImages;