import { axiosPrivate } from '../lib/axios-private'

export const createTweet = async (tweetPayload) => {
  return axiosPrivate.post('/tweets', tweetPayload, {
    headers: {
      'Content-Type': 'application/json'
    }
  })
}

export const getTweets = async (page = 1) => {
  return axiosPrivate.get(`/tweets?page=${page}`, {
    headers: {
      'Content-Type': 'application/json'
    }
  })
}
