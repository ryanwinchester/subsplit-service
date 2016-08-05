WORK_DIR="$1"

git subsplit --work-dir="$WORK_DIR" init git@github.com:flashtag/development.git
git subsplit publish --work-dir="$WORK_DIR" --heads="master develop" app/admin:git@github.com:flashtag/admin.git
git subsplit publish --work-dir="$WORK_DIR" --heads="master develop" app/api:git@github.com:flashtag/api.git
git subsplit publish --work-dir="$WORK_DIR" --heads="master develop" app/auth:git@github.com:flashtag/auth.git
git subsplit publish --work-dir="$WORK_DIR" --heads="master develop" app/front:git@github.com:flashtag/front.git
git subsplit publish --work-dir="$WORK_DIR" --heads="master develop" app/core:git@github.com:flashtag/core.git
git subsplit publish --work-dir="$WORK_DIR" --heads="master develop" app/posts:git@github.com:flashtag-plugins/posts.git

rm -rf "$WORK_DIR"
