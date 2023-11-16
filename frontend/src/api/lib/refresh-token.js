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
          RefreshToken: `${userSession?.refresh_token}`
        }
      }
    )
    const newSession = response.data

    if (!newSession?.access_token) {
      localStorage.removeItem('session')
    }

    localStorage.setItem('session', JSON.stringify(newSession))

    return newSession
  } catch (error) {
    console.log('Axios error data fetching ..', error)
    console.log('userSession', userSession)
    return userSession // refreshTokenFn()
  }
}

const maxAge = 1000000

export const memoizedRefreshToken = mem(refreshTokenFn, {
  maxAge
})
