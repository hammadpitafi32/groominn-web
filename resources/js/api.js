import axios from 'axios';
import { useCookies } from 'vue3-cookies';
import { api } from './baseURL';

const { cookies } = useCookies();
const baseURL = api.baseUrl;

axios.interceptors.request.use(function (config) {
    const token = cookies.get('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

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

export const createCategory = async (data) => {
    const response = await axios.post(`${baseURL}/create-user-category`, data);
    return response;
}

export const getUserBusiness = async () => {
    const response = await axios.get(`${baseURL}/get-user-business`);
    return response;
}

export const getUserCategories = async (pagination) => {
    if (pagination) {
        const response = await axios.get(`${baseURL}/get-user-categories?pagination=${pagination.value}`);
        return response;
    } else {
        const response = await axios.get(`${baseURL}/get-user-categories`);
        return response
    }
}

export const createUserService = async (data) => {
    const response = axios.post(`${baseURL}/create-user-category-service`, data);
    return response;
}

export const getUserServices = async () => {
    const response = axios.get(`${baseURL}/get-user-services`);
    return response;
}

export const deleteUserCategory = async (id) => {
    const response = axios.delete(`${baseURL}/delete-user-category/${id}`);
    return response;
}

export const logout = async () => {
    const response = await axios.get(`${baseURL}/logout`);
    return response;
}