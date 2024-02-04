# Laravel Dashboard

## Quickstart
1. Copy and edit *.env.example*
```shell
> cp .env.example .env
```
2. Fill `DB_HOST` with the name of mysql container, in this case it's mysql-olshop. Fill the rest as your liking.
Example:

```toml
DB_CONNECTION=mysql
DB_HOST=mysql-olshop
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=hdrsy
DB_PASSWORD=dashboardolshop
```
3. Setup docker-compose. You can do `make setup` if you're lazy like myself.

4. Then, do `make data` to setup the database.

After all of the above is finished, the app should be running in ```http://localhost:80```
