#!/usr/bin/env sh
echo "- Reset the database"
rm -fr ./public/content/database

echo "- Install core wordpress"
wp core install --admin_user=admin --admin_password=password --admin_email=admin@example.com --skip-email --url=http://litepress.test --title=WordPress


echo "- Install and activate extendable"
wp theme install extendable --activate

echo "- Install and activate query-monitor & disable-updates"
wp plugin install query-monitor disable-updates --activate

# echo "- Activate extendify"
# wp plugin activate extendify