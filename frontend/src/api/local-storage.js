export const getLocalSession = () => {
  const session = JSON.parse(localStorage.getItem('session'))
  return session
}

export const removeLocalSession = () => {
  localStorage.removeItem('session')
}
