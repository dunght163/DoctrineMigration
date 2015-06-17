# DoctrineMigration
Doctrine Migration
==================

1. Install
----------
Doctrine migrations for Symfony are maintained in the (DoctrineMigrationsBundle)[https://github.com/doctrine/DoctrineMigrationsBundle]. The bundle uses external (Doctrine Database Migrations)[https://github.com/doctrine/migrations] library.

Follow these steps to install the bundle and the library in the Symfony Standard edition. Add the following to your composer.json file:
```
{
    "require": {
        "doctrine/migrations": "1.0.*@dev",
        "doctrine/doctrine-migrations-bundle": "1.0.*"
    }
}
```

Update the vendor libraries:
```
$ php composer.phar update
```

If everything worked, the DoctrineMigrationsBundle can now be found at vendor/doctrine/doctrine-migrations-bundle.

Finally, be sure to enable the bundle in AppKernel.php by including the following:
```
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        //...
        new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
    );
}
```

2. Configuration
----------------
You can configure the path, namespace, table_name and name in your config.yml. The examples below are the default values.
```
// app/config/config.yml
doctrine_migrations:
    dir_name: %kernel.root_dir%/DoctrineMigrations
    namespace: Application\Migrations
    table_name: migration_versions
    name: Application Migrations
```

3. Usage
--------
All of the migrations functionality is contained in a few console commands:
```
doctrine:migrations
  :diff     Generate a migration by comparing your current database to your mapping information.
  :execute  Execute a single migration version up or down manually.
  :generate Generate a blank migration class.
  :migrate  Execute a migration to a specified version or the latest available version.
  :status   View the status of a set of migrations.
  :version  Manually add and delete migration versions from the version table.
```

Start by getting the status of migrations in your application by running the status command:
```
php app/console doctrine:migrations:status

== Configuration

   >> Name:                                               Application Migrations
   >> Configuration Source:                               manually configured
   >> Version Table Name:                                 migration_versions
   >> Migrations Namespace:                               Application\Migrations
   >> Migrations Directory:                               /path/to/project/app/DoctrineMigrations
   >> Current Version:                                    0
   >> Latest Version:                                     0
   >> Executed Migrations:                                0
   >> Available Migrations:                               0
   >> New Migrations:                                     0
```

Generating a new blank migration class:
```
php app/console doctrine:migrations:generate
Generated new migration class to "/path/to/project/app/DoctrineMigrations/Version...
```

Now you can add some migration code to the up() and down() methods and finally migrate when you're ready:
```
php app/console doctrine:migrations:migrate 20100621140655
```

Generate a new migration for this table for the changing automatically by running the following command:
```
php app/console doctrine:migrations:diff
```

4. Some useful migration commands
---------------------------------
Get migration status:
```
php app/console doctrine:migrations:status
```

Generate migration blank:
```
php app/console doctrine:migrations:generate
```

Generate migration diff:
```
php app/console doctrine:migrations:diff
```

Migrate to latest:
```
php app/console doctrine:migrations:migrate
```

Migrate to version:
```
php app/console doctrine:migrations:migrate <version>
```

Migrate to previous version:
```
php app/console doctrine:migrations:migrate prev
```

Migrate for test, no result, only log:
```
php app/console doctrine:migrations:migrate --dry-run
```

Migrate for test, write sql output for the changing:
```
php app/console doctrine:migrations:migrate --write-sql
```

Execute a special migrate version up/down manually:
```
php app/console doctrine:migrations:execute <version> --up / --down
```

-------------
Great worked!
-------------