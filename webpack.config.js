const path = require('path');

module.exports = {
  output: {
    filename: 'my-first-webpack.bundle.js',
  },
  module: {
    rules: [
	{
		test: /\.jsx?$/,
    exclude: /node_modules/,
    loader: 'babel-loader',
    options: {
      presets: ['@babel/preset-env', '@babel/preset-react'],
    },
	}
	],
  },
};