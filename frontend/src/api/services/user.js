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
      Accept: 'application/json',
      'Content-Type': 'multipart/form-data'
    }
  })
}

export const prepareFormData = (userPayload) => {
  const { name, bio, location, avatar } = userPayload
  const formData = new FormData()
  name.length > 0 && formData.append('name', name)
  bio.length > 0 && formData.append('bio', bio)
  location.length > 0 && formData.append('location', location)
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

export const searchUsers = async (query) => {
  return axiosPrivate.get(`/users/search?q=${query}`, {
    headers: {
      'Content-Type': 'application/json'
    }
  })
}
