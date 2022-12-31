# !/bin/sh

# Start MariaDB and phpMyAdmin (tmp/local solution, prefer Kubernetes instead when its ready)
docker run --name rpg_db -dp 3306:3306 -e MARIADB_ROOT_PASSWORD=admin -e MARIADB_DATABASE=rpg_game mariadb:latest
docker run --name rpg_db_admin -dp 8001:80 --link rpg_db:db phpmyadmin