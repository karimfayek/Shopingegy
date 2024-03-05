
import axios from 'axios';

// Set up Axios interceptors
axios.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    if (error.response && error.response.status === 422) {
      console.log('Invalid email or password');
    }
    return Promise.reject(error);
  }
);

export default axios;