import axios from 'axios'
import { API_URLS } from '../api-urls'

export const axiosThirdParty = axios.create({
  baseURL: `${API_URLS.uploader_service}`
})
