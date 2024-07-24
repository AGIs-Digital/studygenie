const FtpDeploy = require('ftp-deploy');
const ftpDeploy = new FtpDeploy();

const config = {
  user: process.env.FTP_USERNAME,
  password: process.env.FTP_PASSWORD,
  host: process.env.FTP_SERVER,
  port: 22, // Standard SFTP Port
  localRoot: __dirname,
  remoteRoot: '/',
  deleteRemote: false,
  include: [
    '.env',
    'app/**',
    'artisan',
    'bootstrap/**',
    'composer.json',
    'composer.lock',
    'config/**',
    'database/**',
    'lang/**',
    'public/**',
    'public/.htaccess',
    'resources/**',
    'routes/**',
    'storage/**',
    'storage/framework/cache/**',
    'storage/framework/sessions/**',
    'storage/framework/testing/**',
    'storage/framework/views/**',
    'storage/logs/**'
  ],
  exclude: [
    '.env.example',
    '.git/**',
    '.github/**',
    '.vite.config.js',
    '.webpack.mix.js',
    '*.git',
    'dist/**/*.map',
    'node_modules/**',
    'README.md',
    'tests/**',
    'vendor/**'
  ],
  sftp: true
};

// ftpDeploy.on("uploading", function (data) {
//     console.log(data.totalFilesCount); // total file count being transferred
//     console.log(data.transferredFileCount); // number of files transferred
//     console.log(data.filename); // partial path with filename being uploaded
// });

ftpDeploy.on('uploaded', function (data) {
  console.log(
    '✅ ' + data.filename + ' (' + data.transferredFileCount + ' / ' + data.totalFilesCount + ')'
  );
});

ftpDeploy.on('upload-error', function (data) {
  console.log('❌ '.data.err); // data will also include filename, relativePath, and other goodies
});

ftpDeploy.deploy(config, function (err) {
  if (err) console.log(err);
  else console.log('finished');
});
