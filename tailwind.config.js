module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Http/Controllers/*.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('tailwind-scrollbar')
  ],
}
