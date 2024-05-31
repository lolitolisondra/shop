# Shop

Shop is an e-commerce application using Laravel 11, Livewire 3.5 and Tailwind CSS.

## Installation

### Clone the project
Open cmd and enter the code below
```bash
git clone https://github.com/lolitolisondra/shop.git
```
### Setup

Open cmd and enter the code below

```bash
cd shop
composer install
npm install
```
#### Update .env file
add database credentials

In the
 cmd and enter the code below

```
php artisan migrate --seed
php artisan storage:link
```


## Build

```bash
npm run build
```

## Run server

Open cmd and enter the code below
```bash
php artisan serve
```
open in browser

http://localhost:8000

Open another cmd and enter the code below

```bash
npm run dev
```
