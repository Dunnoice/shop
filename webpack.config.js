const path = require('path');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	mode: 'development',
	entry: {
		default: path.resolve(__dirname, './src/AppBundle/Resources/css/default.css'),
		form: path.resolve(__dirname, './src/AppBundle/Resources/css/form.css'),
	},
	output: {
		path: path.resolve(__dirname, 'web/assets/'),
	},
	/*// Extracting all CSS in a single file
	optimization: {
		splitChunks: {
			cacheGroups: {
				styles: {
					name: 'styles',
					test: /\.css$/,
					chunks: 'all',
					enforce: true,
				},
			},
		},
	},*/
	plugins: [
		new CleanWebpackPlugin(),
		new MiniCssExtractPlugin({
			filename: '[name].css',
		}),
	],
	module: {
		rules: [
			{
				test: /\.css$/,
				use: [
					// 'style-loader',
					MiniCssExtractPlugin.loader,
					'css-loader',
				]
			}
		]
	}
};
