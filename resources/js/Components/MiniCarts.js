import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import CartSceleton from './common/CartSceleton';
import LoginHeader from './LoginHeader';
import { fetchCart, removeFromCartItem, addToCart, addToCartQty } from './store/cartSlice';
import { fetchWishlist } from './store/WishlistSlice';

const MiniCarts = ({ authenticated }) => {


  const removeCartItem = (id, event) => {
    event.preventDefault();
    dispatch(removeFromCartItem(id));
  };

  //translation
  const { local, viewcart, checkout, noproducts, gotoshop, totaltrans, suggested, search } = headings

  const [cartNavOpened, setcartNavOpened] = useState(false);
  const [openSearch, setOpenSearch] = useState(false);
  const [searchText, setSearchText] = useState('');  
  const [searchResults, setSearchResults] = useState([]);
  const dispatch = useDispatch();

  const cart = useSelector((state) => state.cart.cart);
  const wishlistQty = useSelector((state) => state.wishlist.wishlistQty);
  const isLoading = useSelector((state) => state.cart.loading);
  const totalQty = useSelector((state) => state.cart.totalQty);
  const subTotal = useSelector((state) => state.cart.subTotal);
  const total = useSelector((state) => state.cart.total);
  const error = useSelector((state) => state.cart.error);
  const [screenWidth, setScreenWidth] = useState(window.innerWidth);
  useEffect(() => {
    if (searchText.length > 2) {
        axios.get(`/search/${local}?q=${searchText}`)
            .then(response => {
                setSearchResults(response.data.products);
            })
            .catch(error => {
                console.error('Error fetching search results:', error);
            });
    }
}, [searchText]);
  useEffect(() => {
    const handleResize = () => {
      setScreenWidth(window.innerWidth);
    };

    // Listen for resize events
    window.addEventListener('resize', handleResize);

    // Clean up event listener
    return () => {
      window.removeEventListener('resize', handleResize);
    };
  }, []);
  const handleOpenCartNav = () => {

    if (cartNavOpened) {
      setcartNavOpened(false)

    } else {
      setcartNavOpened(true)

    }
    ;
  }

  useEffect(
    () => {
      dispatch(fetchCart());
      dispatch(fetchWishlist());

    }, [dispatch]
  );

  const copyCart = { ...cart };
  const cartArray = Object.values(copyCart);

  return (

    <>
      {screenWidth > 992 &&
        <>
          <LoginHeader authenticated={authenticated} />
          <div className="search-box" onClick={() => setOpenSearch(true)}>
            <div className="search-toggle" onClick={() => setOpenSearch(true)}><i className="icon-search"></i></div>
          </div>



          <div className="wishlist-box">
            <a href={"/wishlist/" + local}><i className="icon-heart"></i></a>
            <span className="count-wishlist">{wishlistQty && wishlistQty}</span>
          </div>
        </>

      }
      <div className="ruper-topcart dropdown light" >
        <div className={cartNavOpened ? 'dropdown mini-cart top-cart show' : 'dropdown mini-cart top-cart'}>
          {cartNavOpened &&
            <div className="remove-cart-shadow" onClick={() => handleOpenCartNav()}></div>
          }

          <a className="dropdown-toggle cart-icon" href="#c" onClick={() => handleOpenCartNav()}>
            <div className="icons-cart"><i className="icon-large-paper-bag"></i><span className="cart-count">{totalQty && totalQty}</span></div>
          </a>
          <div className={cartNavOpened ? 'dropdown-menu cart-popup show' : 'dropdown-menu cart-popup'} style={screenWidth < 1000 ? { left: '0px !important;' } : null}>
            {cartArray.length < 1 &&
              <div className="cart-empty-wrap">
                <ul className="cart-list">
                  <li className="empty">
                    <span>{noproducts}</span>
                    <a className="go-shop" href={"/products/" + local}>{gotoshop}<i aria-hidden="true" className="arrow_right"></i></a>
                  </li>
                </ul>
              </div>
            }

            <div
              className="cart-list-wrap"
            >
              <ul className="cart-list ">
                {isLoading &&
                  <div>
                    {Array.from({ length: 2 }, (_, index) => (
                      <CartSceleton key={index} />
                    ))}

                  </div>
                }
                {cartArray && !isLoading &&
                  cartArray.map((item) => (
                    <li className="mini-cart-item" key={item.id}>
                      <a href="#R" className="remove" title="Remove this item" onClick={(event) => removeCartItem(item.id, event)}><i className="icon_close"></i></a>
                      <a href={`/product/${item.attributes.slug}/${local}`} className="product-image">
                        <img width="600" height="600" src={'/storage/products/mobile_photos/' + item.attributes.image} alt={item.associatedModel
                          .LocalName} />
                      </a>
                      <a href={`/product/${item.attributes.slug}/${local}`} className="product-name">{item.associatedModel
                        .LocalName}</a>
                      <div className="quantity">Qty: {item.quantity}</div>
                      <div className="price">L.E {item.price}</div>

                    </li>


                  ))}
              </ul>
            </div>
            {cartArray.length > 0 &&
              <div className="total-cart rtl">
                <div className="title-total">{totaltrans}: </div>
                <div className="total-price"><span>L.E{total}</span></div>
              </div>
            }
            <div className="free-ship d-none">
              <div className="title-ship">Buy <strong>$400</strong> more to enjoy <strong>FREE Shipping</strong></div>
              <div className="total-percent"><div className="percent" style={{ width: "20%" }}></div></div>
            </div>
            <div className="buttons">
              <a href={cartArray.length > 0 ? "/site/cart/" + local : "#C"} className={`button btn view-cart btn-primary ${cartArray.length > 0 ? '' : 'disabled'}`} >{viewcart}</a>
              <a href={cartArray.length > 0 ? "/checkout/" + local : "#C"} className={`button btn view-cart btn-primary ${cartArray.length > 0 ? '' : 'disabled'}`} >{checkout}</a>
            </div>

          </div>
        </div>
      </div>
      {openSearch &&
        <div className="search-overlay search-visible">
          <div className="close-search" style={{ cursor: 'pointer' }} onClick={() => setOpenSearch(false)}>
            <span style={{ zIndex: 9, position: 'absolute', fontSize: 60, right: local === 'ar' ? 'auto' : '58%',  left: local === 'ar' ? '58%' : 'auto',top: '10%' }}>
              <p>X
                <small style={{fontSize: 10}}
                >close search
                </small>
              </p>
            </span>
          </div>
          <div className="rtl textRight wrapper-search">
            <form role="search" method="get" className="search-from ajax-search" action="/search">
              <div className="search-box">
                <button id="searchsubmit" className="btn" type="submit">
                  <i className="icon-search"></i>
                </button>
                <input id="myInput" type="text" autocomplete="off" defaultValue={searchText} name="s" className="input-search s" placeHolder={search + ' ...'} onChange={(v) => setSearchText(v.target.value)} />
                <div className="search-top">
                  <div className="close-search" onClick={() => setOpenSearch(false)}>Cancel</div>
                </div>
                <div className="content-menu_search rtl textRight">
                  <label>{suggested}</label>
                  <ul id="menu_search" className="menu">
                  {searchResults.map(result => (
                    <li key={result.id}>
                      <a href={'/product/' + result.slug + '/' + local}> {result.LocalName}</a>
                     </li>
                ))}
                    

                  </ul>
                </div>
              </div>
            </form>
          </div>
        </div>
      }

    </>
  );
};

export default MiniCarts;
