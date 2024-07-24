# Genie

[![Latest Deploy to Staging](https://github.com/AGIs-Digital/studygenie/actions/workflows/deploy-staging.yml/badge.svg?branch=master&event=push)](https://github.com/AGIs-Digital/studygenie/actions/workflows/deploy-staging.yml)

[![Latest Deploy to Live](https://github.com/AGIs-Digital/studygenie/actions/workflows/deploy-live.yml/badge.svg?event=push)](https://github.com/AGIs-Digital/studygenie/actions/workflows/deploy-live.yml)

Make sure to have a running Webserver & MySQL.
Check .env.example

```
composer install
```

```
npm install
npm run dev
```

or

```
npm run build
```

Run migrations by

```
php artisan migrate:fresh --seed
```

Log in with user:

```
Username: admin@studygenie.de
Password: admin
```
