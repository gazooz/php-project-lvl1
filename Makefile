install:
	composer install
validate:
	composer validate
brain-games:
	./bin/brain-games
brain-even:
	./bin/brain-play --game even
brain-calc:
	./bin/brain-play --game calc
lint:
	composer run-script phpcs -- --standard=PSR12 src bin
