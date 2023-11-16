import { axiosPrivate } from '../lib/axios-private'

export const likeTweet = async (likePayload) => {
  return axiosPrivate.post('/likes', likePayload, {
    headers: {
      'Content-Type': 'application/json'
    }
  })
}
