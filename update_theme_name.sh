#!/bin/bash

if [[ $# -eq 0 ]] ; then
	echo 'A new theme name is required. Call like this:'
	echo './update_theme_name.sh my_new_theme_name'
	echo 'replacing my_new_theme_name with the name you want to use.'
	exit 0
fi

THEME_NAME_LOWER=$(echo "$1" | tr '[:upper:]' '[:lower:]')

find . -type f \
	-not -path "*png" \
	-not -path "*jpg" \
	-not -path "*update_theme_name.sh*" \
	-not -path "*node_modules*" \
	-not -path "*dist*" \
	-not -path "*.git*" \
	-not -path "*.idea*" \
	| xargs sed -i '' -e "s/thinktimber/${THEME_NAME_LOWER}/g"

mv "languages/thinktimber.pot" "languages/${THEME_NAME_LOWER}.pot"

THEME_NAME_UPPER=$(echo "${THEME_NAME_LOWER:0:1}" | tr '[:lower:]' '[:upper:]')${THEME_NAME_LOWER:1}

find . -name "*.php" \
  | xargs sed -i '' -e "s/StarterSite/${THEME_NAME_UPPER}Site/g"

mv "src/StarterSite.php" "${THEME_NAME_UPPER}Site.php"

rm update_theme_name.sh
