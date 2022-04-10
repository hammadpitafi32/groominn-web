import axios from 'axios';
import { useCookies } from 'vue3-cookies';
import { api } from './baseURL';

const { cookies } = useCookies();
const baseURL = api.baseUrl;
const token = cookies.get('token');

if (token) {
    axios.interceptors.request.use(function (config) {
        config.headers.Authorization = token;
        return config;
    });
}

export const login = async (data) => {
    const response = await axios.post(`${baseURL}/api/login`, data);
    return response;
}
