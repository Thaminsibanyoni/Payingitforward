module.exports = {
  presets: [
    [
      'react-app',
      {
        runtime: 'automatic',
        development: process.env.NODE_ENV === 'development'
      }
    ]
  ],
  plugins: [
    [
      '@babel/plugin-transform-private-property-in-object',
      {
        loose: true
      }
    ]
  ]
};
