import { axiosPrivate } from '../lib/axios-private'

export const followUser = async (followPayload) => {
  return axiosPrivate.post('/follows', followPayload, {
    headers: {
      'Content-Type': 'application/json'
    }
  })
}

export const followingFollowerList = async () => {
  return axiosPrivate.get('/follows/list/following-follower', {
    headers: {
      'Content-Type': 'application/json'
    }
  })
}
