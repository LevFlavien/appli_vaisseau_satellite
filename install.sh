#!bin/sh

echo Vérification de la version PHP...
phpv=`php -v | head -1 | cut -d " " -f 2`

if [[ $phpv =~ [^7]\.[0-9]\.[0-9] ]]
then
	echo 'Version 7 requise'.
	exit;
fi
echo Ok

# getting code
echo Récupération du projet...
curl https://codeload.github.com/LevFlavien/appli_vaisseau_satellite/tar.gz/release -o satellite.tar.gz
tar -zxvf satellite.tar.gz
rm satellite.tar.gz
cd appli_vaisseau_satellite-release
rm install.sh

# composer installation
echo Installation de composer...
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

# project install
composer.phar install

# .env
echo Generation du fichier .env...

mv .env.example .env

#pwd=$({ echo "DB_DATABASE=";pwd; } | tr "\n" " " | tr -d ' ')
#echo $pwd
#sed "/DB_DATABASE=*/c\\$pwd" .env.example > .env

php artisan key:generate

# Database install
echo Migration de la base de donnéees...
touch database/database.sqlite
php artisan migrate