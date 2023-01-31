#! /usr/bin/env bash

read -p "Type '1' for composer update or '2' for composer install: " composerType
composerTypeUpdate=1
composerTypeInstall=2
if [ $composerType == $composerTypeUpdate ]
then
    echo "Updating composer packages."
    echo "..."
    echo `composer update`
    echo "..."
    echo "Composer packages have been updated."
elif [ $composerType == $composerTypeInstall ]
then
    echo "Installing composer packages."
    echo "..."
    echo `composer install`
    echo "..."
    echo "Composer packages have been installed."
fi

echo "Updating yarn packages."
echo "..."
echo `yarn install`
echo "..."
echo "Yarn packages have been updated."

echo "Optimizing cache."
echo "..."
echo `php artisan optimize:clear`
echo "..."
echo "Cache has been optimized."

read -p "Type '1' to migrate without seeds or '2' to include seeds: " seedType
excludeSeeds=1
includeSeeds=2
if [ $seedType == $excludeSeeds ]
then
    echo "Running migration without seeds."
    echo "..."
    echo `php artisan migrate:fresh`
    echo "..."
    echo "Migration without seeds completed."
elif [ $seedType == $includeSeeds ]
then
    echo "Running migration with seeds."
    echo "..."
    echo `php artisan migrate:fresh --seed`
    echo "..."
    echo "Migration with seeds completed."
fi
