module.exports = {
  purge: [],
  darkMode: 'class', // or 'media' or 'flase'
  theme: {
    screens: {
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

        '2xl': '1536px',
        // => @media (min-width: 1536px) { ... }
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
