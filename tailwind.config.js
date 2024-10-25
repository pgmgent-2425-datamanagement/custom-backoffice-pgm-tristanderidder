/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './views/**/*.php'
  ],
  theme: {
    extend: {
      colors: {
        'primary': 'rgba(200, 222, 250, 1)',
        'secondary': 'rgba(199, 218, 229, 1)',
        'tertiary': 'rgba(0, 0, 0, 1)',
      },
    },
  },
  plugins: [],
}

