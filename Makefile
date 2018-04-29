start:
	docker-compose up -d

stop:
	docker-compose down --remove-orphans

restart: stop start

run:
	docker exec -it emaghero_app_1 php -f index.php

run-test:
	docker exec -it emaghero_app_1 php vendor/bin/phpunit

bash-phpfpm:
	docker exec -it emaghero_app_1 bash
