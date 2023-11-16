import mem from 'mem'
import { axiosPublic } from './axios-public'
import {
  getLocalSession,
  removeLocalSession,
  updateLocalSession
} from '../local-storage'

const refreshTokenFn = async () => {
  const userSession = getLocalSession()

  try {
    const response = await axiosPublic.post(
      '/auth/refresh',
      {},
      {
        headers: {
          RefreshToken: `${userSession?.refresh_token}`
        }
      }
    )
    const newSession = response.data

    if (!newSession?.access_token) {
      removeLocalSession()
    }

    return updateLocalSession(newSession)
  } catch (error) {
    console.log('Axios error data fetching ..', error)
    removeLocalSession()
    window.location.href = 'http://localhost:7890'
  }
}

const maxAge = 1000000

export const memoizedRefreshToken = mem(refreshTokenFn, {
  maxAge
})
