import React, { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import SiteCartSceleton from './common/SiteCartSceleton';
import { fetchCart, removeFromCartItem, addToCart, addToCartQty } from './store/cartSlice';

const Cart = (props) => {


  const removeCartItem = (id, event) => {
    event.preventDefault();
    dispatch(removeFromCartItem(id));
  };



  const [cartNavOpened, setcartNavOpened] = useState(false);
  const dispatch = useDispatch();

  const [qty, setQty] = useState(1);
  const cart = useSelector((state) => state.cart.cart);
  const isLoading = useSelector((state) => state.cart.loading);
  const totalQty = useSelector((state) => state.cart.totalQty);
  const subTotal = useSelector((state) => state.cart.subTotal);
  const total = useSelector((state) => state.cart.total);
  const error = useSelector((state) => state.cart.error);
//translation

const { local, quantitytrans, checkout , pricetrans , gotoshop , totaltrans , subtotaltrans , producttrans , cartempty , shipping , clearcart , applycoupon , couponcode , calcship} = headings

  useEffect(
    () => {
      dispatch(fetchCart());
    }, [dispatch]
  );
  const handleAddtoCart = (id) => {
    dispatch(addToCart(id));




  };
  const handleAddtoCartQty = async (q, id) => {
    if (q == 1) {
      return
    }
    await dispatch(addToCartQty(q - 1, id));



  };
  const handleQtyChange = (event) => {
    setQty(event.target.value);
    console.log('qty is ' + qty)
  };
  const increaseQty = (id) => {
    setQty(qty + 1);
    handleAddtoCart(id)
  };



  const copyCart = { ...cart };
  const cartArray = Object.values(copyCart);

  return (

    <>
      <div id="content" className="site-content" role="main">
        <div className="section-padding">
          <div className="section-container p-l-r">
          {cartArray.length > 0 && 
            <div className="shop-cart">
              <div className="row rtl textRight">
                <div className="col-xl-8 col-lg-12 col-md-12 col-12">
                  <form className="cart-form" action="" method="post">
                    <div className="table-responsive">
                     
                      <table className="cart-items table ttt" cellspacing="0">
                        <thead>
                          <tr>
                            <th className="product-thumbnail">{producttrans}</th>
                            <th className="product-price">{pricetrans}</th>
                            <th className="product-quantity">{quantitytrans}</th>
                            <th className="product-subtotal">{subtotaltrans}</th>
                            <th className="product-remove">&nbsp;</th>
                          </tr>
                        </thead>
                        <tbody>
                        {isLoading &&
                        <>
                         
                          
                            
                              {Array.from({ length: 2 }, (_, index) => (
                              <SiteCartSceleton key={index} />
                              ))}
                           


                        </>
                      }
                          {cartArray && !isLoading &&
                            cartArray.map((pro) => (
                              <React.Fragment key={pro.id}>
                                <tr className="cart-item">
                                  <td className="product-thumbnail">
                                    <a href={'/product/' + pro.associatedModel.slug}>
                                      <img width="600" height="600" src={'/storage/products/mobile_photos/' + pro.attributes.image} className="product-image" alt="" />
                                    </a>
                                    <div className="product-name">
                                      <a href={'/product/' + pro.associatedModel.slug}>{pro.associatedModel.LocalName}</a>
                                    </div>
                                  </td>
                                  <td className="product-price">
                                    <span className="price">L.E {pro.price}</span>
                                  </td>
                                  <td className="product-quantity">
                                    <div className="quantity">
                                      <button type="button" className="minus" onClick={() => handleAddtoCartQty(pro.quantity, pro.id)}>-</button>
                                      <input type="number"
                                        className="qty" value={pro.quantity}
                                        onChange={handleQtyChange} title="Qty" size="4" inputMode="numeric"
                                        autoComplete="off" />
                                      <button type="button" className="plus" onClick={() => increaseQty(pro.id)}>+</button>
                                    </div>
                                  </td>
                                  <td className="product-subtotal">
                                    <span>L.E {pro.quantity * pro.price}</span>
                                  </td>
                                  <td className="product-remove">
                                    <a href="#" className="remove" onClick={(event) => removeCartItem(pro.id, event)}>×</a>
                                  </td>
                                </tr>
                              </React.Fragment>
                            ))}
                          <tr>
                            <td colspan="6" className="actions">
                              <div className="bottom-cart">
                                <div className="coupon">
                                  <input type="text" name="coupon_code" className="input-text" id="coupon-code" value="" placeHolder={couponcode} />
                                  <button type="submit" name="apply_coupon" className="button" value={applycoupon}>{applycoupon}</button>
                                </div>
                                <h2><a href={"/products/" + local}>{gotoshop}</a></h2>
                                <button type="submit" name="update_cart" className="button btn-danger" value="Update cart">{ clearcart }</button>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                     
                    </div>
                  </form>
                </div>
                <div className="col-xl-4 col-lg-12 col-md-12 col-12">
                  <div className="cart-totals">
                    <h2>Cart totals</h2>
                    <div>
                      <div className="cart-subtotal">
                        <div className="title">{subtotaltrans}</div>
                        <div><span>L.E {subTotal}</span></div>
                      </div>
                      <div className="shipping-totals">
                        <div className="title">{shipping}</div>
                        <div>
                          
                          <p className="shipping-desc">
                           {calcship}
                          </p>
                        </div>
                      </div>
                      <div className="order-total">
                        <div className="title">{totaltrans}</div>
                        <div><span>L.E {total}</span></div>
                      </div>
                    </div>
                    <div className="proceed-to-checkout">
                      <a href="/checkout" className="checkout-button button">
                       {checkout}
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             }
            {cartArray.length < 1 && !isLoading &&
              <div className="shop-cart-empty" >
                <div className="notices-wrapper">
                  <p className="cart-empty">{cartempty}</p>
                </div>
                <div className="return-to-shop">
                  <a className="button" href={"/products/" + local}>
                    {gotoshop}
                  </a>
                </div>
              </div>
            }
          </div>
        </div>
      </div>
      
    </>
  );
};

export default Cart;
