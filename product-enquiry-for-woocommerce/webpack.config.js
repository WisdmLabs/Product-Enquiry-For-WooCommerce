process.traceDeprecation = true;
var ExtractTextPlugin = require("extract-text-webpack-plugin");
const path = require('path');
var webpack = require('webpack');

const config =[ {
  entry: {
    'main':'./assets/admin/js/main.js',
    'notice':'./assets/admin/js/notice.js',
    'wdm_subme':'./assets/admin/js/wdm_subme.js',    
    'settings':'./assets/admin/js/settings.js'
  },
  output: {
    path: path.resolve(__dirname, 'assets/admin/js/dist'),
    filename: '[name].min.js'
  },
  module: {
        rules: [
            //for es6 and react support
            {
              test: /.jsx?$/,
              loader: 'babel-loader',
              exclude: /node_modules/,
              query: {
                presets: ['es2015']
              }
            },

            //loader for sass support
            {
              test: /\.scss$/,
              loaders: ExtractTextPlugin.extract(
                {
                  fallback:"style-loader",
                  use:[
                    'css-loader',
                    {loader: 'postcss-loader', options: {zindex: false}},
                    'sass-loader'
                  ]
                }
              )
            },
            { test: /\.(png|woff|woff2|eot|ttf|svg)$/, loader: 'url-loader?limit=100000' }
        ]
    },
    plugins: [
        //webpack plugin that creates a new css file in specified directory
        new ExtractTextPlugin("../../css/[name].css"),
        new webpack.ProvidePlugin({
            "Tether": 'tether',
            Popper: ['popper.js', 'default']
        }),

    ],
    optimization: {
                minimize: true //Update this to true or false
    },
},
{
  entry: {
    'enquiry_validate':'./assets/public/js/enquiry_validate.js',
      },
  output: {
    path: path.resolve(__dirname, 'assets/public/js/dist'),
    filename: '[name].min.js'
  },
  module: {
        rules: [
            //for es6 and react support
            {
              test: /.jsx?$/,
              loader: 'babel-loader',
              exclude: /node_modules/,
              query: {
                presets: ['es2015']
              }
            },

            //loader for sass support
            {
              test: /\.scss$/,
              loaders: ExtractTextPlugin.extract(
                {
                  fallback:"style-loader",
                  use:[
                    'css-loader',
                    {loader: 'postcss-loader', options: {zindex: false}},
                    'sass-loader'
                  ]
                }
              )
            },
            { test: /\.(png|woff|woff2|eot|ttf|svg)$/, loader: 'url-loader?limit=100000' }
        ]
    },
    plugins: [
        //webpack plugin that creates a new css file in specified directory
        new ExtractTextPlugin("../../css/[name].css"),
        new webpack.ProvidePlugin({
            "Tether": 'tether',
            Popper: ['popper.js', 'default']
        }),

    ],
    optimization: {
                minimize: true //Update this to true or false
    },
}];

module.exports = config;

