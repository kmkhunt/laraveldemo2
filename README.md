### Laravel 6.18 Installation by composer

```
$ composer create-project --prefer-dist laravel/laravel laraveldemo "6.*"
```
### Set 777 permission for storage and cache folder by following command

```
sudo chmod -R 777 ./storage
sudo chmod -R 777 ./bootstrap/cache/

After accessing this project in url if you find following error
Symfony\Component\Debug\Exception\FatalErrorException
Declaration of Symfony\Component\Translation\TranslatorInterface::setLocale($locale) must be compatible with Symfony\Contracts\Translation\LocaleAwareInterface::setLocale(string $locale) 

Then add following line in composer.json and perform `composer update` command

"require": {
	"symfony/translation-contracts": "^1.1.6"
}
```

### Use Default AUTH via php artisan ui:auth
```
To complete this functionality perform following commands

1) composer require laravel/ui "^1.2"
2) php artisan ui:auth

If your Login and Register page only shows plain HTML. And CSS is not loading properly then run this two command:

3) npm install
4) npm run dev

Run default migration for default tables provided by laravel
php artisan migrate

Set database and host detail in .env file
```

### Use Seed and Generate testing data for user table.
```
Make Seeder by php artisan make:seeder UsersTableDataSeeder
Write run method of UsersTableDataSeeder by following way

    public function run() {
	for ($i = 1; $i <= 100; $i++) {
		DB::table('users')->insert([
			'name' => Str::random(8),
			'email' => Str::random(12) . '@mail.com',
			'password' => bcrypt('123456'),
		]);
	}
    }

Now when you run php artisan db:seed command, it will create 100 users record in users table.
```
