#!/bin/bash

drawSeparator()
{
  echo '============================================================'
}

deleteTabs() {
	# удаление табуляций
	echo "${1//"	"/}"
	# -----------------
}

showError()
{
  echo -en "$(tput setaf 9)$(deleteTabs "$1")$(tput sgr0)\n"
}