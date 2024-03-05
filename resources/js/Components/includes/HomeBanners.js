import Axios from 'axios';
import React, { useEffect, useState } from 'react'

import Slider from "react-slick";




const HomeBanners = () => {
    const [banners, setBanners] = useState([])
    const [loading, setLoading] = useState(true)
    const [autoplay, setAutoplay] = useState(true);
    const local = headings.local;
    const settings = {
        dots: true,
        infinite: true,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: autoplay,
        lazyLoad: true,
        autoplaySpeed: 5000,
        pauseOnHover: false,
        focusOnSelect: true,
        lazyLoad: true,
        afterChange: () => {
            // Set autoplay to false when user starts moving slides
            setAutoplay(false);
          },
        

    };
    useEffect(() => {
        setLoading(true)
        Axios.get(`/api/homebanners`).then(
            response => {
                setBanners(response.data.banners)
            }
        )
        setLoading(false)


    }, []);
    if (loading) {
        return (
<>

<Slider {...settings}>
<div className="item slick-slide">
            <div className="item-content">
              <div className="content-image" style={{ height:'70vh' , display : 'flex' , justifyContent:'center' , alignItems: 'center' }}>
                <p>loading ...</p>
              </div>
              
            </div>
          </div>
</Slider>
</>

        )
    }
    return (
        <Slider {...settings}>
            {banners && !loading && banners.map((banner) =>
                <div className="item slick-slide" key={banner.id}>
                    <div className="item-content">
                        <div className="content-image">
                            <a href={'/' + banner.url +  '/'+local}>
                            <img  width="1500" height="338" src={"/storage/banners/" + banner.full} alt="Image Slider" /></a>
                        </div>
                        
                    </div>
                </div>
            )}

        </Slider>
    )
}

export default HomeBanners
