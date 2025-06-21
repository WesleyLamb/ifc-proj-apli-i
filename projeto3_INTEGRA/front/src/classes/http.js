import axios from 'axios';
import { ACCESS_TOKEN } from "@/constants";

const http = axios.create({
  baseURL: "http://painel.castorsoft.localhost",
});

http.interceptors.request.use(config => {
  const token = localStorage.getItem(ACCESS_TOKEN);

  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export default http