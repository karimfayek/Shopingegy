import { createSlice } from '@reduxjs/toolkit';

// Define the initial state
const initialState = {
  user: {},
};


// Create the Modal slice
const userSlice = createSlice({
  name: 'user',
  initialState,
  reducers: {
   
      setUser: (state, action) => {
      state.user = action.payload;
      console.log(state.user)
    },
  },
});

// Export the actions
export const { setUser } = userSlice.actions;


// Export the reducer
export default userSlice.reducer;
  