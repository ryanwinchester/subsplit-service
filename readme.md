## Flashtag Services

#### Webhooks

`git push` webhook that runs the subtree split command from a github webhook

#### Scheduled commands

`php artisan flashtag:subsplit` command will run the subtree split command and publish to the subtree repositories.

### Install

1. Install [dflydev/git-subsplit](https://github.com/dflydev/git-subsplit)
2. composer create-project 