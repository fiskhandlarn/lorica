up: docker%up
	xdg-open "https://localhost:3000/"

down:
	docker-compose down --remove-orphans

logs:
	docker-compose logs

backstop%reference: docker%up
	npm run backstop reference

backstop%test: docker%up
	npm run backstop test

backstop%approve: docker%up
	npm run backstop approve

docker%up:
	docker-compose up -d

ssl%create:
	mkdir -p .docker/.ssl
	openssl req -x509 -nodes -days 3650 -newkey rsa:2048 -keyout .docker/.ssl/server.key -out .docker/.ssl/server.pem
