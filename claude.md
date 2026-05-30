# Claude Code Instructions for Wibet

This document contains project-specific guidance for Claude Code when working on the Wibet FIFA World Cup 2026 betting application.

## Project Context

**Wibet** is a Yii 2 PHP web application for tracking FIFA World Cup 2026 matches and managing user betting on match outcomes.

- **Start Date**: June 12, 2026
- **Total Teams**: 48 (organized in 12 groups, A-L)
- **Deployment**: Docker + Colima (local development)
- **Production Access**: http://192.168.1.6 (LAN network)

## Critical User Feedback

### Never Assume Data
**Important**: User explicitly stated: "Never assume data, ask me if you don't sure."

This occurred when I made assumptions about FIFA World Cup groups instead of asking first. 

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

### Teams Page (`/team/index`)
- **Table View**: Professional standings table, group-navigable
- **Bracket View**: Grid layout showing all 48 teams
- Toggle between views with buttons at top
- Flags are **circular** (48px table, 64px bracket)
- Uses `views/team/index.php` and `TeamController`

### Match Page (`/match/index`)
- GridView displaying all matches
- Columns: Team 1 flag + name, Score, Team 2 flag + name, Date, Result
- Flags are **circular** (48px)
- Handles **null team relationships** gracefully (shows "Unknown")
- Uses `views/match/index.php` and `MatchController`

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

## Known Limitations

- Match statistics (W-D-L-GF-GA) currently show zeros (not tracked yet)
- Playoff teams are placeholders (waiting for qualifiers)
- Countdown timer on home page targets June 12, 2026

## Future Enhancements

Potential areas for expansion (don't implement without asking):
- Match result tracking
- Betting odds calculation
- User statistics and rankings
- Email notifications
- API endpoints for mobile app
- Real-time score updates
