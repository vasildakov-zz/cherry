Cherry Web Developer Assessment
=======================

Installation
------------

Using Composer (recommended)
----------------------------
The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies :

```console
cd my/project/dir
git clone https://github.com/vasildakov/cherry.git --recursive
cd cherry
php composer.phar self-update
php composer.phar install

cd public/
php -S localhost:8000
```

(The `self-update` directive is to ensure you have an up-to-date `composer.phar` available.)



Web Server Setup
----------------

### PHP CLI Server

The simplest way to get started if you are using PHP 5.4 or above is to start the internal PHP cli-server in the root directory:

```console
php -S 0.0.0.0:8080 -t public/ public/index.php
```

This will start the cli-server on port 8080, and bind it to all network
interfaces.

**Note: ** The built-in CLI server is *for development only*.

### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

```apacheconf
<VirtualHost *:80>
    ServerName zend2-doctrine2-skeleton
    DocumentRoot /path/to/cherry/public
    SetEnv APPLICATION_ENV "development"
    <Directory /path/to/cherry/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```

### Setup your Database connection
Add the database connection information in config/autoload/local.php.

```php
return array(
    // ...
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => '1',
                    'dbname'   => 'cherry',
                )
            )
        )
    ),
);
```

### Install Doctrine modules and Data fixtures
Doctrine can be integrated into Zend Framework 2 as a “module” which provides all the libraries and configuration in a self-contained bundle.
    
```javascript
    {
        "name": "zendframework/skeleton-application",
        "description": "Zend 2 Doctrine2 Skeleton Application",
        "license": "BSD-3-Clause",
        "keywords": [
            "framework",
            "zf2",
            "Doctrine",
            "Doctrine2"
        ],
        "homepage": "http://framework.zend.com/",
        "require": {
            "php": ">=5.3.3",
            "zendframework/zendframework": "2.3.*",
            "zendframework/zend-developer-tools": "dev-master",
            "zendframework/zendgdata": "2.*",
            "doctrine/doctrine-module": "0.*",
            "doctrine/doctrine-orm-module": "0.*",
            "hounddog/doctrine-data-fixture-module": "0.0.*",
            "gedmo/doctrine-extensions": "2.3.*",
            "doctrine/annotations": "dev-master",
            "symfony/yaml": "dev-master"
        }
    }
```

Then run php composer.phar update to install the modules.


### Configure Doctrine
Edit $PROJECT_DIR/config/application.config.php and add DoctrineModule and DoctrineORMModule to the list of modules–in that order, and before the Album module. Like this:

```php
return array(
    'modules' => array(
        'Application',
        'DoctrineModule',
        'DoctrineORMModule',
        'DoctrineDataFixtureModule',
        'ZendDeveloperTools',
    ),
    // ...,
);
```


### Generate Doctrine entities
...

Create schema

```console
./vendor/bin/doctrine-module orm:schema-tool:drop --force
./vendor/bin/doctrine-module orm:schema-tool:create
./vendor/bin/doctrine-module orm:validate-schema
```

Generate proxies

```console
./vendor/bin/doctrine-module orm:generate:proxies
```

Generate entities

```console
./vendor/bin/doctrine-module orm:generate-entities --update-entities="true" --generate-methods="true" module/Application/src
```

Generate repositories

```console
./vendor/bin/doctrine-module orm:generate-repositories module/Application/src
```

### Import Data fixtures
...

```console
./vendor/bin/doctrine-module data-fixture:import
```
