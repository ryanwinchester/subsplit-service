# Flashtag Subsplit Service

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

The `WEBHOOK_SECRET` is what you will also set the `secret` property to in the github webhook setup:

![Github add webhook](https://s3-us-west-2.amazonaws.com/ryanwinchester/screenshots/github-webhook-add.png)

Your github push webhook payload url path is `https://whateveryourdomain.com/webhooks/push`

#### For the scheduled command:

You can either use the scheduler as lumen intended in the [`app/Console/Kernel`](https://github.com/flashtag/subsplit-service/blob/master/app/Console/Kernel.php), by setting up this cron job:

```
* * * * * php /path/to/project/artisan schedule:run
```

or schedule the command yourself. For my own project, I've set up this cron job to just execute this every night:

 ```
 0 0 * * * php /path/to/project/artisan flashtag:subsplit
 ```
