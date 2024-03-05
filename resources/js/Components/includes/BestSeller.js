import Axios from 'axios';
import React, { useEffect, useState } from 'react';
import { createPortal } from 'react-dom';
import Slider from "react-slick";
import { useSelector } from 'react-redux';
import ShareModal from '../common/ShareModal';

import Toaste from '../common/Toaste';
import Product from './Product';

import { sliderSettings } from '../common/sliderSettings';
import { useInView } from 'react-intersection-observer';

const BestSeller = () => {
    const { ref, inView } = useInView({
        triggerOnce: true, // Only trigger once
        threshold: 0.5, // Trigger when 50% of the element is in the viewport
      });
  const [bSproducts, setBSproducts] = useState([])
  const [loading, setLoading] = useState(true)
  const isModalOpened = useSelector((state) => state.modal.opened);
const{ bestsellerproducts} = headings
  useEffect(() => {

    //fetch Cats
    Axios.get('/api/bsprs').then(
      response => {
        setBSproducts(response.data.bsprs)
      }
    )
    setLoading(false)
  }, []);



  // component code 

  if(bSproducts.length < 1 ){
    return <p></p>
  }
  return (
    <>
    <section className="section section-padding"  ref={ref}>
    {inView && (
    <div className="section-container" >
       
        <div className="block block-products slider" >
            <div className="block-widget-wrap">
                <div className="block-title"><h2>{ bestsellerproducts }</h2></div>
                <div className="block-content">
                    <div className="content-product-list slick-wrap">
                    <Toaste />
                    <div className="slick-sliders products-list grid" >
                      <Slider {...sliderSettings(bSproducts)}>
                        {bSproducts && bSproducts.map((rpr) =>
            
                          <div className="item-product slick-slide" key={rpr.id}>
                            <div className="items">
                              <Product
                                key={rpr.id}
                                pr={rpr}
                              />
                            </div>
                          </div>
            
            
                        )}
                      </Slider>
                    </div>
                  {/* Share Modal */}
                  {isModalOpened &&
                    <ShareModal />
                  }
            
            
                    </div>
                </div>
            </div>
        </div>
    </div>
    )}
</section>


    </>
  );
};


export default BestSeller;

