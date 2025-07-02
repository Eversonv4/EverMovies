import type { ParamsProps } from "@/@types/params-props";
import axiosClient from "./axiosClient";
import type { MovieTrailers } from "@/@types/movie-trailers";
import type { CastingProps } from "@/@types/casting";
import type { MovieItem } from "@/@types/movie-item";

export const category = {
  movie: "movie",
  tv: "tv",
  favorites: "favorites",
} as const;

export const movieType = {
  upcoming: "upcoming",
  popular: "popular",
  top_rated: "top_rated",
} as const;

export const tvType = {
  popular: "popular",
  top_rated: "top_rated",
  on_the_air: "on_the_air",
} as const;

export type Category = (typeof category)[keyof typeof category];
export type MovieType = (typeof movieType)[keyof typeof movieType];
export type TvType = (typeof tvType)[keyof typeof tvType];

const tmdbApi = {
  getMoviesList: (
    type: MovieType,
    params: ParamsProps
  ): Promise<MovieTrailers> => {
    const url = "movie/" + movieType[type];
    return axiosClient.get(url, params);
  },
  getFavorites: (params: ParamsProps): Promise<MovieTrailers[]> => {
    const url = "favorites";
    return axiosClient.get(url, params);
  },
  addToFavorite: (movie: MovieItem): Promise<void> => {
    const url = "favorites";
    const body = { movie_id: movie.id, ...movie };
    return axiosClient.post(url, body);
  },
  removeFromFavorite: (movieId: number): Promise<void> => {
    const url = `favorites/${movieId}`;
    return axiosClient.delete(url);
  },
  getTvList: (type: TvType, params: ParamsProps): Promise<MovieTrailers> => {
    const url = "tv/" + tvType[type];
    return axiosClient.get(url, params);
  },
  getVideos: (cate: Category, id: string | number): Promise<MovieTrailers> => {
    const url = category[cate] + "/" + id + "/videos";
    return axiosClient.get(url, { params: {} });
  },
  search: (cate: Category, params: ParamsProps): Promise<MovieTrailers> => {
    const url = "search/" + category[cate];
    return axiosClient.get(url, params);
  },
  detail: (cate: Category, id: string | number, params: ParamsProps) => {
    const url = category[cate] + "/" + id;
    return axiosClient.get(url, params);
  },
  credits: (cate: Category, id: string | number): Promise<CastingProps> => {
    const url = category[cate] + "/" + id + "/credits";
    return axiosClient.get(url, { params: {} });
  },
  similar: (cate: Category, id: string | number): Promise<MovieTrailers> => {
    const url = category[cate] + "/" + id + "/similar";
    return axiosClient.get(url, { params: {} });
  },
};

export default tmdbApi;
