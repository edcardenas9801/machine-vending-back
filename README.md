# Vending machine

In this project you will find the APIs that will provide the operation of a dispensing machine, obtain the products and the calculations that it makes internally to provide an efficient service.

## Previous requirements

Make sure you have the following installed before using this API:
- PHP 8.1
- Composer
- Laravel
- MySql

## Installation

1. Clone this repository with ssh:
   *git clone git@github.com:edcardenas9801/machine-vending-back.git*

2. Navigate to the project directory: cd /machine-vending-back

3. Install PHP dependencies using Composer:
- `composer install`: This command runs all the dependencies necessary to run the project successfully.

4. Copy the `.env` configuration file and configure your environment:

- Copy .env.example to .env.

- After having your .env, generate the key: `php artisan key:generate`

5. Configure the database in the `.env` file.

6. Run the database migrations: `php artisan migrate`

7. Run the seeders: `php artisan db:seed`

- This allows us to load test data

8. Start the development server:
   `php artisan serve`

Laravel development server started: [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Use

You can access the API at the following URL: `http://127.0.0.1:8000`

### Endpoints

- `GET /api/get-articles`: Gets the list of products in the dispensing machine.
- `POST /api/buy-article`: Purchase the item, modify the stock in your inventory and update the machine's coin status.

## Author

[Evelyn Cárdenas](https://github.com/edcardenas9801)
