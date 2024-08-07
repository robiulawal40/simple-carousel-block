/* eslint-disable no-undef */
const fs = require( 'fs' );
const path = require( 'path' );

const MiniCSSExtractPlugin = require( 'mini-css-extract-plugin' );


const defaultConfig = require("./node_modules/@wordpress/scripts/config/webpack.config");

const WebpackShellPlugin = require('webpack-shell-plugin');

// console.log("testing : ", defaultConfig.module.rules);


let cssLoaders = defaultConfig.module.rules[2].use;

module.exports = {
  ...defaultConfig,
  // plugins:[...defaultConfig.plugins,  new WebpackShellPlugin({onBuildStart:['echo "Webpack Start"'], onBuildEnd:['echo "Webpack End"']})].filter( Boolean ),
  module: {
    ...defaultConfig.module,
    rules: [...defaultConfig.module.rules,
      // {
      //   test: /\.css$/,
      //   include: path.resolve(__dirname, 'src'),
      //   use: [...cssLoaders, 'style-loader', 'css-loader', 'postcss-loader'],
      // }
    ]
  }
}