import { createSlice } from '@reduxjs/toolkit';

// Define the initial state
const initialState = {
  opened: false,
  shareProductContent: {},
};


// Create the Modal slice
const modalSlice = createSlice({
  name: 'modal',
  initialState,
  reducers: {
   
    openModal: (state, action) => {
      state.opened = true;
      console.log('dispatched open modal')
    },
    closeModal: (state, action) => {
      state.opened = false;
    },
    setShareProductContent: (state, action) => {
      state.shareProductContent = action.payload;
    },
  },
});

// Export the actions
export const { openModal, closeModal, setShareProductContent } = modalSlice.actions;


// Export the reducer
export default modalSlice.reducer;
  