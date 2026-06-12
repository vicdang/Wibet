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
        // Brand Colors - Sports/Gaming Vibrant
        brand: {
          primary: '#00d4ff',    // Cyan - energetic
          secondary: '#7b2fff',  // Purple - premium
          accent: '#ff6b9d',     // Pink - exciting
          success: '#00ff88',    // Green - wins
          warning: '#ffb800',    // Orange - caution
          danger: '#ff4444',     // Red - critical
        },
        // Dark Theme - Gaming Dashboard
        dark: {
          bg: '#0a0e1a',         // Deep black
          card: '#1a1f35',       // Card background
          border: '#2d3748',     // Border color
          hover: '#243056',      // Hover state
        },
        // Team Colors (for badges/tiers)
        tier: {
          diamond: '#ff6b9d',    // Pink
          platinum: '#c0c0c0',   // Silver
          gold: '#ffd700',       // Gold
          silver: '#b8b8b8',     // Silver
        }
      },
      backgroundImage: {
        'gradient-brand': 'linear-gradient(135deg, #00d4ff 0%, #7b2fff 100%)',
        'gradient-gaming': 'linear-gradient(135deg, #ff6b9d 0%, #00d4ff 100%)',
        'gradient-success': 'linear-gradient(135deg, #00ff88 0%, #00d4ff 100%)',
        'gradient-dark-card': 'linear-gradient(135deg, #1a1f35 0%, #243056 100%)',
      },
      boxShadow: {
        'brand': '0 8px 32px rgba(0, 212, 255, 0.15)',
        'gaming': '0 12px 40px rgba(255, 107, 157, 0.12)',
        'glow': '0 0 20px rgba(0, 212, 255, 0.3)',
      },
      fontSize: {
        'xs': ['0.75rem', { lineHeight: '1rem' }],
        'sm': ['0.875rem', { lineHeight: '1.25rem' }],
        'base': ['1rem', { lineHeight: '1.5rem' }],
        'lg': ['1.125rem', { lineHeight: '1.75rem' }],
        'xl': ['1.25rem', { lineHeight: '1.75rem' }],
        '2xl': ['1.5rem', { lineHeight: '2rem' }],
        '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
        '4xl': ['2.25rem', { lineHeight: '2.5rem' }],
      },
      animation: {
        'pulse-brand': 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
        'glow': 'glow 2s ease-in-out infinite',
        'slide-up': 'slideUp 0.3s ease-out',
        'bounce-light': 'bounce 1s ease-in-out infinite',
      },
      keyframes: {
        glow: {
          '0%, 100%': { 'box-shadow': '0 0 20px rgba(0, 212, 255, 0.3)' },
          '50%': { 'box-shadow': '0 0 40px rgba(0, 212, 255, 0.6)' },
        },
        slideUp: {
          '0%': { opacity: '0', transform: 'translateY(20px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
      }
    },
  },
  plugins: [],
}
