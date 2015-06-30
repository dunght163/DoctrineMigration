# DoctrineMigration
==================

1. Install
----------
Doctrine migrations for Symfony are maintained in the [DoctrineMigrationsBundle](https://github.com/doctrine/DoctrineMigrationsBundle). The bundle uses external [Doctrine Database Migrations](https://github.com/doctrine/migrations) library.

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

Get migration status for all versions:
```
php app/console doctrine:migrations:status --show-versions
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

5. Some tips
------------
5.1 Name of version
    For more clearly manager version, you should rename the default version name 'VersionYYYYMMDDHHmmss' to 'VersionYYYYMMDDHHmmss_<your changes>'.
Example: using 'Version20150616103030_CreateTableCompany' instead of 'Version20150616103030', then you will know that this version is for 'Creating Table Company'.
So you can migrate more exactly and faster.

5.2 Rename table
    Using diff for auto generating migrate version. Using 'RENAME TABLE ... TO ...' instead of pair of 'CREATE TABLE ...' and 'DROP TABLE'.

5.9999 Using git account when commit
    [Setting email](https://help.github.com/articles/setting-your-email-in-git/) on Github: 'GitHub uses the email address you set in your local Git configuration to associate commits with your GitHub account.'
    Commands:
        Setting your email address for every repository on your computer:
        ```
        git config --global user.email "your_email@example.com"
        ```
        Check again by:
        ```
        git config --global user.email
        ```

        Setting your email address for a single repository
        ```
        git config user.email "your_email@example.com"
        ```
        Check again by:
        ```
        git config user.email
        ```

-------------
Great worked!
-------------

See more details at [Symfony::DoctrineMigrationsBundle](http://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html).
