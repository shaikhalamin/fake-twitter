export const API_BASE = process.env.VUE_APP_API_BASE || 'http://localhost:9000'
export const FE_BASE = process.env.VUE_APP_FE_BASE || 'http://localhost:7890'
export const UPLOADER_SERVICE =
  process.env.VUE_APP_UPLOADER_SERVICE || 'http://localhost:9000'

export const API_URLS = {
  base_url: API_BASE,
  frontend_base: FE_BASE,
  images_url: `${API_BASE}/assests`,
  uploader_service: UPLOADER_SERVICE
}
