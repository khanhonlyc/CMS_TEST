# marinesTeam26
#### Refer:
- Link 1
  https://github.com/phamngoctuong/laravel-docs-vn/blob/main/readme.md
- Link 2
	https://raw.githubusercontent.com/phamngoctuong/laravel-docs-vn/main/readme.md
## You can use 1 of 2 ways to configure.
#### Guid Config 1:
- C:\Windows\System32\drivers\etc\hosts
```php
127.0.0.1 testtiah.com
```
- Create file .htaccess 👇 to your Laravel root folder
```php
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule ^(.*)$ /public/$1 [L]
RewriteCond %{REQUEST_URI} !(.css|.js|.png|.jpg|.gif|robots.txt|.ttf)$ [NC]
</IfModule>
```
- C:\xampp\apache\conf\extra\httpd-vhosts.conf
```php
<VirtualHost testtiah.com:80>
    DocumentRoot "C:\xampp\htdocs\marinesTeam26"
	ServerName testtiah.com
	ServerAlias *.testtiah.com
</VirtualHost>
```
Link: [testtiah.com](http://testtiah.com/)
#### Guid Config 2:
- Rename server.php in your Laravel root folder to index.php
- Create file .htaccess 👇 to your Laravel root folder
```php 
<IfModule mod_rewrite.c>
  <IfModule mod_negotiation.c>
      Options -MultiViews -Indexes
  </IfModule>
  RewriteEngine On
  # Handle Authorization Header
  RewriteCond %{HTTP:Authorization} .
  RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
  # Redirect Trailing Slashes If Not A Folder...
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_URI} (.+)/$
  RewriteRule ^ %1 [L,R=301]
  # Send Requests To Front Controller...
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule ^ index.php [L]
  RewriteCond %{REQUEST_URI} !(.css|.js|.png|.jpg|.gif|robots.txt|.ttf)$ [NC]
</IfModule>
```
Link: [localhost](http://localhost/marinesTeam26)
#### Guid Migrate Database:
[file 👍 .env](https://github.com/HOT-FACTORY/marinesTeam26/blob/main/.env)
```php 
- config file .env
- php artisan migrate
- php artisan db:seed
```
#### Schema sql 👇
[file 👍 marinesteam26.sql](https://github.com/HOT-FACTORY/marinesTeam26/blob/main/database/migrations/marinesteam26.sql)
