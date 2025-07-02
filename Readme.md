<h1 align="center">🧪 EverMovies</h1>

<img src="https://img.shields.io/static/v1?label=EverMovies&message=Fullstack+Web&color=10B981&style=for-the-badge&logo=GHOST">

<h2>✅ Get Started</h2>

Before installing any dependencies, it is important to make sure that you have `Node` installed on your computer with version `^20.18.3` or superior.

To avoid conflict with the dependency manager it's recommended to use `NPM` as it has been used in development.

<h3>Technologies Used</h3>

<strong>Frontend</strong>

<ul>
  <li>Vue.js 3 + VITE</li>
  <li>Typescript</li>
  <li>SASS</li>
  <li>Swiper</li>
  <li>Axios</li>
  <li>Docker</li>
</ul>

<strong>Backend</strong>

<ul>
  <li>Laravel</li>
  <li>MySQL</li>
  <li>Docker</li>
</ul>

<h3>Get your API KEY</h3>

<ol>
  <li>First of all you gonna need to enter the <a href="https://www.themoviedb.org">The Movie Database</a> website and register a free account. After filling your data you have to access the initial page <code>https://www.themoviedb.org/u/&lt;your_user_name&gt;</code></li>
  <li>There is an option called <code>Visão Geral</code> which is a drop-down menu and as you pass the mouse over that it shows the option <code>Editar Perfil</code>, then you click on it.</li>
  <li>You'll be redirected to the settings page. The menu on the left will show an option <code>API</code>. Select the API option and it gonna show your access token <code>"Token de Leitura da API"</code> and the api key <code>"Chave da API"</code>.</li>
</ol>

<h3>Setup the project</h3>

The project was divided in two folders "backend" and "frontend". Inside each folder has an ".env.example" file. Copy that file and rename it to only ".env".

Take your API KEY you get from the The Movie Database website and paste it in the property "TMDB_API_KEY" on the .env file inside the "backend" folder.

```
/backend/.env

...
TMDB_API_KEY=your_api_key_abc123
...
```

The `.env` file inside the "frontend" folder you can just keep the way it is.

Now both folders (backend and frontend) has a `.env` file and the api key is configured.

<h3>Running the project</h3>

Open your terminal inside the root folder and run:

```
docker-compose up --build
```

Wait a few minutes and the project will build. When the project is ready you'll see something like this:

```
laravel-app  |    INFO  Server running on [http://0.0.0.0:8000].
laravel-app  |
laravel-app  |   Press Ctrl+C to stop the server
laravel-app  |
vite-app     |   VITE v7.0.0  ready in 13497 ms
vite-app     |
vite-app     |   ➜  Local:   http://localhost:5173/
vite-app     |   ➜  Network: http://172.18.0.3:5173/
vite-app     |   ➜  Vue DevTools: Open http://localhost:5173/__devtools__/ as a separate window
vite-app     |   ➜  Vue DevTools: Press Alt(⌥)+Shift(⇧)+D in App to toggle the Vue DevTools
```

Now you can open the URL `http://localhost:5173/` in your browser.

<h3>Preview</h3>

<h4>Home</h4>

<img src="https://raw.githubusercontent.com/Eversonv4/EverMovies/refs/heads/main/frontend/public/preview.png" />

<h4>Movies</h4>

<img src="https://raw.githubusercontent.com/Eversonv4/EverMovies/refs/heads/main/frontend/public/movies.png" />

<h4>TV Series</h4>

<img src="https://raw.githubusercontent.com/Eversonv4/EverMovies/refs/heads/main/frontend/public/tv-series.png" />

<h4>Favorites</h4>

<img src="https://raw.githubusercontent.com/Eversonv4/EverMovies/refs/heads/main/frontend/public/favorites.png" />