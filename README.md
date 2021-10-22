# A minimal template to get started on Craft projects

## Requirments
- nitro >=2.0.8
- php >= 7.4 
- nodejs >= 12

## Adding a plugin
If you need a plugin, you can automatically make one using [pluginfactory.io](https://pluginfactory.io/)

Just remember to add the path to your plugin in composer.json and require it


```
"repositories" : [
     {
	     "type" : "path",
	     "url" : "plugins/myplugin/"
     }
]

"require" : {
    "tibe/myplugin": "^1.0"
}
```



## Vagrant setup

```
$ git clone git@bitbucket.org:tibedev/craft-3-template.git project
$ cd project
$ composer install
```

Once composer is done installing, you will be prompted for input of some basic envirnoment variables:

| Variable          | Notes                                          |
| ----------------- | ---------------------------------------------- |
| {SECURITY_KEY}    | Leave it empty to auto-generate one for you.   | 
| {DB_USER}         | Insert or leave it empty.                      |
| {DB_PASSWORD}     | Insert or leave it empty.                      |
| {DB_DATABASE}     | Insert or leave it empty.                      |


## Nitro setup

```
$ cd project
$ git clone git@bitbucket.org:tibedev/craft-3-template.git .
$ copy .env.example and paste as .env
$ nitro add
$ follow nitro instructions - NOTE (update .env file when you are prompted)
$ nitro ssh
$ composer install 
```
Once composer is done installing, you will be prompted for input of some basic envirnoment variables:

| Variable          | Notes                                          |
| ----------------- | ---------------------------------------------- |
| {SECURITY_KEY}    | Leave it empty to auto-generate one for you.   | 
| {DB_USER}         | Insert or leave it empty.                      |
| {DB_PASSWORD}     | Insert or leave it empty.                      |
| {DB_DATABASE}     | Insert or leave it empty.                      |
| {CLOUD_NR}        | Deploy target, use '4' for staging             |
| {DEVELOPER}       | Your ssh user name                             |

```
$ npm install (You can run 'npm install' inside container but it is better to do it locally.)
```


**If you interrupt the install, then make sure you follow the manual setup bellow. (If you interrupt during the prompt, you only need step 3)**

## Manual setup:

1. Clone: 
    ```
    $ git clone git@bitbucket.org:tibedev/craft.git project
    $ cd project
    ```
2. Clean up:
     * Set permissions to 777 for your project folder.
     * Remove `.git/` directory so any referene to this template repo is gone. 
          * ` $ rm -rf .git/ `
     * Remove the `Installer.php`
          * ` $ rm Installer.php `
     * Clean up the `composer.json` file by removing:
          * ` [Line 8]:   "Project\\": "./" `
          * ` [Line 24]:  "Project\\Installer::setup" `
3. Install:
     * Run `composer install`. NOTE (Run inside container if you use Nitro)
     * Run `composer generate-key` to generate a `SECURITY_KEY` that you should copy.
     * Open `.env.php` and edit your env variables according to your needs, and dont forget to paste your `SECURITY_KEY` from prev step.
     * Run `composer dump-autoload -o`
     * Open `dbimport.sh` and edit according to your needs.

## Overview:
The repo contains a minimal Craft project setup, that should serve as a starting point for new projects without the hussle of copy/paste project structure and geneal basic config that are basiclly needed on every Craft project, and avoiding bringing custom/dead code over from prev projects.


### Installer.php
The repo contains a file `Installer.php`, which is bascilly a composer script that is hooked on `composer install` command when no `composer.lock` file is present. That means it will be called the first time you run `composer install`.

The `Installer.php` porpuse is to mainly simplify the proccess of gitting the "first clone" right. 
It will take care of setting up some basic envirnoment variables for you in `.env.php` and cleaning up the project so no references to this repo are left what so ever.

It also creates `dbimport.sh` script for simplify merging database and assets from production environment.

What it does:
* Setting correct permissions to project folder.
* Creating `dbimport.sh` script.
* Removing `.git/` reference to this repo.
* Removing not needed lines from the `composer.json` that are only needed to run the script it self. 
* Removing the `Installer.php` it self.
* Setting up some basic env variables in `.env.php` such as the `SECURITY_KEY` which can be auto generated.

### .env.php and .env
The project uses a `.env.php` and `.env` in the root directory to take care of setting up envirnoment variables.
Craft Nitro uses `.env` to generate environment variables and simplify development process. It WILL BE NOT used in production.
Advantage of using `.env.php` over the default `.env`: https://github.com/vlucas/phpdotenv are:

* Apply logic to our variables early, such as setting $baseUrl, $envirnoment, ...
* Allow setting diffrent env for diffrent domains (As per Craft 2)
* Allow keeping this file and overriding env variables from server config (Nginx, Apache...)
# barnehageplass.no
