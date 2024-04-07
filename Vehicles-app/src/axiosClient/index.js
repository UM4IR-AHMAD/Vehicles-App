import axios from "axios";
import { useRoute } from 'vue-router';
import {useSignout} from '@/composables/authentication.js';
import {useToastr} from '@/composables/toastr.js';


const route = useRoute();

// create axios instance
const axiosClient = axios.create();

// set base URL
axiosClient.defaults.baseURL = 'http://127.0.0.1:8000/api/';


// take actions before the response reaches then
// actions after getting common errors
axiosClient.interceptors.response.use(null, error => {
    console.log(error.response);
    if(error.response.status >= 400 && error.response.status < 500) {
      console.log('error occurred');
        const status = error.response.status;
        if (status === 401) {
            localStorage.removeItem('access_token');
        }else{
            useToastr('An unexpected error occurred', false);
        }

    }
  return Promise.reject(error.response);
});


/**
 * get data from API
 * @param {string} URL 
 * @returns 
 */
const useGetRequest = (URL) => {
    return axiosClient.get(
        `${URL}`, 
        {headers:{Authorization:`Bearer ${localStorage.getItem('access_token')}`}})
        .then(response => response)
        .catch(err => err);
}


/**
 * send data to API
 * @param {string} URL 
 * @param {object} payLoad 
 * @returns 
 */
const usePostRequest = (URL, payLoad) => {
    return axiosClient.post(`${URL}`, payLoad, {
        headers:{Authorization:`Bearer ${localStorage.getItem('access_token')}`},
    }).then(response => response).catch(err => err);
}


/**
 * send delete request to API
 * @param {string} URL
 * @returns response/error
 */
const usePutRequest = (URL, payLoad) => {
    return axiosClient.put(`${URL}`, payLoad,{
        headers:{Authorization:`Bearer ${localStorage.getItem('access_token')}`},
    }).then(response => response).catch(err => err);
}


/**
 * send delete request to API
 * @param {string} URL
 * @returns response/error
 */
const useDeleteRequest = (URL) => {
    return axiosClient.delete(`${URL}`, {
        headers:{Authorization:`Bearer ${localStorage.getItem('access_token')}`},
    }).then(response => response).catch(err => err);
}


export { useGetRequest, usePostRequest, useDeleteRequest, usePutRequest };