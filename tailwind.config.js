export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.jsx',
    './app/Filament/**/*.php',
  ],
  theme: {
    extend: {
      colors: {
        accent: {
          cyan: '#22d3ee',
          purple: '#7c3aed',
          gold: '#f59e0b',
        },
      },
    },
  },
  plugins: [],
};
