/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
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
