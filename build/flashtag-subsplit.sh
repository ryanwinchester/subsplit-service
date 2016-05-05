WORK_DIR="$1"

git subsplit --work-dir="$WORK_DIR" init git@github.com:flashtag/development.git
git subsplit publish --work-dir="$WORK_DIR" --heads="master develop" app/Admin:git@github.com:flashtag/admin.git
git subsplit publish --work-dir="$WORK_DIR" --heads="master develop" app/Api:git@github.com:flashtag/api.git
git subsplit publish --work-dir="$WORK_DIR" --heads="master develop" app/Front:git@github.com:flashtag/front.git
git subsplit publish --work-dir="$WORK_DIR" --heads="master develop" app/Data:git@github.com:flashtag/data.git
git subsplit publish --work-dir="$WORK_DIR" --heads="master develop" app/Core:git@github.com:flashtag/core.git

rm -rf "$WORK_DIR"
