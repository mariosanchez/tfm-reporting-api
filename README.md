# Affiliates Reporting API

### Bundle Structure
```
    ├── CompilerPass
    ├── Controller
    └── Resources
```

## Service Layer
```
└── ModuleName
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

## Generate Swagger Docs JSON file

In `app/src` folder, run:
```
../../vendor/bin/swagger -o ../web/swagger-ui/
```
