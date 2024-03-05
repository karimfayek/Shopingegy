import React, {  useState } from 'react';


import { fetchCart, addToCart } from '../store/cartSlice';

import { useDispatch } from 'react-redux';

const  CatList = ({products}) => {

    console.log('in cat list pro',products)
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
   
   {products && products.map
    (
        (prc) =>
            <div className="col-12" key={prc.id}>
                <article className="product product-horizontal">
                    <div className="media media-lg flex-column flex-xs-row align-items-xs-center">
                        <div className="media-left">
                            <div className="product-figure"><a href={"/product/" + prc.slug +'/'+local} >
                                <img className="product-image" style={{ maxWidth: "272px" }}
                                src={prc.FirstImage} alt="" width="290" height="372" /></a>
                            </div>
                        </div>
                        <div className="media-body">
                            <div className="product-title h6"><a href={"/product/" + prc.slug  +'/'+local} >{prc.name}</a></div>
                            <div className="product-price"><span>L.E {prc.price}</span>
                            </div>
                            <div className="product-text"  dangerouslySetInnerHTML={{ __html: prc.description }}></div>
                            {prc.quantity > 0 ?
                                <a  className={loadingProductIds == prc.id ? 'btn btn-primary product-btn disabled' : 'btn btn-primary product-btn'}
                                 href="#add"  onClick={(event) => addtoCart(prc.id, event)}>
                                      {loadingProductIds == prc.id ? <><span className="btn-icon int-clock novi-icon"></span ><span>Adding</span></> : 'Add to Cart'}
                                 </a>
                                :
                                <a className="btn btn-dark product-btn mb-4" href="#out">Out Of stock</a>
                            }
                        </div>
                    </div>
                </article>
            </div>
    )}
     </>
  )
}
export default CatList