# PROJECT TITLE (PROJECT_NAME)

[![CircleCI](https://circleci.com/gh/thinkshout/PROJECT_NAME.svg?style=shield)](https://circleci.com/gh/thinkshout/PROJECT_NAME)
[![Dashboard PROJECT_NAME](https://img.shields.io/badge/dashboard-PROJECT_NAME-yellow.svg)](https://dashboard.pantheon.io/sites/cd61a3d0-9e13-4664-9fea-db0831e5e3f5#dev/code)
[![Dev Site PROJECT_NAME](https://img.shields.io/badge/site-PROJECT_NAME-blue.svg)](http://dev-PROJECT_NAME.pantheonsite.io/)

## Requirements

Composer, terminus, and wp-cli (`brew install wp-cli`).

## Site setup

```sh
git clone git@github.com:thinkshout/PROJECT_NAME.git
cd PROJECT_NAME
cp .env.sample .env
composer install
```

Generate salts (https://roots.io/salts.html) and paste into your `.env` file. If your database user or password doesn't
match the ones provided by default, change them.

Then create the database:

```
wp db create
```

## Clone DB if this is an existing site or build actively in progress(optional)
Download and extract a database backup from Pantheon:

```sh
wget -O vendor/database.sql.gz $(terminus backup:get PROJECT_NAME.dev --element=database)
gunzip vendor/database.sql.gz
```

Import the database:

```sh
wp db import vendor/database.sql
```

The project should have its login credentials in TS 1Password. However, if you'd like to make your local copy less annoying to login to (optional):

```sh
wp user update ts_admin --user_pass=PROJECT_NAME
```

## Login
Log in to your site: https://web.PROJECT_NAME.localhost/wp/wp-admin/
Username: `ts_admin`
Password: `PROJECT_NAME`

## Committing code -- do this regularly
Each time you start a new task, you should create a branch from `develop` with the github ticket number and a short
description of the ticket's goal in the branch:

```
git checkout main
git pull
git checkout -b issue-123-short-description
```

Now work on your changes. Make sure configuration changes are saved in the codebase.

Once you're happy with your changes, create a pull request from your branch to the `develop` branch in github
and tag the tech lead or PM in the PR. Also move your ticket into the "Tech Review" column on [Zenhub](https://github.com/thinkshout/hsus#workspaces/).
Someone will then review the PR for potential improvements or fixes, and merge, and move the ticket into the "Ready to deploy"
column in [Zenhub](https://github.com/thinkshout/hsus#workspaces/). This ticket is now ready to go out with
the next release.
