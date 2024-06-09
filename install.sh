#!/usr/bin/env sh

set -xe

echo "- Reset the database"
rm -fr ./public/content/database && echo "Success: database deleted successfuly."

echo "- Make sure db dropin is presented"
composer run install:db

echo "- Install core wordpress"
wp core install --admin_user=admin --admin_password=password --admin_email=admin@example.com --skip-email --url=http://litepress.test --title=WordPress


echo "- Install and activate extendable"
wp theme install extendable --activate

echo "- Install and activate query-monitor & disable-updates"
wp plugin install query-monitor disable-updates --activate

echo "- Delete old files"
rm -fr ./public/content/{uploads,upgrade,upgrade-temp-backup,debug.log}