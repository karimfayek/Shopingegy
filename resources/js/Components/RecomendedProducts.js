import Axios from 'axios';
import React, { useEffect, useState } from 'react';
import { createPortal } from 'react-dom';
import Slider from "react-slick";
import { useSelector } from 'react-redux';
import ShareModal from './common/ShareModal';

import Toaste from './common/Toaste';
import Product from './includes/Product';
import SaleProducts from './includes/SaleProducts';
import BestSeller from './includes/BestSeller';
import { sliderSettings } from './common/sliderSettings';

import { useInView } from 'react-intersection-observer';

const RecomendedProducts = () => {
  const { ref, inView } = useInView({
    triggerOnce: true, // Only trigger once
    threshold: 0.5, // Trigger when 50% of the element is in the viewport
  });
  const [rproducts, setRproducts] = useState([])
  const [loading, setLoading] = useState(true)
  const isModalOpened = useSelector((state) => state.modal.opened);
const{ RecomProducts} = headings
const{ viewall} = translations
  useEffect(() => {

    //fetch Cats
    Axios.get('/api/rprs').then(
      response => {
        setRproducts(response.data.rprs)
      }
    )
    setLoading(false)
  }, []);


  // component code 
 
  return (
    <>
    <section className="section section-padding" ref={ref}>
    {inView && (
    <div className="section-container" >
       
        <div className="block block-products slider" >
            <div className="block-widget-wrap">
                <div className="block-title row" style={{ justifyContent:'space-between' }}>
                  <h2>{ RecomProducts }</h2>
                  <a className='button-slider button-black' href="#">{viewall}</a>
                </div>
                <div className="block-content">
                    <div className="content-product-list slick-wrap">
                    <Toaste />
                    <div className="slick-sliders products-list grid" >
                      <Slider {...sliderSettings(rproducts)}>
                        {rproducts && rproducts.map((rpr) =>
            
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
<SaleProducts/>
<BestSeller />
      

    </>
  );
};


export default RecomendedProducts;

