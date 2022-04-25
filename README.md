# Eutranet's Laravel Init
Laravel Init is the firts Eutranet's core package.

## Introduction
This package creates essential tables in the database and
allows other Eutranet's core packages to be installed properly,
especially in the contexte of a fresh installation.

## Support us
More soon.

## Pre-requisites
### Laravel Version
This package requires Laravel 9 or higher.

### Composer requires...
- "spatie/laravel-medialibrary": "^10.0",
- "spatie/laravel-permission": "^5.5",
- "spatie/laravel-translatable": "^5.2",
- "spatie/laravel-translation-loader": "^2.7"

### Config file
This package publishes
- the "eutranet-init" config file
- the "permission" config file (spatie/laravel-permission)
- the "media-library" config file (spatie/laravel-media-library)

## Installation in Laravel
This package can be used with Laravel 9.0 or higher, and should be the first
Eutranet's core package to be installed.

### Installing
1. Have a look at the prerequisites section.
2. composer require eutranet/laravel-init
3. Installation command is php artisan eutranet:init
4. Optimize (php artisan optimize)

## Questions and issues
A bug? Problems with the package? Questions or suggestions? Tell us on GitHub.

## Changelog
All notable changes are documented on GitHub.

# For frontend users
No frontend user should access Eutranet's Laravel Init.
- A demo user (demo@demo.com, Password) exists in the user table.

# For staff members
No starff members should access Eutranet's Laravel Init.

# For administrators
As soon as the package is installed, the installer accesses /init. This
page will remain accessible until the installation process is complete.
All Eutranet's packages are displayed, with basic installation info / status.

This page should NOT BE ACCESSIBLE anymore after the installation of core packages.

## spatie/laravel-package-tools
This package includes tweaked files from Spatie/Laravel-Package-Tools.