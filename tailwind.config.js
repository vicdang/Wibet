/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./views/**/*.{php,js}",
    "./web/**/*.{php,js}",
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: {
          dark: '#0a0e1a',
          light: '#f8f9fa',
        },
        text: {
          primary: '#e8eaf0',
          secondary: 'rgba(232, 234, 240, 0.7)',
        },
        border: {
          dark: 'rgba(0, 212, 255, 0.15)',
          light: 'rgba(0, 0, 0, 0.1)',
        },
        accent: {
          cyan: '#00d4ff',
          purple: '#7b2fff',
          blue: '#1f73e6',
        }
      },
      backgroundImage: {
        'gradient-cyan': 'linear-gradient(135deg, #00d4ff, #7b2fff)',
        'gradient-orange': 'linear-gradient(135deg, rgba(255, 193, 7, 0.08) 0%, rgba(255, 140, 0, 0.08) 100%)',
      }
    },
  },
  plugins: [],
}
