#!/bin/bash
set -e

echo "🐳 Starting Wibet Docker containers with Colima..."
docker-compose up -d

echo "⏳ Waiting for MySQL to be healthy..."
sleep 10

echo "📦 Installing PHP dependencies..."
docker-compose exec -T web composer install --no-interaction

echo "✅ Docker containers are running!"
echo ""
echo "📍 Access your application at: http://localhost"
echo ""
echo "📊 MySQL connection details:"
echo "   Host: localhost (or 'db' from within containers)"
echo "   Port: 3306"
echo "   User: yii2user"
echo "   Password: yii2password"
echo "   Database: yii2basic"
echo ""
echo "💡 Useful commands:"
echo "   View logs: docker-compose logs -f"
echo "   Run migrations: docker-compose exec web php yii migrate"
echo "   MySQL shell: docker-compose exec db mysql -u yii2user -p yii2basic"
echo "   Stop: docker-compose down"
