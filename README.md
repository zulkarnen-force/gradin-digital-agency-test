## How to start

```sh
docker compose up -d --build
```

### Access

```http
http://localhost:8081
```

Import postman

```
docs/postman/postman_collection.json
```

## Tests
Run 

```sh
docker compose exec app sh -c "php artisan test"
```