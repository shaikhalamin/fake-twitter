import mem from 'mem'
import { axiosPublic } from './axios-public'
import {
  getLocalSession,
  removeLocalSession,
  updateLocalSession
} from '../local-storage'
import { FE_BASE } from '../api-urls'

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

    console.log('access token from refresh token', newSession)

    if (!newSession?.access_token) {
      removeLocalSession()
    }

    return updateLocalSession(newSession)
  } catch (error) {
    console.log('Axios error data fetching ..', error)
    removeLocalSession()
    window.location.href = FE_BASE
  }
}

const maxAge = 100000

export const memoizedRefreshToken = mem(refreshTokenFn, {
  maxAge
})
