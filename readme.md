## Flashtag Services

#### Webhooks

`git push` webhook that runs the subtree split command from a github webhook

#### Scheduled commands

`php artisan flashtag:subsplit` command will run the subtree split command and publish to the subtree repositories.

### Install

Install with composer `composer create-project flashtag/services --prefer-dist`

You will need to also install [dflydev/git-subsplit](https://github.com/dflydev/git-subsplit) (I'll make this part of the package later)

Copy the example environment file `cp .env.example .env` and change the appropriate properties.

The `WEBHOOK_SECRET` is what you will also set the `secret` property in the github webhook setup.

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
