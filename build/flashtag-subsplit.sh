git subsplit init git@github.com:flashtag/flashtag.git
git subsplit publish --heads="master" app/Admin:git@github.com:flashtag/admin.git
git subsplit publish --heads="master" app/Api:git@github.com:flashtag/api.git
git subsplit publish --heads="master" app/Client:git@github.com:flashtag/client.git
git subsplit publish --heads="master" app/Cms:git@github.com:flashtag/cms.git
git subsplit publish --heads="master" app/Data:git@github.com:flashtag/data.git
rm -rf .subsplit/
