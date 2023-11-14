import axios from 'axios'
import { API_URLS } from '../api-urls'

import { memoizedRefreshToken } from './refresh-token'

axios.defaults.baseURL = `${API_URLS.base_url}/api`

axios.interceptors.request.use(
  async (config) => {
    const session = JSON.parse(localStorage.getItem('session'))

    if (session?.access_token) {
      config.headers.Authorization = `Bearer ${session?.access_token}`
    }

    return config
  },
  (error) => Promise.reject(error)
)

axios.interceptors.response.use(
  (response) => response,
  async (error) => {
    const config = error?.config

    if (error?.response?.status === 401 && !config?.sent) {
      config.sent = true

      const result = await memoizedRefreshToken()

      if (result?.access_token) {
        config.headers = {
          ...config.headers,
          authorization: `Bearer ${result?.access_token}`
        }
      }

      return axios(config)
    }
    return Promise.reject(error)
  }
)

export const axiosPrivate = axios
