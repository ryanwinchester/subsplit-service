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
