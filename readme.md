# Testing the performance impact of Reflection

## How

This repo is the code I used to test the performance impact of [Reflection](http://php.net/manual/en/book.reflection.php) across different versions of PHP.
The [Vagrantfile](https://github.com/hannesvdvreken/reflection-tests/blob/master/Vagrantfile) provided runs
a [shell script](https://github.com/hannesvdvreken/reflection-tests/blob/master/provisioning/provision.sh)
that installs [phpbrew](http://phpbrew.github.io/phpbrew/) to be able to switch between different versions of PHP (5.3 till 5.6).

Use `phpbrew switch php-5.3.29` to switch the PHP version. Use `php --version` to check your current version.

## Box

The box is a 64 bit installation of Ubuntu's Trusty Thar (14.04) distribution.

## Test suite

The test suite is run by executing `php run.php` in the `/vagrant` folder.
Make sure the dependencies are installed by running `composer install`.

## Results

My results can be found [here](https://gist.github.com/hannesvdvreken/5d2341a91e76614f80ad).
