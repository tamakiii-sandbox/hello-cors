const path = require("path");
const HTMLPlugin = require("html-webpack-plugin");
const WorkerPlugin = require("worker-plugin");

module.exports = {
  module: {
    rules: [
      {
        test: /\.tsx?$/,
        use: {
          loader: "ts-loader",
          options: {
            transpileOnly: true,
          },
        },
      },
      {
        test: /\.css$/i,
        use: ["style-loader", "css-loader"]
      },
    ],
  },
  entry: {
    main: path.join(__dirname, "src/index.tsx"),
  },
  output: {
    filename: '[name].js',
    path: path.join(__dirname, "dist"),
    publicPath: "/dist/"
  },
  resolve: {
    extensions: [".js", ".ts", ".tsx", ".json", ".mjs", ".wasm"],
  },
  devServer: {
    host: '0.0.0.0',
    port: 8888,
    sockPort: 8080,
    sockPath: '/dist/sockjs-node',
    disableHostCheck: true,
  },
  plugins: [
    new HTMLPlugin({
      template: path.join(__dirname, "src/index.html"),
    }),
    new WorkerPlugin()
  ],
};