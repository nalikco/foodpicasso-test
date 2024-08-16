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
task up -- -d --build
```

Installing **dependencies**:

```shell
task composer -- install
task npm -- ci
```

Building the **frontend**:

```shell
task npm -- run build
```
