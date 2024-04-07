import { useGetRequest, usePostRequest } from '../axiosClient';
import {useToastr} from '@/composables/toastr.js';

/**
 * user registeration
 * @param {object} newUserData 
 * @returns {object} request response
 */
const useSignup = async (newUserData) => {
    const response = await usePostRequest('register', newUserData);
    console.log(response);
    if (response.data.success) {
      localStorage.setItem('access_token', response.data.user.access_token);
      localStorage.setItem('user_name',  response.data.user.name);
      return true;
    }
    return false;
};


/**
 * user login
 * @param {object} credentials 
 * @returns {object} server response
 */
const useSignin = async (credentials) => {
  const response = await usePostRequest('login', {
    email: credentials.email,
    password: credentials.password
  });
  console.log(response);
  if (response.data.success) {
    localStorage.setItem('access_token', response.data.user.access_token);
    localStorage.setItem('user_name',  response.data.user.name);
    return true;
  }else if(response.data.message === 'Unauthenticated'){
    useToastr('Credentials doesn\'t mathc', false);
  }
  return false;

};

/**
 * user logout
 * @returns {object} request response
 */
const useSignout = () => {
    const response =  useGetRequest('logout');
    localStorage.removeItem('access_token');
};


export {useSignup, useSignin, useSignout };