import axios from 'axios';
import { initialStore } from '../store/initial-store/initialStore';

const URL_BASE =  'http://localhost/api/'

export class BaseService {
  getHeaders = () => {
    return {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${initialStore.getters.auth_token || ''}`
    }
  }

  createRequest() {
    const API_CONECTION = axios.create({
      headers: this.getHeaders(),
      baseURL: URL_BASE
    });


    API_CONECTION.interceptors.response.use(
      (response) => {
        // console.log('::requester response::', response)
        return response;
      },
      (error) => {
        // console.log('::requester error::', error)
        return Promise.reject(error)
      }
    )

    return API_CONECTION;
  }
}