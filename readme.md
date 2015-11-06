## Flashtag Services

#### Webhooks

**git push** webhook that runs the subtree split command from a github webhook

#### Scheduled commands

`php /path/to/project/artisan flashtag:subsplit` command will run the subtree split command and publish to the subtree repositories.

You can either use the scheduler as intended in the `Console/Kernel`, or schedule the command yourself. I've done this, to just execute this every night:

 ```
 0 0 * * * php /path/to/project/artisan flashtag:subsplit
 ```

### Install

Install with composer:

```bash
composer create-project flashtag/services --prefer-dist
```

### Setup

Copy the example environment file `cp .env.example .env` and change the appropriate properties.

The `WEBHOOK_SECRET` is what you will also set the `secret` property to in the github webhook setup:

![Github add webhook](https://s3-us-west-2.amazonaws.com/ryanwinchester/screenshots/github-webhook-add.png)

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
