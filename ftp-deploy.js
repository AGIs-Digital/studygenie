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

ftpDeploy.deploy(config, function(err) {
  if (err) console.log(err);
  else console.log("finished");
});
