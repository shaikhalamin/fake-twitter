import { axiosThirdParty } from '../lib/axios-thirdparty'

export const preparefileUpload = (file) => {
  const formData = new FormData()
  formData.append('type', 'user')
  formData.append('size', 'md')
  formData.append('fileName', file)
  return formData
}

export const uploadFile = async (formData) => {
  return axiosThirdParty.post('/storage-file', formData, {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'multipart/form-data'
    }
  })
}
