/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  safelist: [
    'bg-blue-500',
    'hover:bg-blue-700',
    'bg-gray-500',
    'hover:bg-blue-700'
  ],
  theme: {
  },
  plugins: [],
}