BAI test task

I've used standard Symfony 4 installation with Api platform which allows to create a rest API 
And also generate a frontend using Vuejs with Vuetify templates.

Requirements:

- Docker
- Docker-compose
- Yarn


How to run:

- `make build` - build docker images
- `update-schema` - run migrations on dev and test envs
- `load-fixtures` - fill dev database with some data
- `build-frontend` - build and serve frontend

Application is protected by Basic auth:

- user: `user1`
- password: `password`

Enjoy.
