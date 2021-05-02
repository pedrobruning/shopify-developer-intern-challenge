# Shopify Developer Intern Challenge
Build an image repository.
# About
> This repository was made for Shopify Developer Intern Challenge.
# Installation
> 1. Create a .env file using the .env.exemple
>>      1. **You need to fill the database fields correctly.**
> 2. `composer install`
> 3. `npm install`
> 3. `npm run dev`
> 4. `php artisan key:generate`
> 5. `php artisan storage:link`
## Database Migrating and Seeding 
> 1. `php artisan migrate --seed`
>> Now your database is ready and with some data.
## Running the server localy
> 1. `php artisan serve`
# Using
1. Register
    1. Route: `/register`
    2. All the fields are required.
2. Login
    1. Route: `/login`
    2. All the fields are required.
3. List of avaliable Photos
    1. Route: `/photos`
    2. This route shows every public photo in the site, paginated by 28 photos.
4. Buy photos
    1. To buy one photo you must have sufficient balance. Every user starts with $ 300,00 to spend.
    2. Click in the buy button on the top right of any photo.
    3. Confirm your purchase on the confirm alert.
    4. You will be redirected to your personal inventory.
    5. You can get more balance by hiring me at Shopify :P
5. Sell photos
    6. Right after your login you will see a green button with the message `Upload new Photo` click it!
    7. You will be redirected to the create photo page. Fill all the required fields. Congratulations you just uploaded a photo and you can start selling it!
    8. If your photo is Public all users can see and buy it.
    9. When you sell a photo the sale will appear at the `Your Sales` page.
6. Your Sales
    1. Route: `/sales`
    2. This route shows every sale that you have done, paginated by 20 sales.
# Testing
> You can run all the tests using the following command: `php artisan test`
