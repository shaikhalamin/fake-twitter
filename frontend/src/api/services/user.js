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

export const updateUser = async (id, formData) => {
  return axiosPrivate.post(`/users/${id}`, formData, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  })
}

export const prepareFormData = (userPayload) => {
  console.log('userpayload', userPayload)
  const { name, bio, location, avatar } = userPayload
  const formData = new FormData()
  name && formData.append('name', name)
  bio && formData.append('bio', bio)
  location && formData.append('location', location)
  avatar && formData.append('avatar', avatar)
  formData.append('_method', 'PUT')

  return formData
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
