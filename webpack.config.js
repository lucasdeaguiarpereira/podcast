const path = require('path');
const HtmlWebPackPlugin = require('html-webpack-plugin');



module.exports = {
    entry: './src/index.js',
    output:{
        path : path.join(__dirname, '/dist'),
        filename: 'index_bundle.js',
        publicPath: '/'
    },
    module:{
        rules:[
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use:{
                    loader:'babel-loader'
                }
            },
            { 
                test: /\.css$/, 
                loader: "style-loader!css-loader" 
            },
            {
                test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        outputPath: 'fonts/'
                    }
                }]
            }
        ]
    },
    devServer:{
        historyApiFallback: true,
    },
    plugins: [
        new HtmlWebPackPlugin({
            template:'./src/index.html'
        })
    ]
}