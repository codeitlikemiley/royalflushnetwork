# Royal Flush Network 

A fresh baked ready to use Laravel 5.1 Application using Materialize Css Design configured by laravel elixir for handling frontend dependencies.

# Requirements

I assume that you have this dependencies on your machines. If not, just visit their website to install

  * [Composer] - A must Have
  * [Virtual Box] - A must have
  * [Vagrant] - A must
  * [Homestead] - A must have
  * [Git] - A must Have
  * [Materialize] - For CSS 
### Version
1.0.0  - Front End Deployed

# To be Migrated Soon 
Module 1 - User Authentication with Ajax (finished)
Module 2 - User Registration For Free User (finished)
Module 3 - Search Sponsor  (finished)
Module 4 - User Activation By Manual and Activation Code (finished)
Module 5 - Sidebar Manager 
Module 6 - Bottom Sheet Manager 
Module 7 - Dashboard
Module 8 - ROyalty Fee (finished)
Module 9 - Royal Pass Up
Module 10 - Royal Flush Line 
Module 11 - Royal Matrix (finished)
Module 12 - Royal Flush Bonus 
Module 13 - Royal Push Up 
Module 14 - Royal Switch Line 


# Installation

### Step 1: Clone this repo 
```
$ cd Homestead
$ vagrant up
$ vagrant ssh
$ cd Code  // Note this is where All Your Site Folder Exists
$ git clone https://github.com/masterpowers/royalflushnetwork.git CUSTOMIZENAME
```
### Step 2: Install composer packages
```
$ cd CUSTOMIZENAME
$ composer install
```

### Step 3: Create a .ENV file
```
$ mv .env.example .env 
```
```
Your .env File Should Look Something like this
APP_ENV=local
APP_DEBUG=true
APP_KEY=SomeString

DB_HOST=localhost
DB_DATABASE=rfndotnet
DB_USERNAME=homestead
DB_PASSWORD=secret

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync
```
### Step 4:  Generate a an APP_KEY
```
$ php artisan key:generate
```

### Step 5: Create Database inside  Homestead
```
$ mysql -u homestead -p 
$ type your pass : *****
mysql> create database rfndotnet;

```


### Step 6: Add a New Site Folder to be serve in port 80
```
$ serve rfndotnet.dev /home/vagrant/Code/rfndotnet/public 80 
```

### Step 7: Edit ETC Host File
```
$ 127.0.0.1 rfndotnet.dev 
(C:\Windows\System32\Drivers\etc\hosts) -> for windows User
```

###

***That's it! Now you should be ready  -Power!!! ***


### If Errors encountered Please Submit an Issue
[NodeJs]: <http://nodejs.org>

[Bower]: <http://bower.io>

[Gulp]: <http://gulpjs.com>

[Composer]: <https://getcomposer.org>

[Virtual Box]: <https://www.virtualbox.org/wiki/Download_Old_Builds_4_3>

[Vagrant] <http://www.vagrantup.com/downloads.html>

[Homestead] <https://atlas.hashicorp.com/laravel/boxes/homestead>

[Git] <https://git-scm.com/>

[Materialize] <http://materializecss.com>