sh:
	@echo "Start shell in php container"
	make up && docker-compose exec -it php sh

up:
	@echo "Start docker"
	docker-compose up -d

ps:
	@echo "Show running docker containers"
	docker-compose ps

build:
	@echo "Build docker container"
	docker-compose build -d
