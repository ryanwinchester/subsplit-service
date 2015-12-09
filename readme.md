# Flashtag Subsplit Service

[![version](https://img.shields.io/packagist/v/flashtag/subsplit-service.svg)](https://packagist.org/packages/flashtag/subsplit-service)
[![license](https://img.shields.io/packagist/l/flashtag/subsplit-service.svg)](https://packagist.org/packages/flashtag/subsplit-service)

### Github Webhook and Scheduler

Have you ever wanted to split some of your code from your project into components... maybe read-only github repositories like [Symfony](https://github.com/symfony) and [Laravel](https://github.com/laravel)?

Well, I certainly did. It took me a while to find a good way to do it and now I'm going to help you do the same. This subsplit project will help you to automate the process with webhooks and/or scheduled commands.

##### Webhooks

**git push** webhook that runs the subtree split command from a github webhook

##### Scheduled commands

A `flashtag:subsplit` command will run the subtree split command and publish to the subtree repositories.

### Install

Install with [composer](https://getcomposer.org/):

```bash
composer create-project flashtag/subsplit-service --prefer-dist
```

From the project directory:

```bash
cd .git-subsplit; ./install.sh
```

### Setup

Edit the [build/flashtag-subsplit.sh](https://github.com/flashtag/services/blob/master/build/flashtag-subsplit.sh) file to match your repo, and this package should actually just work almost out-of-the-box for your own repos as well.

```bash
git subsplit init git@github.com:flashtag/flashtag.git
git subsplit publish --heads="master" app/Admin:git@github.com:flashtag/admin.git
git subsplit publish --heads="master" app/Api:git@github.com:flashtag/api.git
git subsplit publish --heads="master" app/Client:git@github.com:flashtag/client.git
git subsplit publish --heads="master" app/Cms:git@github.com:flashtag/cms.git
git subsplit publish --heads="master" app/Data:git@github.com:flashtag/data.git
rm -rf .subsplit/
```

Would change to look like:

```bash
git subsplit init git@github.com:Foobar/Parent.git
git subsplit publish --heads="master" src/One:git@github.com:Foobar/one.git
git subsplit publish --heads="master" src/Two:git@github.com:Foobar/two.git
git subsplit publish --heads="master" src/Three:git@github.com:Foobar/three.git
# . . .
# etc.
# . . .
rm -rf .subsplit/
```

#### For webhooks:

Copy the example environment file `cp .env.example .env` and change the appropriate properties.

**Uncomment** the line corresponding to the service you are using to send the webhook in [`app/Http/routes/php`](https://github.com/ryanwinchester/subsplit-service/blob/master/app/Http/routes.php)
and comment out any you aren't using.

Currently, the gitlab route is commented out by default because I don't know of any way to validate the request.

```php
// Github
$app->post('github', [
    'middleware' => 'github',
    'uses' => 'App\Http\Controllers\WebhooksController@push',
]);

// Bitbucket
$app->post('bitbucket', [
    'middleware' => 'bitbucket',
    'uses' => 'App\Http\Controllers\WebhooksController@push',
]);

// // Gitlab
// $app->post('gitlab', [
//     'middleware' => 'gitlab',
//     'uses' => 'App\Http\Controllers\WebhooksController@push',
// ]);
```

##### GITHUB

The `WEBHOOK_SECRET` is what you will also set the `secret` property to in the github webhook setup:

![Github add webhook](https://s3-us-west-2.amazonaws.com/ryanwinchester/screenshots/github-webhook-add.png)

Your github push webhook payload url path is `/webhooks/github` so an example webhook url would look something like `https://subsplit.whateveryourdomain.com/webhooks/github`

##### BITBUCKET

Your bitbucket push webhook url path is `/webhooks/bitbucket` so an example webhook url would look something like `https://subsplit.whateveryourdomain.com/webhooks/bitbucket`

##### GITLAB

Your gitlab push webhook url path is `/webhooks/gitlab` so an example webhook url would look something like `https://subsplit.whateveryourdomain.com/webhooks/gitlab`


#### For the scheduled command:

You can either use the scheduler as lumen intended in the [`app/Console/Kernel`](https://github.com/flashtag/subsplit-service/blob/master/app/Console/Kernel.php), by setting up this cron job:

```
* * * * * php /path/to/project/artisan schedule:run
```

or schedule the command yourself. For my own project, I've set up this cron job to just execute this every night:

 ```
 0 0 * * * php /path/to/project/artisan flashtag:subsplit
 ```

### Powered by

 Sometimes re-inventing the wheel is a good idea and sometimes you have great packages like:

 - [Lumen PHP Framework](https://github.com/laravel/lumen)
 - [Git Subsplit](https://github.com/dflydev/git-subsplit)
