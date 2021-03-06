<?php
require_once 'cli-terminal.php';

# Create Command
function mk_cmd(){  $colors = new Colors();
	echo clean_color($colors->getColoredString("[ Suggestion Create Command ] create | mk", "brown", "") . "\n");

	echo clean_color($colors->getColoredString("create controller:controllername", "green", "") . "	Create controller\n");
	echo clean_color($colors->getColoredString("create model:modelname		", "green", "") . "	Create model\n");
	echo clean_color($colors->getColoredString("create library:libraryname	", "green", "") . "	Create library\n");
	echo clean_color($colors->getColoredString("create package:packagename	", "green", "") . "	Create package\n");
	echo clean_color($colors->getColoredString("create extender:extendername	", "green", "") . "	Create extender\n\n");

	# Create Command
	echo clean_color($colors->getColoredString("[ Suggestion Create API CRUD ]", "brown", "") . "\n");

	echo clean_color($colors->getColoredString("create api:apiname 		", "green", "") . "	Create api CRUD\n\n");
}
# Remove Command
function rm_cmd(){  $colors = new Colors();
	echo clean_color($colors->getColoredString("[ Suggestion Remove Command ] remove | rm", "brown", "") . "\n");

	echo clean_color($colors->getColoredString("remove controller:controllername", "green", "") . "	Remove controller\n");
	echo clean_color($colors->getColoredString("remove model:modelname		", "green", "") . "	Remove model\n");
	echo clean_color($colors->getColoredString("remove library:libraryname	", "green", "") . "	Remove library\n");
	echo clean_color($colors->getColoredString("remove package:packagename	", "green", "") . "	Remove package\n");
	echo clean_color($colors->getColoredString("remove extender:extendername	", "green", "") . "	Remove extender\n");
	echo clean_color($colors->getColoredString("remove module:modulename	", "green", "") . "	Remove module\n");
	echo clean_color($colors->getColoredString("remove api:apiname		", "green", "") . "	Remove api CRUD\n");
	echo clean_color($colors->getColoredString("remove api:apiname -t		", "green", "") . "	Remove api CRUD with table\n\n");
}
# Show | List Command
function ls_cmd(){  $colors = new Colors();
	echo clean_color($colors->getColoredString("[ Suggestion List Command ] show | list | ls", "brown", "") . "\n");

	echo clean_color($colors->getColoredString("ls controllers			", "green", "") . "	List controller\n");
	echo clean_color($colors->getColoredString("ls models 			", "green", "") . "	List model\n");
	echo clean_color($colors->getColoredString("ls libraries 			", "green", "") . "	List library\n");
	echo clean_color($colors->getColoredString("ls packages 			", "green", "") . "	List package\n");
	echo clean_color($colors->getColoredString("ls extenders 			", "green", "") . "	List extender\n");
	echo clean_color($colors->getColoredString("ls modules 			", "green", "") . "	List module\n\n");
}
# Explain Command
function exp_cmd(){  $colors = new Colors();
	echo clean_color($colors->getColoredString("[ Suggestion Explain Command ] explain | exp", "brown", "") . "\n");

	echo clean_color($colors->getColoredString("explain routes:all		", "green", "") . "	Show all routes\n");
	echo clean_color($colors->getColoredString("explain routes:get		", "green", "") . "	Show GET routes\n");
	echo clean_color($colors->getColoredString("explain routes:post		", "green", "") . "	Show POST routes\n");
	echo clean_color($colors->getColoredString("explain routes:put		", "green", "") . "	Show PUT routes\n");
	echo clean_color($colors->getColoredString("explain routes:delete		", "green", "") . "	Show DELETE routes\n");
	echo clean_color($colors->getColoredString("explain routes:page		", "green", "") . "	Show PAGE routes\n");
	echo clean_color($colors->getColoredString("explain extender:extendername	", "green", "") . "	Explain extender routes\n");
	echo clean_color($colors->getColoredString("explain module:modulename	", "green", "") . "	Explain module routes\n\n");
}
# Compile Command
function compile_cmd(){  $colors = new Colors();
	echo clean_color($colors->getColoredString("[ Suggestion Compile Extender Command ] compile | exe", "brown", "") . "\n");

	echo clean_color($colors->getColoredString("compile extender		", "green", "") . "	Moving all extender to init\n");
	echo clean_color($colors->getColoredString("compile extender:filename	", "green", "") . "	Moving extender to init\n\n");
}
# Import Command
function imp_cmd(){  $colors = new Colors();
	echo clean_color($colors->getColoredString("[ Suggestion Import Command ] import | imp", "brown", "") . "\n");

	echo clean_color($colors->getColoredString("import package:packagename	", "green", "") . "	Import package\n");
	echo clean_color($colors->getColoredString("import module:modulename	", "green", "") . "	Import module\n\n");
}
function push_cmd(){  $colors = new Colors();
	echo clean_color($colors->getColoredString("[ Suggestion Push Command ] push", "brown", "") . "\n");

	echo clean_color($colors->getColoredString("push model:test		", "green", "") . "	To Push \n\n");
}
function pull_cmd(){  $colors = new Colors();
	echo clean_color($colors->getColoredString("[ Suggestion Pull Command ] pull", "brown", "") . "\n");

	echo clean_color($colors->getColoredString("pull model:test		", "green", "") . "	To pull \n\n");
}
function editor_cmd(){  $colors = new Colors();
	echo clean_color($colors->getColoredString("[ Suggestion Editor Command ] nano | subl", "brown", "") . "\n");

	echo clean_color($colors->getColoredString("nano model:test		", "green", "") . "	To edit \n\n");
}
# Curl Command
function curl_cmd(){  $colors = new Colors();
	echo clean_color($colors->getColoredString("[ Suggestion Curl Command ] curl", "brown", "") . "\n");

	echo clean_color($colors->getColoredString("curl get:fullurl		", "green", "") . "	Get url results\n\n");
}
# Remote Service Command
function remote_cmd(){  $colors = new Colors();
	echo clean_color($colors->getColoredString("[ Suggestion Remote Service Command ] remote | -i", "brown", "") . "\n");

	echo clean_color($colors->getColoredString("remote domain.com		", "green", "") . "	Remote sh service\n\n");
}
# Server PORT Command
function server_cmd(){  $colors = new Colors();
	echo clean_color($colors->getColoredString("[ Suggestion Server Command ] server | -s", "brown", "") . "\n");

	echo clean_color($colors->getColoredString("server port:8080		", "green", "") . "	Create new server\n");
}
