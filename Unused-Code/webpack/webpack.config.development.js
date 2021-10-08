/**
 *
 * @file webpack.config.development.js
 * @author Charles Leverington
 */

const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	mode: 'development',
	devtool: 'source-map',
	watch: true,
	module: {
		rules: [
			{
				test: /\.scss$/,
				exclude: /node_modules/,
				use: [
					{
						loader: MiniCssExtractPlugin.loader,
						options: {
							publicPath: '../',
						},
					},
					{
						loader: 'css-loader',
						options: {
							sourceMap: true,
						},
					},
					{
						loader: 'postcss-loader',
						options: {
							sourceMap: true,
						},
					},
					{
						loader: 'sass-loader',
						options: {
							// Everyone prefers 'dart-sass'
							implementation: require('sass'),
							sassOptions: {
								sourceMap: true,
								precision: 10,
							},
						},
					},
				],
			},
		],
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: 'css/main.css',
		}),
	],
};

