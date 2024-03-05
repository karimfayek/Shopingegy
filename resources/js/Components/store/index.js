import { configureStore } from '@reduxjs/toolkit';
import cartReducer from './cartSlice.js';
import modalReducer from './modalSlice.js'
import userReducer from './userSlice.js'
import WishlistReducer from './WishlistSlice.js';

const store = configureStore({
  reducer: {
    cart: cartReducer,
    modal: modalReducer, 
    user: userReducer,
    wishlist: WishlistReducer
  },
});

export default store;