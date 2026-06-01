# Claude Code Instructions for Wibet

This document contains project-specific guidance for Claude Code when working on the Wibet World Cup 2026 betting application.

## Project Context

**Wibet** is a Yii 2 PHP web application for tracking World Cup 2026 matches and managing user betting on match outcomes.

- **Start Date**: June 12, 2026
- **Total Teams**: 48 (organized in 12 groups, A-L)
- **Deployment**: Docker + Colima (local development)
- **Production Access**: http://192.168.1.6 (LAN network)

## Critical User Feedback

### Never Assume Data
**Important**: User explicitly stated: "Never assume data, ask me if you don't sure."

This occurred when making assumptions about World Cup tournament groups instead of asking first. 

**Apply this rule to**:
- Database structure changes
- API/endpoint designs
- New table schemas
- Feature requirements
- Data relationships

**Always ask first** if unsure, rather than implementing assumptions.

## Team Flag URLs

All team flags use UEFA's CDN in circular format:

```
https://img.uefa.com/imgml/flags/140x140/{COUNTRY_CODE}.png
```

**Country Code Mapping** is in `models/Team.php`:
- Real countries: Use 3-letter ISO codes (MEX, BRA, ENG, etc.)
- Playoff teams: Show app logo (`/logo.png`) instead

View files automatically call `$team->getFlagUrl()` and `$team->isPlayoffTeam()`.

## Teams Table Schema

```sql
- id (int, auto-increment)
- name (varchar 50) -- e.g., "Mexico", "South Korea"
- full_name (varchar 100) -- e.g., "United Mexican States"
- flag (varchar 100) -- DEPRECATED, use getFlagUrl() method
- group_name (varchar 10) -- A, B, C, ... L
```

**Do not** store flag URLs in the database; use the `getFlagUrl()` method instead.

## Key Features & Implementation

### Tournament Management System
- **Tournament Phase Switcher** (`/config/index`) - Toggle between group stage and knockout stage
- **Group Stage**: All 48 teams organized in 12 groups (A-L), 4 teams per group
- **Knockout Stage**: Teams progress through 6 rounds (R32, R16, QF, SF, Finals, 3rd Place)
- **Dynamic Statistics**: W-D-L-GF-GA-GD-Pts calculated from match data (no database storage)
- **Team Validation**: Conditional field validation based on tournament phase

### Teams Management (`/team/admin-index`)
- **Admin CRUD Interface**: Create, read, update, delete teams
- **Card-based Layout**: Modern professional design matching app aesthetic
- **Team Details** (`/team/view?id=X`):
  - Full statistics display
  - Match record (wins, draws, losses)
  - Group/knockout round assignment
  - Circular team flag display
- **Filterable Listing**: Filter by team name and group with auto-submit
- **Dynamic Counts**: Displays total teams in header

### Tour Page (`/team/index`)
- **Group Stage View**: Bracket layout showing all 12 groups with 4 teams each
- **Knockout Stage View**: Shows teams in their respective knockout rounds
- **Dynamic Text**: Team counts and season name automatically updated from database and config
- **Circular Flags**: 48px-64px circular flag images from UEFA CDN
- **Bracket Team Cards**: Show flag, name, full name, and point statistics
- Uses `views/team/index.php`, `views/team/index-knockout.php`, and `TeamController`

### Match Page (`/match/index`)
- **Match Listing**: View all World Cup matches
- **Team Flags**: Circular 48px flag images
- **Dynamic Count**: Displays total matches in header
- **Match Status**: Shows match results and scores
- **Admin Access**: Only admins can create new matches
- Uses `views/match/index.php` and `MatchController`

### Configuration Management (`/config/index`)
- **Centralized Settings** - Manage all business logic from admin UI:
  - **System Settings**: Theme, database selection, tournament phase
  - **Application Settings**: Season name, chat links, admin contact info
  - **Betting Settings**: Starting money, min/max bets, refill limits, accounts per user
  - **Payment Settings**: Min/max withdrawal amounts, payment schedules
  - **Prize Pool**: Total amount, gift items, rates and counts for prize tiers (P1-P5)
- **AdminConfig Model**: Values stored in `admin_configs` table, not database
- **Fallback Defaults**: Uses `config/params.php` values if not set in config
- Uses `controllers/ConfigController` and `views/config/index.php`

### Login & Authentication
- **Redesigned Login Page** (`/user/login`):
  - Modern card-based layout with glass morphism effect
  - Hero section with app branding
  - Gradient background (dark/light theme aware)
  - Professional form styling with smooth animations
- **Password Visibility Toggle**:
  - Eye icon button to show/hide password
  - Glyphicon icons (eye-open / eye-close)
  - Available on:
    - Login form (`/user/login`)
    - User admin form (`/user/admin/create` and `/user/admin/update`)
  - Positioned inside password input field
- **Remember Me**: Checkbox to save login session

### Database & Docker

**Services**:
- `web` (PHP-FPM) - Application container
- `db` (MySQL 8.0) - Database service
- `nginx` (Nginx Alpine) - Web server

**Dual Database Setup**:
- `yii2basic` - Production database
- `yii2basic_staging` - Staging/testing database (auto-mirrored from production)
- Database selection controlled via `config/db_selector.php` or Admin UI

**Environment Variables** (in docker-compose.yml):
- `DB_HOST: db` (service name, not localhost)
- `DB_NAME: yii2basic` (production)
- `DB_NAME_STAGING: yii2basic_staging` (staging)
- `DB_USER: yii2user`
- `DB_PASSWORD: yii2password`

