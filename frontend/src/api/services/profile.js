import { axiosPrivate } from '../lib/axios-private'

export const getUserProfile = async (username) => {
  return axiosPrivate.get(`/profiles/${username}`, {
    headers: {
      'Content-Type': 'application/json'
    }
  })
}
