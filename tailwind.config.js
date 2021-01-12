module.exports = {
  purge: [
     './resources/views/components/series-cast.blade.php',
     './resources/views/components/single-movie.blade.php',
     './resources/views/components/single-season.blade.php',
     './resources/views/components/single-show.blade.php',
     './resources/views/layouts/app.blade.php',
     './resources/views/all_seasons.blade.php',
     './resources/views/cast_crew.blade.php',
     './resources/views/movies.blade.php',
     './resources/views/partial.blade.php',
     './resources/views/partialsearch.blade.php',
     './resources/views/peoples.blade.php',
     './resources/views/search_results.blade.php',
     './resources/views/single_season.blade.php',
     './resources/views/single_show.blade.php',
     './resources/views/singlemovie.blade.php',
     './resources/views/singlepeople.blade.php',
     './resources/views/tvshows.blade.php',
  ],
  darkMode: 'class', // or 'media' or 'class'
  theme: {
    screens: {
        'xxs': '349px',
        // => @media (min-width: 350px) { ... }
        'xs': '414px',
        // => @media (min-width: 414px) { ... }
        
        'sm': '640px',
        // => @media (min-width: 640px) { ... }

        'md': '768px',
        // => @media (min-width: 768px) { ... }

        'lg': '1024px',
        // => @media (min-width: 1024px) { ... }

        'xl': '1280px',
        // => @media (min-width: 1280px) { ... }

    //    '2xl': '1536px',
    //    // => @media (min-width: 1536px) { ... }
    },
    extend: {
        
        colors:{
            lightblue:'color.lightBlue',
        }
    },
  },
  variants: {
    extend: {
    },
  },
  plugins: [],
}
