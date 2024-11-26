up:
	docker compose -f deploy/docker-compose.yml --env-file ./.env up --build -d
down:
	docker compose -f deploy/docker-compose.yml down
shell:
	docker exec -it api sh
fresh:
	docker exec -t api php artisan migrate:fresh --seed
test:
	docker exec -t api php artisan test
