# Affiliates Reporting API

### Bundle Structure
```
├── CompilerPass
├── Controller
└── Resources
```

## Service Layer
```
├── Application
│   └── Service
├── Domain
│   └── Model
└── Infrastructure
    ├── DependencyInjection
    └── Persistence
        └── Repository
            └── Doctrine
```

## Setup

1. Copy an rename `/swagger-conf.php.dist` to `/swagger-conf.php`.
2. Copy an rename `/app/app/config/parameters.yml.dist` to `/app/app/config/parameters.yml`.
3. Deploy databases from `/database/0-1createDb.sql` in MySQL.
4. Create database schema in both databases with queries from `/database/1schema.sql`.
5. Populate databases with demo data if needed from `/database/2dummy_data.sql` (Optional).
6. Run `php composer install` on project root in docker container.
7. Change `app/var` permissions in docker container if you have cache/logs permission errors.
8. If you want to have git hooks active you must run `npm install` or `yarn` in project root (Node.js required).


## Generate Swagger Docs JSON file

In `app/src` folder, run:
```
../../vendor/bin/swagger -o ../web/swagger-ui/
```
