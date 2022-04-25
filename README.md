# Eutranet's Laravel Setup
Laravel Setup is the fourth Eutranet\'s package.

## Introduction
This package allows the super administrator to start managing the all installation.

## Support us
More soon.

## Pre-requisites
### Laravel Version
This package requires Laravel 9 or higher.

### Composer requires...
- "laravel/scout": "^9.4",
- "spatie/laravel-medialibrary": "^10.0",
- "spatie/laravel-permission": "^5.5",
- "spatie/laravel-translatable": "^5.2",
- "spatie/laravel-translation-loader": "^2.7"

### Config file
This package publishes
- the "permission" config file (spatie/laravel-permission)
- the "corporate" config file (fall back for the company config)
- the "eutranet-setup" config file

## Installation in Laravel
This package can be used with Laravel 9.0 or higher, and should be the fourth
Eutranet's core package to be installed.

### Installing
1. Have a look at the prerequisites section.
2. composer require eutranet/laravel-setup
3. Installation command is php artisan eutranet:setup
4. Optimize (php artisan optimize)

## Questions and issues
A bug? Problems with the package? Questions or suggestions? Tell us on GitHub.

## Changelog
All notable changes are documented on GitHub.

# For frontend users
No frontend user should access Eutranet's Laravel Init.

# For staff members
No staff members should access Eutranet's Laravel Init.

# For administrators
- A default superadmin user (superadmin@domain.tld, Password) was created in the admins table.
- CHANGE the credentials ! This is not secure.
- Login and access the setup panel.