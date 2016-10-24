# TinyGrab Clone

This is a TinyGrab clone which can be used when TinyGrab is down! 

It's simple to run, just:

	composer install
	mv .env.example .env

Fill in any DB details in the .env file then continue to run: 

	php artisan key:generate
	php artisan migrate

You'll need to change your hosts file on your local device to point to your install:

	127.0.0.1	tinygrab.com

*You might need to change this IP depending on where you host it*
