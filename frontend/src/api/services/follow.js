import { axiosPrivate } from '../lib/axios-private'

export const followUser = async (followPayload) => {
  return axiosPrivate.post('/follows', followPayload, {
    headers: {
      'Content-Type': 'application/json'
    }
  })
}
