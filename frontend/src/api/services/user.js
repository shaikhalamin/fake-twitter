import { axiosPrivate } from '../lib/axios-private'
import { axiosPublic } from '../lib/axios-public'

export const getUsers = async () => {
  return axiosPrivate.get('/users', {
    headers: {
      'Content-Type': 'application/json'
    }
  })
}

export const createUser = async (userPayload) => {
  return axiosPublic.post('/users', userPayload, {
    headers: {
      'Content-Type': 'application/json'
    }
  })
}

export const updateUser = async (
  id,
  userPayload
) => {
  return axiosPrivate.patch(`/users/${id}`, userPayload, {
    headers: {
      'Content-Type': 'application/json'
    }
  })
}

export const getUser = async (id) => {
  return axiosPrivate.get(`/users/${id}`, {
    headers: {
      'Content-Type': 'application/json'
    }
  })
}

export const deleteUser = async (id) => {
  return axiosPrivate.delete(`/users/${id}`)
}
