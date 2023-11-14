import { axiosPublic } from '../lib/axios-public'

export const login = async (loginData) => {
  return axiosPublic.post('/auth/login', loginData)
}
