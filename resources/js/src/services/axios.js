import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: "http://api-upd8.test/api",
  frontURL: "/",
});

// Adicionando um interceptor para todas as requisições
axiosInstance.interceptors.request.use(config => {
  // Obtendo o token do input hidden
  console.log("VOU PEGAR TOKEN");
  //const authTokenInput = document.querySelector('#authToken');]
  console.log(document.getElementById('authToken'));
  console.log(document.getElementById('authToken').value);
  const authTokenInput = document.getElementById('authToken').value;
  const token = authTokenInput ? authTokenInput.value : '';

  if (token) {
    // Adicionando o token ao cabeçalho de autorização
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
