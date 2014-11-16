#!/bin/bash

# El comando se ejecuta como 
# simpleskeletor.sh my_plugin_name
#



function cargarPlantilla() {
        if [[ ! -f "$1" ]]; then
                echo "404: Archivo $1 no encontrado"
		exit 1
        fi
        cp "$1" "$2"
        sed -i "s/\[\[NAME\]\]/${NAME}/g" "$2"
        
}

NAME=$1



mkdir -p ${NAME}/views/default/${NAME}
mkdir -p ${NAME}/views/default/forms/${NAME}
mkdir -p ${NAME}/views/default/object
mkdir -p ${NAME}/pages/${NAME}
mkdir -p ${NAME}/lib
mkdir -p ${NAME}/languages
mkdir -p ${NAME}/actions/${NAME}
mkdir -p ${NAME}/views/default/river/object/${NAME}
mkdir -p ${NAME}/views/default/widgets/${NAME}
mkdir -p ${NAME}/views/default/plugins/${NAME}
mkdir -p ${NAME}/views/default/input
cp -r plantillas/images ${NAME}/images


cargarPlantilla plantillas/plantilla.simple_start.php ${NAME}/start.php
cargarPlantilla plantillas/plantilla.manifest.xml ${NAME}/manifest.xml
cargarPlantilla plantillas/plantilla.README.txt ${NAME}/README.txt
cargarPlantilla plantillas/plantilla.en.php ${NAME}/languages/en.php
cargarPlantilla plantillas/plantilla.form_edit.php ${NAME}/views/default/forms/${NAME}/edit.php
cargarPlantilla plantillas/plantilla.pages_edit.php ${NAME}/pages/${NAME}/edit.php
cargarPlantilla plantillas/plantilla.pages_all.php ${NAME}/pages/${NAME}/all.php
cargarPlantilla plantillas/plantilla.actions_edit.php ${NAME}/actions/${NAME}/edit.php
cargarPlantilla plantillas/plantilla.pages_friends.php ${NAME}/pages/${NAME}/friends.php
cargarPlantilla plantillas/plantilla.pages_owner.php ${NAME}/pages/${NAME}/owner.php
cargarPlantilla plantillas/plantilla.views_object.php ${NAME}/views/default/object/${NAME}.php
cargarPlantilla plantillas/plantilla.pages_view.php ${NAME}/pages/${NAME}/view.php
cargarPlantilla plantillas/plantilla.views_river_object_create.php ${NAME}/views/default/river/object/${NAME}/create.php
cargarPlantilla plantillas/plantilla.views_sidebar.php ${NAME}/views/default/${NAME}/sidebar.php
cargarPlantilla plantillas/plantilla.views_group_module.php ${NAME}/views/default/${NAME}/group_module.php
cargarPlantilla plantillas/plantilla.views.input.auto_add_text.php ${NAME}/views/default/input/auto_add_text.php
cargarPlantilla plantillas/plantilla.actions_delete.php ${NAME}/actions/${NAME}/delete.php
cargarPlantilla plantillas/plantilla.views_widgets_content.php ${NAME}/views/default/widgets/${NAME}/content.php
cargarPlantilla plantillas/plantilla.views_widgets_edit.php ${NAME}/views/default/widgets/${NAME}/edit.php
cargarPlantilla plantillas/plantilla.views_plugins_settings.php ${NAME}/views/default/plugins/${NAME}/settings.php
cargarPlantilla plantillas/plantilla.lib.php ${NAME}/lib/${NAME}.php
cargarPlantilla plantillas/plantilla.lib.aat.php ${NAME}/lib/aat.php
cargarPlantilla plantillas/plantilla.views_icon.php ${NAME}/views/default/${NAME}/icon.php






