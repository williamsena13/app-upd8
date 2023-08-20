import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: "http://api-upd8.test/api",
  frontURL: "/",
});

axiosInstance.interceptors.request.use(request => {
  return request;
}, error => {
  return Promise.reject(error);
});

axiosInstance.interceptors.response.use(response => {
  return response;
}, error => {
  return Promise.reject(error);
});

export default axiosInstance;
