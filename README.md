# Test task for Foodpicasso

<img src="https://www.slimframework.com/assets/images/favicon.png" style="width: 50px;height:50px;" alt="Laravel">
<img src="https://cdn.worldvectorlogo.com/logos/docker-4.svg" style="width: 50px;height:50px;" alt="Docker">

### Technologies:

- Docker
- Slim 4
- PHP 8.3.10 (FPM)
- Nginx
- MySQL
- Node.js 20, NPM
- Taskfile
- Rector
- TailwindCSS

## Taskfile

You need a Taskfile to easily manage the application: https://taskfile.dev/installation/.

You can run this command to see the list of available commands for the Taskfile:

```shell
task
```

## First start

Setting up the `.env` file.

Next, **collect** and **launch** containers:

```shell
task up -- -d --build # for Taskfile
docker compose --env-file .env build -d --build # for vanilla docker
```

Installing **dependencies**:

```shell
task composer -- install # for Taskfile
task npm -- ci # for Taskfile
docker exec -it foodpicasso-test-php composer install # for vanilla docker
docker exec -it foodpicasso-test-php npm ci # for vanilla docker
```

Building the **frontend**:

```shell
task npm -- run build # for Taskfile
docker exec -it foodpicasso-test-php npm run build # for vanilla docker
```

Running **migrations**:

```shell
task migrations -- migrate # for Taskfile
docker exec -it foodpicasso-test-php ./vendor/bin/doctrine-migrations migrate # for vanilla docker
```
