git subsplit init git@github.com:sevenshores/flashtag.git
git subsplit publish --heads="master develop" app/Admin:git@github.com:flashtag/admin.git
git subsplit publish --heads="master develop" app/Api:git@github.com:flashtag/api.git
git subsplit publish --heads="master develop" app/Front:git@github.com:flashtag/front.git
git subsplit publish --heads="master develop" app/Cms:git@github.com:flashtag/cms.git
git subsplit publish --heads="master develop" app/Data:git@github.com:flashtag/data.git
rm -rf .subsplit/
