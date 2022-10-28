import { createArrayExpression } from "@vue/compiler-core";
import axios from "axios";
import { useCookies } from "vue3-cookies";
import { api } from "./baseURL";

const { cookies } = useCookies();
const baseURL = api.baseUrl;

const instance = axios.create({
    baseURL: baseURL,
});

instance.interceptors.request.use(function (config) {
    const token = cookies.get("token");
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

export const login = async (data) => {
    return await instance.post(`/login`, data);
};

export const register = async (data) => {
    return await instance.post(`/register`, data);
};

export const addShop = async (data) => {
    return await instance.post(`/create-user-business`, data);
};

export const createCategory = async (data) => {
    return await instance.post(`/bind-categories`, data);
};

export const getUserBusiness = async (id) => {
    return id
        ? await instance.get(`/get-user-business/${id}`)
        : await instance.get(`/get-user-business`);
};

export const getUserCategories = async (pagination) => {
    return pagination
        ? await instance.get(
              `/get-user-categories?pagination=${pagination.value}`
          )
        : await instance.get(`/get-user-categories`);
};

export const getAllCategories = async () => {
    return await instance.get(`/get-categories`);
};

export const deleteUserCategory = async (id) => {
    return await instance.delete(`/delete-user-category/${id}`);
};

export const createUserService = async (data) => {
    return await instance.post(`/create-user-category-service`, data);
};

export const getUserServices = async () => {
    return await instance.get(`/get-user-services`);
};

export const deleteUserService = async (id) => {
    return await instance.delete(`/delete-user-service/${id}`);
};

export const getAllShops = async () => {
    return await instance.post(`/get-businesses-list`);
};

export const createBooking = async (data) => {
    return await instance.post(`/create-booking`, data);
};
export const getBooking = async (data) => {
    return await instance.get(`/get-bookings`);
};

export const logout = async () => {
    return await instance.get(`/logout`);
};
export const deleteBusinessImage = async ({ id }) => {
    return await instance.delete(`/delete-business-image?id=${id}`);
};

export const getEarnings = async () => {
    return await instance.get("/get-user-earning");
};

export const getUserBank = async () => {
    return await instance.get("/get-bank-detail");
};

export const createUserBank = async (data) => {
    return await instance.post(`/save-bank-detail`, data);
};

export const getUserData = async () => {
    return await instance.get("/get-auth-user");
};

export const saveUserData = async (data) => {
    return await instance.post("/update-user", data);
};
export const sendUserOtp = async (data) => {
    return await instance.post("/send-otp", data);
};
export const verifyOtp = async (data) => {
    return await instance.post("/verify", data);
};
