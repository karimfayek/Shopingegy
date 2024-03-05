import React, { useState , useEffect , useRef  } from 'react';
import ProductImage from './ProductImage';
import QuickViewModal from './QuickViewModal';
import { useDispatch, useSelector } from 'react-redux';
import AddToCartBtn from '../common/AddToCartBtn';
import { openModal, setShareProductContent } from '../store/modalSlice';
import AddToWLBtn from '../common/AddToWLBtn';
const { local, addtocarttrans } = headings



//begin component
const Product = ({ pr }) => {
    const [loading, setLoading] = useState(false)
    const [Pageload , setPageload ] = useState(false)  
    const isDragging = useRef(false);
  const dragStartX = useRef(0);
  const dragStartY = useRef(0);
    const [loadingProductIds, setLoadingProductIds] = useState(null);
    const dispatch = useDispatch();

    const isModalOpened = useSelector((state) => state.modal.opened);
    const [isHovered, setIsHovered] = useState(false);

    const handleMouseEnter = () => {
      setIsHovered(true);
    };
  
    const handleMouseLeave = () => {
      setIsHovered(false);
    };

    const openQVModal = (pr) => {
        setLoading(true);
        setLoadingProductIds(pr.id);
        
        console.log('ismodal opened inside openqvmodal',isModalOpened)
    };

  

    useEffect(() => {
        if (loading && loadingProductIds !== null) {
            setTimeout(() => {
                dispatch(openModal());
                dispatch(setShareProductContent(pr));
                setLoadingProductIds(null);
                setLoading(false);
            }, 600);
        }
    }, [loading, loadingProductIds, pr, dispatch]);

    const ProductSalePercentage = ({ originalPrice, discountedPrice }) => {
        const percentage = ((originalPrice - discountedPrice) / originalPrice) * 100;
        const roundedPercentage = Math.round(percentage);

        return roundedPercentage
    };
 
    useEffect(() => {
        if (Pageload) {
          const portalElement = document.createElement('div');
          portalElement.className = 'page-preloader';
          portalElement.innerHTML = `
            <div class="loader">
              <div></div>
              <div></div>
            </div>
          `;
          document.body.appendChild(portalElement);
          return () => {
            document.body.removeChild(portalElement);
            setPageload(false)
          };
        }
      }, [Pageload]);

      const handleMouseDown = (e) => {
        // Store the starting position of the mouse
        dragStartX.current = e.clientX;
        dragStartY.current = e.clientY;
        isDragging.current = false;
      };
    
      const handleMouseUp = (e) => {
        // Calculate the distance the mouse has moved
        const dx = Math.abs(dragStartX.current - e.clientX);
        const dy = Math.abs(dragStartY.current - e.clientY);
    
        // If the mouse has moved more than a certain amount, set isDragging to true
        if (dx > 5 || dy > 5) {
          isDragging.current = true;
        }
      };
    
      const handlePageLoad = (e) => {
        // If isDragging is true, prevent the default action and return
        if (isDragging.current) {
          e.preventDefault();
          return;
        }
        // Otherwise, proceed with the page load
        setPageload(true);
      };
    return (
        <>

            <div className="products-entry clearfix product-wapper" onMouseEnter={handleMouseEnter} onMouseLeave={handleMouseLeave}>
                <div className="products-thumb">
                    <div className="product-lable">
                        {pr.sale_price > pr.price &&
                            <div className="onsale"><ProductSalePercentage originalPrice={pr.price} discountedPrice={pr.sale_price} /> %</div>
                        }
                    </div>
                    <div className="product-thumb-hover" onMouseDown={handleMouseDown}
           onMouseUp={handleMouseUp}>
                        <a href={'/product/' + pr.slug + '/' + local} onClick={(e) => handlePageLoad(e)} >
                            <ProductImage lastimage={pr.LastImage} firstimage={pr.FirstImage} localname={pr.LocalName} />
                        </a>
                    </div>
                    {isHovered && 
                    <div className="product-button">
                        <div className="btn-add-to-cart" data-title="Add to cart">
                            <AddToCartBtn pr={pr} />
                        </div>
                        <div className="btn-wishlist" data-title="Wishlist">
                            <AddToWLBtn pr={pr} />
                        </div>

                        <span className="product-quickview" data-title="Quick View">
                            <a href="#qv" className={loadingProductIds == pr.id ? 'quickview quickview-button  loading' : "quickview quickview-button"} onClick={() => openQVModal(pr)}>Quick View <i className="icon-search"></i></a>
                        </span>
                    </div>
                }
                </div>
                <div className="products-content">
                    <div className="contents text-center">
                        <h3 className="product-title">
                            <a href={'/product/' + pr.slug} onClick={() => handlePageLoad('title')}>{pr.LocalName}</a></h3>
                        {pr.price > 0 &&
                            <span className="price">
                                {pr.sale_price > pr.price &&
                                    <del aria-hidden="true"><span>{pr.sale_price}</span></del>
                                }

                                <ins><span>L.E {pr.price}</span></ins>
                            </span>
                        }

                    </div>
                </div>
            </div>
            
        </>
    )
}
export default Product