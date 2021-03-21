install:
	composer install
validate:
	composer validate
brain-games:
	./bin/brain-games
brain-even:
	./bin/brain-play even
brain-calc:
	./bin/brain-play calc
brain-gcd:
	./bin/brain-play gcd
brain-progression:
	./bin/brain-play progression
lint:
	composer run-script phpcs -- --standard=PSR12 src bin
