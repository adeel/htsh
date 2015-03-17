# Requirements #

Your web server must have PHP5 (PHP4 has not been tested, but it might work, probably with a few minor changes) and [PEAR](http://pear.php.net). Currently, the only browser supported is Mozilla Firefox 2.0 (it might work on others). This will improve in future releases.

# Installation #

  1. Unzip the htsh archive and upload it via FTP to your server (or get it there some other way).
  1. Rename config.php.default to config.php and change the default username, password, and home directory.
  1. The web user must be able to write to your files, so you may need to chmod your web directory for htsh to work properly.

# Notes #

In this release, **encryption has not been implemented**. Therefore, it is highly recommended that you only access htsh through SSL (i.e. https://yourserver/path/to/htsh/). If your server does not have SSL, keep an eye out for the next release :).