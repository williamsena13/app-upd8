import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: "http://api-upd8.test/api",
  frontURL: "/",
});

// Adicionando um interceptor para todas as requisições
axiosInstance.interceptors.request.use(config => {
  const authTokenInput = document.getElementById('authToken').value;
  const token = authTokenInput ? authTokenInput.value : '';
  if (token) {
    config.headers['Authorization'] = `Bearer ${token}`;
  }
  return config;
}, error => {
  return Promise.reject(error);
});

axiosInstance.interceptors.response.use(response => {
  return response;
}, error => {
  return Promise.reject(error);
});

export default axiosInstance;
