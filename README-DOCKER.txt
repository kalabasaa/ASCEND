ASCEND — DOCKER SETUP
======================

1. Extract this zip DIRECTLY INTO your project root, so these files sit
   next to artisan, composer.json, etc:

     C:\Users\Lenovo\Desktop\Ascend\Dockerfile
     C:\Users\Lenovo\Desktop\Ascend\docker-compose.yml
     C:\Users\Lenovo\Desktop\Ascend\.dockerignore
     C:\Users\Lenovo\Desktop\Ascend\.env.docker
     C:\Users\Lenovo\Desktop\Ascend\docker\entrypoint.sh

2. Make sure Docker Desktop is running on Windows.

3. From your project folder in PowerShell:

     docker compose up --build

   First build takes a few minutes (composer install + npm build).
   It will:
     - spin up MySQL
     - wait for MySQL to be ready
     - copy .env.docker -> .env automatically (if no .env exists)
     - generate app key
     - run migrate:fresh --seed (fake data loads automatically every start)
     - serve the app

4. Open:
     App:        http://localhost:8000
     phpMyAdmin: http://localhost:8080  (user: ascend_user / pass: ascend_pass)

5. Login creds (from the seeder):
     Admin:  admin.renier / Admin@12345
     Member: member1 ... member15 / Member@12345

6. To stop:
     docker compose down

   To stop AND wipe the DB volume (full reset next run):
     docker compose down -v

NOTES
-----
- entrypoint.sh runs `migrate:fresh --seed` on every container start.
  That's intentional for a demo/academic project so you always get a
  clean, populated DB — but it means any manual data you add while the
  container is running gets wiped on restart. If you don't want that,
  edit docker/entrypoint.sh and change the line:
      php artisan migrate:fresh --seed --force
  to:
      php artisan migrate --force

- If port 8000, 3306, or 8080 is already in use on your machine
  (e.g. your local `php artisan serve` or local MySQL is still running),
  stop those first or change the left-hand port numbers in
  docker-compose.yml (e.g. "8001:8000").
