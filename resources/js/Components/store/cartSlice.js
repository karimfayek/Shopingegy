import { createSlice } from '@reduxjs/toolkit';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
// Define the initial state
const initialState = {
  cart: [],
  loading: false,
  error: null,
  totalQty : 0 ,
  subTotal : 0 ,
  total : 0 ,
}; 


// Create the cart slice
const cartSlice = createSlice({
  name: 'cart',
  initialState,
  reducers: {
    fetchCartRequest: (state) => {
      state.loading = true;
      state.error = null;
    },
    fetchCartSuccess: (state, action) => {
      state.loading = false;
      state.cart = action.payload.cart_content;
      state.totalQty = action.payload.totalQty;
      state.subTotal = action.payload.subTotal;
      state.total = action.payload.total;
    },
    fetchCartFailure: (state, action) => {
      state.loading = false;
      state.error = action.payload;
     
    },
  },
});

// Export the actions
export const { fetchCartRequest, fetchCartSuccess, fetchCartFailure } = cartSlice.actions;

// Export the reducer
export default cartSlice.reducer;

// Create an async thunk to fetch the cart data from Laravel API
export const fetchCart = () => async (dispatch) => {
  try {
    dispatch(fetchCartRequest());
    // Make an API call to Laravel to get the cart data
    const response = await fetch('/cart');
    const data = await response.json();
    dispatch(fetchCartSuccess(data));
  } catch (error) {
    dispatch(fetchCartFailure(error.message));
  }
};


export const addToCart = (id) => async (dispatch) => {
    try{
        dispatch(fetchCartRequest());
        const url = '/product/add/cart/react';  
    
        const params = {
            productId: id,
        }
        
        const queryParams = new URLSearchParams(params).toString();
        
        fetch(`${url}?${queryParams}`)
          .then(response => response.json())
          .then(data => {
            if(data.error){
              toast.error(`${data.error} `, {
                position: "top-right",
                autoClose: 3000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
                theme: "light",
                });
                dispatch(fetchCartFailure(data.error));
               
            }else{

              dispatch(fetchCartSuccess(data));
              toast.success('added to cart', {
                position: "top-right",
                autoClose: 2000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
                theme: "light",
                });
            }
          })
          .catch(error => {
            // Handle any errors
            dispatch(fetchCartFailure(error.message));
           
          });

    } catch (error) {
    dispatch(fetchCartFailure(error.message));
  }
  
   
  };

  export const addToCartQty = (q , id) => async (dispatch) => {

    try{
        dispatch(fetchCartRequest());
        const url = '/product/add/cart/react/qty';  
    
        const params = {
            productId: id,
            prQty: q,
        }
        
        const queryParams = new URLSearchParams(params).toString();
        
        fetch(`${url}?${queryParams}`)
          .then(response => response.json())
          .then(data => {
            if(data.error){
              dispatch(fetchCartFailure(data.error));
              toast.error(`${data.error} `, {
                position: "top-right",
                autoClose: 3000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
                theme: "light",
                });
            }else{

              dispatch(fetchCartSuccess(data));
              toast.success('added to cart', {
                position: "top-right",
                autoClose: 2000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
                theme: "light",
                });
            }
            dispatch(fetchCartFailure(data.error));
           
          })
          .catch(error => {
            // Handle any errors
            dispatch(fetchCartFailure(error.message));
           
          });

    } catch (error) {
    dispatch(fetchCartFailure(error.message));
  }
  
   
  };

  export const removeFromCartItem = (id) => async (dispatch) => {
    try{
        dispatch(fetchCartRequest());
        const url = '/product/remove/cart/react';  
    
        const params = {
            productId: id,
        }
        
        const queryParams = new URLSearchParams(params).toString();
        
        fetch(`${url}?${queryParams}`)
          .then(response => response.json())
          .then(data => {
            dispatch(fetchCartSuccess(data));
          })
          .catch(error => {
            // Handle any errors
            dispatch(fetchCartFailure(error.message));
          });

    } catch (error) {
    dispatch(fetchCartFailure(error.message));
  }
  
   
  };

  