import mem from 'mem'
import { axiosPublic } from './axios-public'

const refreshTokenFn = async () => {
  const userSession = JSON.parse(localStorage.getItem('session'))

  try {
    const response = await axiosPublic.post(
      '/auth/refresh',
      {},
      {
        headers: {
          Authorization: `Bearer ${userSession?.refresh_token}`
        }
      }
    )

    const newSession = response.data

    if (!newSession?.access_token) {
      localStorage.removeItem('session')
      localStorage.removeItem('user')
    }

    localStorage.setItem('session', JSON.stringify(newSession))

    return newSession
  } catch (error) {
    localStorage.removeItem('session')
    localStorage.removeItem('user')
  }
}

const maxAge = 10000

export const memoizedRefreshToken = mem(refreshTokenFn, {
  maxAge
})
