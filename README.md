# Wibet - FIFA World Cup 2026 Betting Application

A Yii 2 PHP web application for FIFA World Cup 2026 match tracking and betting management.

## Features

- **Team Management** - Browse all 48 FIFA World Cup 2026 teams organized by 12 groups
- **Teams Page** - Dual-view display:
  - **Table View**: Professional standings table with group navigation
  - **Bracket View**: Grid layout showing all teams with circular flags
- **Match Management** - Track World Cup matches with team flags and scores
- **Betting System** - Users can place bets on match outcomes with point system
- **Admin Dashboard** - Analytics and match management tools
- **User Authentication** - Login/logout with role-based access control
- **Responsive Design** - Works on desktop and mobile devices

## Tech Stack

- **Framework**: Yii 2 PHP Framework
- **Database**: MySQL 8.0
- **Web Server**: Nginx
- **Runtime**: PHP 7.4-FPM
- **Containerization**: Docker & Docker Compose
- **Container Runtime**: Colima (macOS)
- **Frontend**: Bootstrap CSS, jQuery

## Docker Setup (macOS with Colima)

### Prerequisites

```bash
# Install Colima if not already installed
brew install colima

# Start Colima
colima start
```

### Running the Application

```bash
# Start all services (PHP-FPM, Nginx, MySQL)
docker-compose up -d

# Access the application
# Local: http://localhost
# LAN: http://192.168.1.6 (adjust to your network IP)
```

### Stopping Services

```bash
docker-compose down
```

## Directory Structure

```
assets/                  - CSS/JS assets
commands/               - Console commands
config/                 - Application configuration
controllers/            - Web controllers
database/               - Database backups and SQL files
  └── blank_db/         - Blank database dumps
models/                 - ActiveRecord models
runtime/                - Generated files at runtime
views/                  - View templates
  ├── site/             - Home page
  ├── team/             - Teams listing
  └── match/            - Match management
web/                    - Public web root
  ├── css/              - Stylesheets
  ├── js/               - JavaScript files
  └── logo.png          - Application logo
```

## Key Pages

- **Home** (`/`) - Countdown to World Cup 2026, starts June 12, 2026
- **Teams** (`/team/index`) - View all 48 teams with circular flags
- **Matches** (`/match/index`) - Browse World Cup matches
- **Dashboard** (`/site/analysis`) - Analytics and statistics
- **Admin Panel** (`/user/admin`) - Admin-only management tools

## Database

### Teams Table
- 48 FIFA World Cup 2026 teams
- Organized across 12 groups (A-L)
- 4 teams per group
- Playoff placeholders for future matches

### Team Flag URLs
Flags are dynamically generated from UEFA's CDN:
```
https://img.uefa.com/imgml/flags/140x140/{COUNTRY_CODE}.png
```

Playoff teams display the app logo instead.

## Admin Access

Default admin account:
- Email: `vudnn.dl@gmail.com`
- Password: `(as configured during setup)`

Admin users can:
- Create and manage matches
- Update match scores
- Manage teams
- View betting analytics
- Manage users and roles

## Development

### Database Operations

Dump clean database:
```bash
docker-compose exec -T db mysqldump -u root -proot yii2basic > database/blank_db/wibet_blank.sql
```

Restore from dump:
```bash
docker-compose exec -T db mysql -u root -proot yii2basic < database/blank_db/wibet_blank.sql
```

### Sample Data

Create fresh matches:
```bash
# See database/blank_db for sample data scripts
```

## Git Workflow

```bash
# Commit changes
git add .
git commit -m "Update Teams page with circular flags and bracket view"

# Create version tag
git tag -a v2026-06-01 -m "FIFA World Cup 2026 Teams page release"

# Push to remote
git push origin master
git push origin --tags
```

## Configuration Files

- `docker-compose.yml` - Docker services configuration
- `Dockerfile` - PHP-FPM image build
- `nginx.conf` - Nginx web server configuration
- `.env.docker` - Environment variables for Docker
- `config/db.php` - Database connection (uses environment variables)

## Troubleshooting

### Container Issues
```bash
# View container logs
docker-compose logs -f

# Restart services
docker-compose restart
```

### Database Connection
Ensure `docker-compose.yml` environment variables match `config/db.php`:
- `DB_HOST: db` (service name)
- `DB_NAME: yii2basic`
- `DB_USER: yii2user`
- `DB_PASSWORD: yii2password`

## License

This application is built with Yii 2 Framework under the BSD License.

## Support

For issues or questions, check the logs:
```bash
docker-compose logs -f php
docker-compose logs -f db
docker-compose logs -f nginx
```
