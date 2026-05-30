#!/bin/bash
set -e

echo "Starting Wibet Docker containers..."
docker-compose up -d

echo "Waiting for MySQL to be healthy..."
until docker-compose exec -T db mysqladmin ping -h localhost --silent; do
  sleep 2
done

echo "Mirroring production DB to staging..."
docker-compose exec -T db bash -c \
  "mysqldump -uroot -proot yii2basic | mysql -uroot -proot yii2basic_staging"
echo "Staging DB ready (yii2basic_staging)"

echo "Installing PHP dependencies..."
docker-compose exec -T web composer install --no-interaction

echo ""
echo "Wibet is running at: http://localhost"
echo ""
echo "MySQL:"
echo "   Production DB : yii2basic"
echo "   Staging DB    : yii2basic_staging"
echo "   User          : yii2user / yii2password"
echo "   Switch DB     : Admin > Users page > Switch button"
echo ""
echo "Useful commands:"
echo "   Logs          : docker-compose logs -f"
echo "   MySQL shell   : docker-compose exec db mysql -u yii2user -p yii2basic"
echo "   Stop          : docker-compose down"
