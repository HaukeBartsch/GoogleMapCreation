#!/bin/sh

# INSTALLATION:
# create a user processing with home /home/processing
# copy this script the the directory /home/processing/src/GoogleMapCreation/
# install git
# run the script
#

website=$HOME/GoogleMapCreation
# location for git to push to
here=`pwd`

git config --global user.name `whoami`

echo "create site at $website"
mkdir -p $website

git init
git add .
git commit -m "create GoogleMapCreation application directory"
chmod -R 777 .
echo "done"

cd $here
mkdir GoogleMapCreation_hub.git
cd GoogleMapCreation_hub.git
git --bare init
echo "done"

echo "connect hub with GoogleMapCreation"
cd $website
git remote add hub $here/GoogleMapCreation_hub.git
git remote show hub
git push hub master
echo "done"

cd $here/GoogleMapCreation_hub.git/hooks
cat > post-update <<EOT
#!/bin/sh

echo
echo "*** Pulling changes into Prime [Hub's post-update hook]"
echo

cd $website || exit
unset GIT_DIR
git pull hub master

exec git-update-server-info
EOT
chmod +x $here/GoogleBrainMap_hub.git/hooks/post-update

cd $website/.git/hooks
cat > post-commit <<EOT
#!/bin/sh

echo
echo "**** pushing changes to Hub [Prime's post-commit hook]"
echo

git push hub
EOT
chmod +x $website/.git/hooks/post-commit