**Start/Stop**:
```bash
./docker-start.sh       # Start with auto-setup (recommended)
docker-compose up -d    # Manual start
docker-compose down     # Stop
docker-compose logs -f  # View logs
```

## Code Patterns

### Model Methods

**Team.php methods**:
- `getFlagUrl()` - Returns UEFA CDN URL or null for playoff teams
- `isPlayoffTeam()` - Returns true if name contains "Play-off"
- `dropdown()` - Returns array of teams for form selects

### Views

**Always use**:
```php
<?php $flagUrl = $team->getFlagUrl(); ?>
<?php if ($flagUrl): ?>
    <img src="<?= Html::encode($flagUrl) ?>" class="team-flag" />
<?php elseif ($team->isPlayoffTeam()): ?>
    <img src="/logo.png" class="team-flag playoff-logo" />
<?php endif; ?>
```

**Never use** `$team->flag` directly — it's deprecated.

## Admin Account

- Email: `vudnn.dl@gmail.com`
- Role: Admin (can_admin = 1)
- Permissions: Match creation, user management, analytics access

## Git Workflow

**Commit & Push Policy**:
- **Only commit and push when explicitly asked** by the user
- Do NOT automatically push to git after every change
- Work on changes locally first, wait for user request to commit/push
- When user asks, create a commit with descriptive message and push once

**Before committing**:
1. Clean up test data from database
2. Dump fresh blank database to `database/blank_db/wibet_blank.sql`
3. Update `README.md` and `claude.md` if needed
4. Create descriptive commit message

**Tags**:
Use format: `v{YEAR}-{MONTH}-{DAY}` for releases
Example: `v2026-06-12` (World Cup start date)

## Files Not To Modify

- `vendor/` - Dependencies (use Composer)
- `runtime/` - Generated files
- `tests/` - Test suite
- `.git/` - Version control

## When to Ask User

Ask about:
- Database schema changes
- New table additions
- API endpoint designs
- Feature specifications
- CSS styling preferences
- Team/group data assumptions

## Local Development

**Access Points**:
- Home: `http://localhost/` or `http://192.168.1.6/`
- Teams: `http://localhost/team/index`
- Matches: `http://localhost/match/index`
- Admin: `http://localhost/user/admin`

**Check Status**:
```bash
docker-compose ps                    # Container status
docker-compose exec db mysql ...     # Run DB queries
docker-compose logs -f web           # PHP errors
docker-compose logs -f nginx         # Web server errors
```

## Performance Notes

- **Flag images**: 140x140px from UEFA CDN (cached by browser)
- **Database**: Indexed by group_name for team queries
- **Circular masks**: CSS border-radius: 50% (no image processing needed)

### User Management (`/user/admin`)
- **Admin User Interface**: View, create, edit, delete users
- **Card-based Grid Layout**: Professional user display with avatar or initials
- **User Details**: Username, email, role, status, balance, ban status
- **Quick Actions**: Add funds to user accounts with preset buttons (50-2K coins)
- **Filterable Listing**: Search by username, filter by role and status
- **Dynamic Count**: Displays total users in header
- Uses `views/user/admin/index.php` and user controllers

## Admin-Only Pages

Access Points (requires admin role):
- **Config** (`/config/index`) - Centralized configuration management
- **Teams** (`/team/admin-index`) - Team CRUD and management
- **Users** (`/user/admin`) - User management and statistics
- **Matches** (`/match/create`) - Create and manage matches

## Code Patterns

### Tournament Phase Detection
```php
use app\models\AdminConfig;
$tournamentPhase = AdminConfig::get('tournament_phase') ?: 'group_stage';
if ($tournamentPhase === 'knockout_stage') {
    // Knockout stage specific logic
}
```

### Dynamic Configuration Usage
```php
// Get config values with fallback
$seasonName = AdminConfig::get('season_name') ?: Yii::$app->params['seasonName'];
$startingMoney = AdminConfig::get('starting_money') ?: Yii::$app->params['startingMoney'];
```

### Team Statistics
```php
$team = Team::findOne($id);
$stats = $team->getStandings(); // Returns array with W-D-L-GF-GA-GD-Pts
// $stats['pts'], $stats['w'], $stats['d'], $stats['l'], etc.
```

## Known Limitations

- None at this time - all core features fully implemented

## Recently Completed Features (v2026-06-01)

### Tournament Management System
- ✅ Dynamic tournament phase switching (group stage / knockout stage)
- ✅ Team admin CRUD interface with modern card design
- ✅ Dynamic statistics calculation from match data
- ✅ Conditional team field validation based on phase

### Configuration Management
- ✅ Centralized business logic parameter management
- ✅ Betting, payment, and prize pool settings in admin UI
- ✅ Hybrid approach: constants in params.php, logic in admin_configs
- ✅ Dynamic text on tour and management pages

### UI/UX Enhancements
- ✅ Redesigned login page with modern card layout
- ✅ Password visibility toggle on login and admin forms
- ✅ Dark/light theme support throughout
- ✅ Total counts displayed on management pages
- ✅ Dynamic page text that updates from database

## Future Enhancements

Potential areas for expansion (don't implement without asking):
- Advanced betting odds calculation
- User statistics and ranking system
- Email notifications for match results and bets
- API endpoints for mobile app
- Real-time score updates via WebSocket
- Match replays and analysis features
- Betting history and statistics export
