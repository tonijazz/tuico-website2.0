# TUICO Web: Deployment Checklist (cPanel shared hosting)

Written after the successful test deployment at `test.tuico.or.tz` (10 Oct 2026).
Work one step at a time. Do not start the next step until the current one is fully confirmed.

## 0. Before you start (on your computer)
- [ ] Everything is committed and pushed (`git status` is clean, `git push` says up to date)
- [ ] `public\hot` does not exist (delete it if it does); `npm run build` finishes with no errors
- [ ] Banner and slide images are compressed (about 300 KB each, WebP or JPEG)
- [ ] `User` model has `implements FilamentUser` (otherwise the admin shows 403 in production)
- [ ] Make the three upload files and keep them OUT of git:
  - `build.zip` (the `public/build` folder)
  - `storage-public.zip` (contents of `storage\app\public`)
  - `tuico.sql` (database dump; excludes sessions, cache, cache_locks, activity_log; check it ends with "Dump completed")

## 1. Domain and PHP
- [ ] Create the domain or subdomain in cPanel, Domains (document root must sit inside `public_html`)
- [ ] MultiPHP Manager: set PHP 8.3 for THAT domain only (the main site must keep its own version)
- [ ] Select PHP Version, 8.3, enable: bcmath, fileinfo, gd, intl, mbstring, pdo_mysql, zip (plus dom, iconv, phar, simplexml, xmlreader, xmlwriter)
- [ ] Terminal check: `/opt/alt/php83/usr/bin/php -v` prints 8.3.x and all extensions show OK

## 2. Database (never use root)
- [ ] cPanel, MySQL Database Wizard: create database and a dedicated user with ALL PRIVILEGES
- [ ] Save the generated password in a password manager (never paste it into chat or git)
- [ ] Test the login: `mysql -u USER -p DBNAME -e "SELECT 1;"`

## 3. Code
- [ ] Deploy key: `ssh-keygen -t ed25519 -f ~/.ssh/tuico_deploy -N ""`, add the .pub to GitHub, Settings, Deploy keys (read-only)
- [ ] Add the SSH config entry, then clone into `~/tuico-test` (outside `public_html`)
- [ ] In the repo: `git config core.sshCommand 'ssh -i /home/USER/.ssh/tuico_deploy -o IdentitiesOnly=yes'` and `git config core.fileMode false`
- [ ] Composer is not installed on the host: install it into `~/bin` (verify the installer signature), then
      `/opt/alt/php83/usr/bin/php ~/bin/composer install --no-dev --optimize-autoloader`

## 4. Environment
- [ ] `cp .env.example .env`, `chmod 600 .env`, `php artisan key:generate`
- [ ] `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://...`, `APP_TIMEZONE=Africa/Dar_es_Salaam`
- [ ] `DB_*` values from step 2, `QUEUE_CONNECTION=sync`, `LOG_CHANNEL=daily`, `LOG_DAILY_DAYS=90`, `SETTINGS_CACHE_ENABLED=true`
- [ ] `php artisan db:show` connects to the right database

## 5. Content
- [ ] Upload the three files to the home folder (not `public_html`); check sizes and the "Dump completed" line
- [ ] Import: `mysql -u USER -p --default-character-set=utf8mb4 DBNAME < ~/tuico.sql`
      (only if it complains about `utf8mb4_uca1400_ai_ci`: `sed -i 's/utf8mb4_uca1400_ai_ci/utf8mb4_unicode_ci/g' ~/tuico.sql`)
- [ ] `php artisan migrate --force` then `migrate:status` shows no pending
- [ ] Row counts match the local database (users, roles, permissions, news, events, inquiries, slides, settings)
- [ ] `unzip -o ~/build.zip -d public`, unzip the images into `storage/app/public`, `php artisan storage:link`, `chmod -R 775 storage bootstrap/cache`
- [ ] File counts match local (`storage/app/public`)

## 6. Point the domain at the app
cPanel will not accept a document root outside `public_html`, so:
- [ ] Merge the PHP handler into the app: put the placeholder folder's `.htaccess` (the `alt-php83` handler) at the TOP of `~/tuico-test/public/.htaccess`, keep Laravel's rules below it
- [ ] Copy the placeholder's `.well-known` into `~/tuico-test/public/`
- [ ] Move the placeholder folder away, then `ln -s ~/tuico-test/public ~/public_html/FOLDERNAME`
- [ ] `git status --short` shows only ` M public/.htaccess` (commit that file later so future pulls stay clean)

## 7. HTTPS
- [ ] cPanel, SSL/TLS Status, Run AutoSSL (the main domain row must be green; a failed wildcard HTTP check is normal)
- [ ] Domains, Force HTTPS Redirect on; test http redirects to https and the page looks normal

## 8. Admin access and users
- [ ] Sign in at `/admin`; change the super admin password to a new strong one
- [ ] Every user needs `panel_user` PLUS a working role (`communications_officer`, `secretariat`, `guest`). Without `panel_user`, login fails with "These credentials do not match our records"
- [ ] Delete test accounts; give real users strong passwords, shared privately
- [ ] Test sign-in as each role (what they see matches the plan; direct addresses like `/admin/users` give 403)

## 9. Scheduler
- [ ] `php artisan schedule:list` shows `activitylog:clean` daily
- [ ] cPanel, Cron Jobs: every minute: `cd /home/USER/tuico-test && /opt/alt/php83/usr/bin/php artisan schedule:run >> /dev/null 2>&1`
- [ ] (Optional proof) send output to a log file for 3 minutes, expect "No scheduled commands are ready to run", then switch back to `/dev/null` and delete the log

## 10. Security check (run from your own computer, not the server)
- [ ] Each of these returns 404 or 403, never 200: `/.env`, `/composer.json`, `/artisan`, `/.git/config`, `/vendor/autoload.php`, `/storage/logs/laravel.log`

## 11. Clean up
- [ ] Delete from the server: `build.zip`, `storage-public.zip`, `tuico.sql`, `composer-setup.php`, `.htaccess` backups, the old placeholder folder. Keep `~/bin/composer`
- [ ] Delete the same zip/sql files from your computer

## 12. Updating the live site later
1. Commit and push from your computer (add specific files, never `git add -A` blindly)
2. Server: `cd ~/tuico-test && git pull`
3. If there are migrations: `php artisan migrate --force`
4. `php artisan settings:clear-cache` and `php artisan optimize:clear`
5. If CSS or JS changed: `npm run build` locally, zip `public/build`, upload and unzip into `public`
6. Open the changed pages and check them

## 13. Before using the real domain
- [ ] Change `APP_URL` in `.env`, then `php artisan config:clear`
- [ ] Set up real mail settings if the site sends email (currently `MAIL_MAILER=log`)
- [ ] Decide on backups (database dump and `storage/app/public`) and how often
- [ ] Remove any `robots.txt` that blocks search engines when you are ready to be indexed
