import { createArrayExpression } from "@vue/compiler-core";
import axios from "axios";
import { useCookies } from "vue3-cookies";
import { api } from "./baseURL";

const { cookies } = useCookies();
const baseURL = api.baseUrl;

axios.interceptors.request.use(function (config) {
    const token = cookies.get("token");
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

export const login = async (data) => {
    return await axios.post(`${baseURL}/login`, data);
};

export const register = async (data) => {
    return await axios.post(`${baseURL}/register`, data);
};

export const addShop = async (data) => {
    return await axios.post(`${baseURL}/create-user-business`, data);
};

export const createCategory = async (data) => {
    return await axios.post(`${baseURL}/bind-categories`, data);
};

export const getUserBusiness = async (id) => {
    return id
        ? await axios.get(`${baseURL}/get-user-business/${id}`)
        : await axios.get(`${baseURL}/get-user-business`);
};

export const getUserCategories = async (pagination) => {
    return pagination
        ? await axios.get(
              `${baseURL}/get-user-categories?pagination=${pagination.value}`
          )
        : await axios.get(`${baseURL}/get-user-categories`);
};

export const getAllCategories = async () => {
    return await axios.get(`${baseURL}/get-categories`);
};

export const deleteUserCategory = async (id) => {
    return await axios.delete(`${baseURL}/delete-user-category/${id}`);
};

export const createUserService = async (data) => {
    return await axios.post(`${baseURL}/create-user-category-service`, data);
};

export const getUserServices = async () => {
    return await axios.get(`${baseURL}/get-user-services`);
};

export const deleteUserService = async (id) => {
    return await axios.delete(`${baseURL}/delete-user-service/${id}`);
};

export const getAllShops = async () => {
    return await axios.post(`${baseURL}/get-businesses-list`);
};

export const createBooking = async (data) => {
    return await axios.post(`${baseURL}/create-booking`, data);
};

export const logout = async () => {
    return await axios.get(`${baseURL}/logout`);
};
