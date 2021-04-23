## About This Project

This is a REST API for invite only registration. Admin can login and send invites to users by their email. Users can use the invite url to signup in the system. During signup process user is sent a 6 digit pin code to confirm. After confirmation of the pin code user is marked verified registered.

## How to run this project
Run below commands to run the project

`composer install`\
`php artisan key:generate`

### Setup database
- Create an empty database using phpmyadmin or whatever you like
- Update your host, db and password in .env file. 
- Run below commands after updating .env file

`php artisan migrate`\
`php artisan passport:install`\
`php artisan db:seed`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
