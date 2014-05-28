#! /bin/bash

#####  Drupal 6 -> 7 Upgrade Script ###########
#
# Attention: Before running this script, you 
# need to create a drush alias for the destination.
# Destination is an empty or non-existant
# folder and database to upgrade to.  In all 
# likelihood, you will need to run this script
# multiple times to correct bugs and issues
# as they pop up  The destination directory
# must be emptied prior to each run.  
#
##########################################

#We need drush to do anything:
drush 
if [ $? -gt 0 ]; then
	echo 'ERROR: You need Drush installed to run this script'
	exit;
fi


#Drush alias of the destination site.
#Must have a drupal root of an empty directory,
#and a db-url to an existing (empty) database
if [[ -z $1 ]]; then
  echo 'ERROR: No destination site specified'
  exit 1
fi

URL=`drush sa --component=db-url $1 --pipe` 
if [ $? -gt 0 ] || [[ -z $URL ]]; then
  echo 'ERROR: Bad destination alias or no alias database URL'
  exit 1
fi;

DEST_ALIAS=$1

#If you find any modules have problems on upgrade,
#enter them here and they will be excluded from the 
#manual upgrade process and tried manually once it
#is finished.
TROUBLE_MODULES_LONG="" #Names of modules to enable (ie: views views_ui)
TROUBLE_MODULES_SHORT="" #Shortnames of modules to download (ie: views)

DRUPAL_VERSION=`drush status drupal-version --pipe`

if  [ $? -gt 0 ] ||  [[ $DRUPAL_VERSION < 6 ]] || [[ $DRUPAL_VERSION > 6.99 ]]; then
  echo 'ERROR: You must run this script from a drupal 6 root directory'
  exit 1
fi

ORIGINAL_DRUPAL_ROOT=`drush dd`

#Path to rebuild.sh
cd $(dirname $0) && SCRIPT_DIR="$PWD" && cd - >/dev/null
REBUILD_SCRIPT=$SCRIPT_DIR/rebuild.sh

if [ ! -f $REBUILD_SCRIPT ]; then
  echo 'ERROR: Could not find rebuild.sh script.  Please check that it is in the proper location.'
  exit 1
fi;



#Upgrade to latest 6.x versions
#of core and all contrib modules
drush vset site_offline 1 -y --pipe
drush up -y
drush cc all
drush vset site_offline 0 -y --pipe


#Give the user a last chance to opt out:
CONTINUE=1
while [[ $CONTINUE -ne 0 ]]; do 
  echo -n "Drupal 6 site has been upgraded to the latest version.  Migrate to Drupal 7? (y/n)"
  read UINPUT
  if [ $UINPUT == 'y' ]; then
    echo "Proceeding with Drupal 7 migration:"
    CONTINUE=0
  elif [ $UINPUT == 'n' ]; then
    echo "Exiting..."
    exit
  fi
done

drush vset site_offline 1 -y --pipe
if [[ -n $TROUBLE_MODULES_LONG ]]; then
  echo 'Temporarily Disabling trouble modules on Drupal 6 Site'
	drush dis $TROUBLE_MODULES_LONG -y
fi 

# Create a new drupal root 
# and download all contrib modules
# that are enabled on the old site.
drush site-upgrade $DEST_ALIAS

# Re-enable the trouble modules for the D6
# site and put that site back online.
if [[ -n $TROUBLE_MODULES_LONG ]]; then
  echo 'Re-enabling trouble modules on Drupal 6 site'
	drush en $TROUBLE_MODULES_LONG -y
fi
drush vset site_offline 0 -y --pipe


#IMPORTANT: Rebuild the code registry 
#before continuing.  
cd `drush dd $DEST_ALIAS`
$REBUILD_SCRIPT

#Drush update the database and 
#clear the cache for good measure:
drush updb $DEST_ALIAS -y
drush cc all $DEST_ALIAS --pipe

#DL and re-enable the trouble modules:
if [[ -n $TROUBLE_MODULES_LONG ]]; then
  echo 'Retrying trouble modules'
	drush dl $TROUBLE_MODULES_SHORT  -y
	drush en $TROUBLE_MODULES_LONG -y
	drush updb $DEST_ALIAS -y
	drush updb $DEST_ALIAS -y
fi

#Copy the files directory from the D6 Site:
cd $ORIGINAL_DRUPAL_ROOT
drush rsync %files $DEST_ALIAS:%files

#Check if we should enable image to enable 
#migrating imagefields.  This still needs to be
#done manually through the UI.
#@see admin/structure/content_migrate
drush pm-info imagefield --pipe
IMAGEFIELD_6=&?
drush pm-info cck $DEST_ALIAS --pipe
CCK_7=&?

if [[ IMAGEFIELD_6 -e 0 ]] && [[ CCK_7 -e 0 ]]; then
  drush $DEST_ALIAS en image
fi

#Put the D7 Site online so we can view it:
drush vset maintenance_mode 0 $DEST_ALIAS -y --pipe
drush cc all $DEST_ALIAS -y --pipe
