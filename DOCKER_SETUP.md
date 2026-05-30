# Docker/Podman Setup for Wibet

This guide will help you run the Wibet Yii 2 application using Docker or Podman.

## Prerequisites

**Option 1: Podman (Lightweight, recommended for macOS)**
```bash
brew install podman podman-compose
podman machine init
podman machine start
```

**Option 2: Docker Desktop**
- Docker Desktop installed ([download here](https://www.docker.com/products/docker-desktop))
- Docker Compose (included with Docker Desktop)

## Quick Start

**Using the automated script (easiest):**
```bash
./docker-start.sh
```

**Or manually:**

1. **Build and start the containers:**
   ```bash
   podman-compose up -d
   # or: docker-compose up -d
   ```

2. **Install PHP dependencies (first time only):**
   ```bash
   podman-compose exec web composer install
   # or: docker-compose exec web composer install
   ```

3. **Run database migrations (if needed):**
   ```bash
   podman-compose exec web php yii migrate
   # or: docker-compose exec web php yii migrate
   ```

4. **Access your application:**
   - Web app: http://localhost
   - MySQL: localhost:3306

## Services

The `docker-compose.yml` defines three services:

- **nginx**: Web server (port 80)
- **web**: PHP-FPM application server
- **db**: MySQL 8.0 database (port 3306)

## Database Access

**From your host machine:**
- Host: `localhost`
- Port: `3306`
- Username: `yii2user`
- Password: `yii2password`
- Database: `yii2basic`

**From within containers (using service name):**
- Host: `db`
- Port: `3306`

## Useful Commands

**View logs:**
```bash
podman-compose logs -f web      # PHP-FPM logs
podman-compose logs -f db       # MySQL logs
podman-compose logs -f nginx    # Nginx logs
```

**Run Yii commands:**
```bash
podman-compose exec web php yii help
podman-compose exec web php yii migrate
podman-compose exec web php yii serve 0.0.0.0 8080
```

**Access MySQL shell:**
```bash
podman-compose exec db mysql -u yii2user -p yii2basic
```
(Enter password: `yii2password`)

**Stop containers:**
```bash
podman-compose down
```

**Remove containers and volumes:**
```bash
podman-compose down -v
```

**Podman-specific:**
```bash
podman machine stop        # Stop the Podman VM
podman machine start       # Start the Podman VM
podman ps                  # List running containers
podman images              # List downloaded images
```

## Troubleshooting

**Port already in use:**
Edit `docker-compose.yml` and change the port mappings:
```yaml
nginx:
  ports:
    - "8081:80"  # Change first number to an unused port
```

**Database connection fails:**
- Ensure MySQL is running: `docker-compose ps`
- Check logs: `docker-compose logs db`
- Wait a few seconds for MySQL to be ready

**File permissions issues:**
```bash
docker-compose exec web chown -R www-data:www-data /app
```

## Development Workflow

The application folder is mounted as a volume, so:
- Edit files locally in your editor
- Changes are immediately reflected in the container
- No need to rebuild for code changes
- Use `docker-compose restart web` if you need to restart PHP

## Customizing Configuration

Edit the environment variables in `docker-compose.yml` under the `web` service to change database credentials or other settings.
