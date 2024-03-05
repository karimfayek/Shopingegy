import { createSlice } from '@reduxjs/toolkit';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
// Define the initial state
const initialState = {
  wishlist: [],
  wishlistQty: 0 ,
  loading: false,
  error: null,
}; 


// Create the cart slice
const wishlistSlice = createSlice({
  name: 'wishlist',
  initialState,
  reducers: {
    fetchWishlistRequest: (state) => {
      state.loading = true;
      state.error = null;
    },
    fetchWishlistSuccess: (state, action) => {
      state.loading = false;
      state.wishlist = action.payload.wl_content;
      state.wishlistQty = action.payload.totalWL;
    },
    fetchWishlistFailure: (state, action) => {
      state.loading = false;
      state.error = action.payload;
    },
  },
});

// Export the actions
export const { fetchWishlistRequest, fetchWishlistSuccess, fetchWishlistFailure } = wishlistSlice.actions;

// Export the reducer
export default wishlistSlice.reducer;

// Create an async thunk to fetch the cart data from Laravel API
export const fetchWishlist = () => async (dispatch) => {
  try {
    dispatch(fetchWishlistRequest());
    // Make an API call to Laravel to get the cart data
    const response = await fetch('/wishlist/fetch');
    const data = await response.json();
    console.log('wl data' , data)
    dispatch(fetchWishlistSuccess(data));
  } catch (error) {
    dispatch(fetchWishlistFailure(error.message));
  }
};


export const addToWishlist = (id) => async (dispatch) => {
    try{
        dispatch(fetchWishlistRequest());
        const url = '/wishlist/add/item';  
    
        const params = {
            productId: id,
        }
        
        const queryParams = new URLSearchParams(params).toString();
        
        fetch(`${url}?${queryParams}`)
        .then(response => {
          console.log(response)
          if (response.url.includes('/login')) {
            toast.error('you must log in ', {
              position: "top-right",
              autoClose: 3000,
              hideProgressBar: false,
              closeOnClick: true,
              pauseOnHover: true,
              draggable: true,
              progress: undefined,
              theme: "light",
              });
              dispatch(fetchWishlistFailure(data.error));
          }
          return response.json();
          })
          .then(data => {
            console.log(data)
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
                dispatch(fetchWishlistFailure(data.error));
            }else{

              dispatch(fetchWishlistSuccess(data));
              toast.success('added to Wish list', {
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
            dispatch(fetchWishlistFailure(error.message));
           
          });

    } catch (error) {
    dispatch(fetchWishlistFailure(error.message));
  }
  
   
  };

  

  export const removeFromCartItem = (id) => async (dispatch) => {
    try{
        dispatch(fetchWishlistRequest());
        const url = '/product/remove/cart/react';  
    
        const params = {
            productId: id,
        }
        
        const queryParams = new URLSearchParams(params).toString();
        
        fetch(`${url}?${queryParams}`)
          .then(response => response.json())
          .then(data => {
            dispatch(fetchWishlistSuccess(data));
          })
          .catch(error => {
            // Handle any errors
            dispatch(fetchWishlistFailure(error.message));
          });

    } catch (error) {
    dispatch(fetchWishlistFailure(error.message));
  }
  
   
  };

  