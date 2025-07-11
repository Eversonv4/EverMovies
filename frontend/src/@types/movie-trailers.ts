export type MovieTrailers = {
  id: number
  results: {
    id: string
    iso_639_1: string
    iso_3166_1: string
    key: string
    name: string
    site: string
    size: number
    type: string
  }[]
  total_pages?: number,
  total_results?: number
}