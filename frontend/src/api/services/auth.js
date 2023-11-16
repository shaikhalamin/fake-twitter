import { axiosPrivate } from '../lib/axios-private'
import { axiosPublic } from '../lib/axios-public'

export const login = async (loginData) => {
  return axiosPublic.post('/auth/login', loginData)
}

export const authLogOut = async () => {
  return axiosPrivate.post('/auth/logout')
}
