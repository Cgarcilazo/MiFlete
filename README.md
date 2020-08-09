## MiFlete setup steps

1. Install Docker from https://www.docker.com/

2. Install lando from https://lando.dev/

3. clone the repository

4. cd /MiFlete/src

5. lando start

6. lando composer install

7. lando artisan migrate

8. lando npm run watch-poll

## Usefull commands:
* lando artisan -> access php artisan to run commands
* lando npm -> access npm to run commands i.e lando npm install
* lando composer -> access composer to run commands i.e lando composer install

## Clarifications:
* The mysql database is running internally in the 3306 port, but to connect from external tools (i.e sequelPro, MySQL Workbench, etc), we need to use the 3307 port.

