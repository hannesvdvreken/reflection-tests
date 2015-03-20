#! /bin/bash

## Ubuntu
sudo locale-gen UTF-8


## Install PHP itself

sudo echo "deb http://ppa.launchpad.net/ondrej/php5-5.6/ubuntu trusty main"      > /etc/apt/sources.list.d/php.list
sudo echo "deb-src http://ppa.launchpad.net/ondrej/php5-5.6/ubuntu trusty main" >> /etc/apt/sources.list.d/php.list
sudo apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 14aa40ec0831756756d7f66c4f4ea0aae5267a6c

sudo apt-get update

sudo apt-get install php5=5.6.6+dfsg-1+deb.sury.org~trusty+1 -y


## Install PHPBrew

sudo apt-get install git-core -y

curl -L -O https://github.com/phpbrew/phpbrew/raw/master/phpbrew
chmod +x phpbrew
sudo mv phpbrew /usr/local/bin/phpbrew

phpbrew init

echo "source ~/.phpbrew/bashrc" >> /home/vagrant/.profile


## Install PHP versions.
sudo apt-get install -y libxslt-dev libreadline6-dev libmcrypt-dev libicu-dev libbz2-dev libssl-dev libxml2-dev build-essential

phpbrew -d install 5.3.29 +default
phpbrew -d install 5.4.38 +default
phpbrew -d install 5.5.22 +default
phpbrew -d install 5.6.6  +default


## Install composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer