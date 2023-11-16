export const getLocalSession = () => {
  const session = JSON.parse(localStorage.getItem('session'))
  return session
}

export const removeLocalSession = () => {
  localStorage.removeItem('session')
}

export const setUserSession = (newSession) => {
  localStorage.setItem('session', JSON.stringify(newSession))
  return getLocalSession()
}

export const updateLocalSession = (updatedSession) => {
  const session = JSON.parse(localStorage.getItem('session'))
  const update = Object.assign(session, { ...updatedSession })
  setUserSession(update)
  return getLocalSession()
}
