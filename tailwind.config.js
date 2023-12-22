/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    screens: {
      desktop: '1300px',
      laptop: '992px',
      tablet: '768px',
      phone: '600px'
    },

    extend: {
        animation: {
             spin: "spin 1.5s linear infinite",
             pulse: "pulse 1.5s linear infinite",
        },
        fontFamily: {
            poppins: ['Poppins'],
        },
    },
  },
  plugins: [],
}
