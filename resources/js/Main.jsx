/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import store from './Components/store'; 
import MobileMenu from './Components/MobileMenu';

import MiniCarts from './components/MiniCarts';
import RecomendedProducts from './Components/RecomendedProducts';
import HomeBanners from './Components/includes/HomeBanners';
import HomeCats from './Components/HomeCats';
import CatProducts from './Components/CatProducts';
import Cart from './Components/Cart';
import ProductImages from './Components/ProductImages';
import AddToCartBtn from './Components/common/AddToCartBtn';
import LoginHeader from './Components/LoginHeader';
import Checkout from './Components/Checkout';
import QuickViewModal from './Components/includes/QuickViewModal';
const Rprs = document.getElementById('Rprs');
if (Rprs) {
  ReactDOM.render(
    <Provider store={store}>
      <RecomendedProducts />
    </Provider>,
    Rprs
  );
}



// Render the cart component inside the 'cart' div 
const cartDiv = document.getElementById('navbar-cart');

// Remove navbar-cart
const authenticated = cartDiv.getAttribute('data-authenticated');

// Render MiniCarts directly into the parent
if (cartDiv) {
  ReactDOM.render(
    <Provider store={store}>
      <MiniCarts  authenticated={authenticated} />
    </Provider>,
    cartDiv
  );
}

const mobCartDiv = document.getElementById('mobile-cart');
if (mobCartDiv) {
  ReactDOM.render(
    <Provider store={store}>
      <MiniCarts />
    </Provider>,
    mobCartDiv
  );
}


const mobMenu = document.getElementById('mobile-menu');
if (mobMenu) {
  ReactDOM.render(
    <Provider store={store}>
      <MobileMenu />
    </Provider>,
    mobMenu
  );
}

const homeBanners = document.getElementById('homeBanners');
if (homeBanners) {
  ReactDOM.render(
    <Provider store={store}>
      <HomeBanners />
    </Provider>,
    homeBanners
  );
}

const homeCats = document.getElementById('home-cats');
if (homeCats) {
  ReactDOM.render(
    <Provider store={store}>
      <HomeCats />
    </Provider>,
    homeCats
  );
}
const catProducts = document.getElementById('cat-products');
if (catProducts) {
  const slug = catProducts.getAttribute('data-slug');
  ReactDOM.render(
    <Provider store={store}>
      <CatProducts slug={slug} />
    </Provider>,
    catProducts
  );
}

const cart = document.getElementById('cart');
if (cart) {
  ReactDOM.render(
    <Provider store={store}>
      <Cart />
    </Provider>,
    cart
  );
}

const productimages = document.getElementById('Product-sliders');
if (productimages) {
  ReactDOM.render(
    <Provider store={store}>
      <ProductImages />
    </Provider>,
    productimages
  );
}
const prPageBtn = document.getElementById('add-to-cart-product-page');
if (prPageBtn) {
  const pr = JSON.parse(prPageBtn.getAttribute('data-pr'));
  ReactDOM.render(
    <Provider store={store}>
      <AddToCartBtn pr={pr} prPage={true} />
    </Provider>,
    prPageBtn
  );
}

const loginheader = document.getElementById('login-header');
if (loginheader) {
  
  const authenticated = loginheader.getAttribute('data-authenticated');
  ReactDOM.render(
    <Provider store={store}>
      <LoginHeader authenticated={authenticated} />
    </Provider>,
    loginheader
  );
}

const checkout = document.getElementById('checkout');
if (checkout) {
  
  ReactDOM.render(
    <Provider store={store}>
      <Checkout />
    </Provider>,
    checkout
  );
}


const QVContainer = document.getElementById('quickview-container');
if (QVContainer) {
  
  ReactDOM.render(
    <Provider store={store}>
      <QuickViewModal />
    </Provider>,
    QVContainer
  );
}



