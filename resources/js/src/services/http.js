import axiosInstance from './axios';

export default {
  install: (app) => {
    app.config.globalProperties.$http = axiosInstance;
  },
};
