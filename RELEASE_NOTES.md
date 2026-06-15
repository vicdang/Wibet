# Wibet Release Notes

## Version 2026-06-15: Standings, Sequential Numbering & Ranking Display Options

### 🎉 Major Features

#### Sequential Numbering
- **Match Numbers**: New `match.match_no` column, auto-assigned on insert (`GameMatch::beforeSave()`), displayed as `M001`, `M002`, ... on `/match/index`
- **User Numbers**: New `user.user_no` column, auto-assigned via the new `app\components\UserNoBootstrap` component (hooks `EVENT_BEFORE_INSERT` on the vendor `User` model), displayed as `U0001`, `U0002`, ... on `/user/admin`
- Both columns backfilled in order of `id` via new migrations `m260615_041300_add_match_no_to_match` and `m260615_042000_add_user_no_to_user`

#### Team Standings & Charts
- **`Team::getAllStandings()`**: League-wide standings (MP, W, D, L, GF, GA, GD, Pts, win rate) for every team with at least one played match
- **Analysis Dashboard**: New "Teams Statistics" section with Wins/Draws/Losses and Win Rate bar charts
- **Team Detail Page**: Added win rate stat card and two new charts (match results doughnut, goals for/against bar)

#### Match Page Enhancements
- **Swap Teams Button**: Quickly flip Team 1 / Team 2 on the match form
- **Hide Completed Filter**: New checkbox (checked by default) hides matches that are finished and hidden

#### Ranking Display Options
- **`show_account_name` config**: Toggle between `@username` and full name on `/ranking`
- **`bankruptcy_text` config**: Configurable label (default "Bankruptcy") shown when a user's total balance is 0
- Removed the per-row "View" action button on the ranking list (cards remain clickable per existing access rules)

#### Admin UX
- **Clickable Cards**: Team admin and user admin cards now navigate to their detail pages on click; Edit/Delete buttons stop click propagation

### 🔧 Technical Improvements
- New `components/` directory for app-level bootstrap components (`UserNoBootstrap`)
- `MatchSearch`: added `hide_completed` filter (defaults to hiding finished+hidden matches)

### 🚀 Deployment
- **Action required**: run `php yii migrate` to add `match_no` and `user_no` columns before deploying this version's code

### 👥 Contributors
- Claude Sonnet 4.6

---

## Version 2026-06-01: Tournament Management & Configuration System

### 🎉 Major Features

#### Tournament Management System
- **Dynamic Tournament Phases**: Admins can now switch between Group Stage and Knockout Stage modes from the configuration page
- **Group Stage View**: All 48 teams organized in 12 groups (A-L), with 4 teams per group
- **Knockout Stage View**: Teams progress through 6 knockout rounds (Round of 32, Round of 16, Quarterfinals, Semifinals, Finals, Third Place)
- **Dynamic Statistics**: Team statistics (W-D-L-GF-GA-GD-Pts) are automatically calculated from match data without database storage

#### Centralized Configuration Management
- **Admin Configuration Panel** (`/config/index`): All business logic parameters now managed from one central location
- **Betting Settings**: Starting money, minimum/maximum bet amounts, minimum bet times, maximum refill times, accounts per user
- **Payment Settings**: Minimum/maximum withdrawal amounts, payment schedule times
- **Prize Pool Configuration**: Total prize amount, gift items, rates and counts for each prize tier (MT, ADJ, P1-P5)
- **Application Settings**: Season name, admin/group chat links, admin contact information
- **Hybrid Configuration Approach**: Constants remain in `params.php` for performance, while business logic parameters are managed in `admin_configs` table

#### Team Management Interface
- **Admin Team CRUD**: Complete create, read, update, delete functionality for teams
- **Professional Card-Based Design**: Modern UI matching the app's aesthetic standards
- **Conditional Validation**: Team fields (group_name vs knockout_round) change based on tournament phase
- **Team Details Page**: View full team statistics, match records, and standings
- **Filterable Team Listing**: Search by team name and group with auto-submit filters
- **Total Team Count**: Management page header shows total teams in system

#### Enhanced User Experience
- **Redesigned Login Page**: Modern card-based layout with glass morphism effect, gradient backgrounds, and smooth animations
- **Password Visibility Toggle**: Eye icon button on password fields to show/hide password (login and admin forms)
- **Dark/Light Theme Support**: All new interfaces support both dark and light color schemes seamlessly
- **Dynamic Page Text**: Tournament names and team counts automatically update from database/config
- **System Counts**: Management pages now display total counts (teams, users, matches)

### 🔧 Technical Improvements

#### Architecture
- **AdminConfig System**: Centralized configuration storage without database schema changes
- **Dynamic Calculations**: Statistics calculated on-demand from match relationships
- **Conditional Field Rendering**: Forms adapt based on tournament phase configuration
- **Reusable Components**: Back button component for consistent navigation patterns

#### Code Quality
- **Clean Imports**: Team model methods for proper flag handling (getFlagUrl, isPlayoffTeam)
- **Validation Patterns**: Conditional validation rules based on system state
- **Database Optimization**: Indexed queries for team and match lookups

### 🐛 Bug Fixes
- Fixed auto-submit issue on team edit forms (disabled AJAX validation)
- Fixed team knockout_round field not appearing in filtered results
- Corrected password field class naming and styling

### 📚 Documentation
- Updated README.md with comprehensive feature descriptions
- Updated CLAUDE.md with implementation patterns and code examples
- Added usage documentation for all new admin features

### 🗑️ Cleanup
- Removed unnecessary comments from codebase
- Cleaned up database with fresh blank database dump
- Organized views directory with consistent structure

### 🚀 Deployment
- Docker setup remains unchanged and fully functional
- Dual database support (production/staging) operational
- All migrations included in version control

### 📝 Known Issues
- None at this time

### 🔜 Next Steps for Future Development
- Advanced betting odds calculation
- User statistics and ranking system
- Email notifications for match results
- Mobile app API endpoints
- Real-time score updates via WebSocket

### 💬 Notes for Developers

When working on this version, remember:
- **Never assume data** - ask first if unsure about database structure
- **Use AdminConfig::get()** for dynamic values, not params.php
- **Tournament phase** controls which views and fields are displayed
- **Team statistics** are calculated on-demand, not stored
- **Configuration changes** should go through the admin panel, not hardcoded

### 📦 Version Info
- **Release Date**: June 1, 2026
- **World Cup Start**: June 12, 2026
- **Teams**: 48 (12 groups × 4 teams)
- **Knockout Rounds**: 6 (R32, R16, QF, SF, Finals, 3rd Place)

### 👥 Contributors
- Claude Haiku 4.5

---

For detailed implementation information, see CLAUDE.md and README.md
