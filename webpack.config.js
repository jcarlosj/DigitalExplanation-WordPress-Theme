//  webpack.config.js
const
    path = require( 'path' ),
    MiniCssExtractPlugin = require( 'mini-css-extract-plugin' ),
    { CleanWebpackPlugin } = require( 'clean-webpack-plugin' ),
    OptimizeCssAssetsPlugin = require( 'optimize-css-assets-webpack-plugin' ),
    cssnano = require( 'cssnano' ), // https://cssnano.co/
    UglyfyJsWebpackPlugin = require( 'uglifyjs-webpack-plugin' ),
    GoogleFontsPlugin = require( "@beyonk/google-fonts-webpack-plugin" );

//  Rutas de archivos
const
    JS = path .resolve( __dirname + '/assets/src/js' ),
    IMG = path .resolve( __dirname + '/assets/src/images' ),
    BUILD = path .resolve( __dirname + '/assets/build' );

//  Reglas
const rules = [
    {
        test: /\.js$/,
        include: [ JS ],
        exclude: /node_modules/,
        use: 'babel-loader'
    },
    {
		test: /\.(sa|sc|c)ss$/,
		exclude: /node_modules/,
		use: [
            //  Respalda al cargador de estilo en desarrollo
			MiniCssExtractPlugin.loader,
			'css-loader',
			'sass-loader',
		]
	},
    {
        test: /\.(png|jpg|svg|jpeg|gif|ico)$/,
        use: {
            loader: 'file-loader',
            options: {
                name: 'images/[name].[ext]',        //  Elimina [path], este asume que la ruta del punto de entrada será la misma para la salida (por eso lo eliminamos)
                publicPath: 'production' === process .env .NODE_ENV ? '../' : '../../'
            }
        }
    },
    {
		test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
		exclude: [ IMG, /node_modules/ ],
		use: {
			loader: 'file-loader',
			options: {
				name: '[path][name].[ext]',
				publicPath: 'production' === process.env.NODE_ENV ? '../' : '../../'
			}
		}
	}
];

//  Complementos - Nota: argv.mode devolverá 'development' o 'production'.
const plugins = ( argv ) => [
    new CleanWebpackPlugin( {
        cleanStaleWebpackAssets: ( 'production' === argv .mode  )    //  Elimina automáticamente todos los activos de paquete web no utilizados en la reconstrucción, cuando se establece en verdadero en producción. ( https://www.npmjs.com/package/clean-webpack-plugin#options-and-defaults-optional )
    } ),
    new MiniCssExtractPlugin( {
        filename: 'css/[name].css'
    } ),
    new GoogleFontsPlugin({
        fonts: [
            {
                family: "Lato",
                formats: [ "eot", "woff", "woff2", "ttf", "svg" ],
                variants: [ "300", "300italic", "regular", "italic", "700italic" ]
            }
        ],
        path: 'fonts',
        filename: 'fonts/fonts.css'
    })
];

module .exports = ( env, argv ) => ({
    entry: {
        main: JS + '/main.js'
    },
    output: {
        path: BUILD,
        filename: 'js/[name].js'
    },
    devtool: 'source-map',                  //  Genera mapas de origen
    module: {
        rules: rules
    },
    optimization: {
        minimizer: [                        //  Anula el minimizador predeterminado al proporcionar una o más instancias personalizadas diferentes
            new OptimizeCssAssetsPlugin( {  //  Complemento de Webpack para optimizar archivos CSS
                cssProcessor: cssnano       //  Formatea y minifica CSS
            } ),
            new UglyfyJsWebpackPlugin( {    //  Minimiza JavaScript.
                cache: false,               //  Desactiva el almacenamiento en caché de archivos (path: node_modules/.cache/uglifyjs-webpack-plugin).
                parallel: true,             //  Activa la ejecución en paralelo de múltiples procesos.
                sourceMap: false            //  Desactiva la generacion de mapas de origen de UglyfyJsWebpackPlugin
            } )
        ]
    },
    plugins: plugins( argv ),
    externals: {
        jquery: 'jQuery'
    }
});
