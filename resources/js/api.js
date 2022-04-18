import axios from 'axios';
import { useCookies } from 'vue3-cookies';
import { api } from './baseURL';

const { cookies } = useCookies();
const baseURL = api.baseUrl;
const token = cookies.get('token');

if (token) {
    axios.interceptors.request.use(function (config) {
        config.headers.Authorization = `Bearer ${token}`;
        return config;
    });
}

export const login = async (data) => {
    const response = await axios.post(`${baseURL}/login`, data);
    return response;
}

export const register = async (data) => {
    const response = await axios.post(`${baseURL}/register`, data);
    return response;
}

export const addShop = async (data) => {
    const response = await axios.post(`${baseURL}/create-user-business`, data);
    return response;
}

export const getUserBusiness = async () => {
    const response = await axios.get(`${baseURL}/get-user-business`);
    return response;
}