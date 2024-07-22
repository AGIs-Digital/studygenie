const FtpDeploy = require("ftp-deploy");
const ftpDeploy = new FtpDeploy();

const config = {
  user: process.env.FTP_USERNAME,
  password: process.env.FTP_PASSWORD,
  host: process.env.FTP_SERVER,
  port: 22, // Standard SFTP Port
  localRoot: __dirname,
  remoteRoot: "/",
  include: ["*", "**/*"],      // this would upload everything except dot files
  exclude: [
    "*.map",
    "node_modules/**",
    "node_modules/**/.*",
    ".git/**",
    "*.git",
    ".github",
    "*/**/*git*",
    ".gitignore",
    ".project",
    "README.md",
    ".env.example",
    ".vite.config.js",
    ".webpack.mix.js",
],
  sftp: true,
};

ftpDeploy.on("uploading", function (data) {
    console.log(data.totalFilesCount); // total file count being transferred
    console.log(data.transferredFileCount); // number of files transferred
    console.log(data.filename); // partial path with filename being uploaded
});

ftpDeploy.on("uploaded", function (data) {
    console.log("- " + data.filename + " (total files: " + data.totalFilesCount + ")"); // same data as uploading event
});

ftpDeploy.on("upload-error", function (data) {
    console.log(data.err); // data will also include filename, relativePath, and other goodies
});

ftpDeploy.deploy(config, function(err) {
  if (err) console.log(err);
  else console.log("finished");
});

