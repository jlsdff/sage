/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php}"],
  theme: {
    fontFamily: {
      body: ["Jost", "sans-serif"],
    },
    extend: {
      colors: {
        primary: {
          100: "#3b5326",
          200: "#223017"
        }
      }
    },
  },
  plugins: [],
};
