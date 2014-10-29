#!/bin/bash

# El comando se ejecuta como 
#elgg_plugin_skeletor.sh -name nombre_del_plugin -fields field1 field2...
# skeletor -nombre=tiki -campo_loquesea=text -campo_loquesea2=longtext ...



function cargarPlantilla() {
        if [[ ! -f "$1" ]]; then
                echo "404: Archivo $1 no encontrado"
		exit 1
        fi
        cp "$1" "$2"
        sed -i "s/\[\[NAME\]\]/${NAME}/g" "$2"
        sed -i "s/\[\[ARRAYFIELDS\]\]/${ARRAYFIELDS}/g" "$2"
}


# Borra hasta el =
function extraerValor() {
        echo "$@" | sed 's/[-a-zA-Z0-9_]*=//'
}

function extraerNombre () {
	echo "$@" | grep -ioE '\-[a-zA-Z_]*=' | sed 's/[=-]//g'
}
NAME=
ARRAYFIELDS=
for i in "$@"
do
case $i in
        -name=*)
                NAME=$(extraerValor $i)
        ;;
	-campo-*=*)
		ARRAYFIELDS="${ARRAYFIELDS}\'$(extraerNombre $i)\' => \'$(extraerValor $i)\',"
	;;
esac
done;

mkdir ${NAME}
mkdir ${NAME}/views
mkdir ${NAME}/views/default
mkdir ${NAME}/views/default/${NAME}
mkdir ${NAME}/views/default/forms
mkdir ${NAME}/views/default/forms/${NAME}
mkdir ${NAME}/views/default/object
mkdir ${NAME}/pages
mkdir ${NAME}/pages/${NAME}
mkdir ${NAME}/lib
mkdir ${NAME}/languages
mkdir ${NAME}/actions
mkdir ${NAME}/actions/${NAME}

cargarPlantilla plantillas/plantilla.start.php ${NAME}/start.php
cargarPlantilla plantillas/plantilla.manifest.xml ${NAME}/manifest.xml
cargarPlantilla plantillas/plantilla.README.txt ${NAME}/README.txt
cargarPlantilla plantillas/plantilla.en.php ${NAME}/languages/en.php
cargarPlantilla plantillas/plantilla.form_edit.php ${NAME}/views/default/forms/${NAME}/edit.php
cargarPlantilla plantillas/plantilla.pages_edit.php ${NAME}/pages/${NAME}/edit.php
cargarPlantilla plantillas/plantilla.pages_all.php ${NAME}/pages/${NAME}/all.php
cargarPlantilla plantillas/plantilla.actions_edit.php ${NAME}/actions/${NAME}/edit.php
cargarPlantilla plantillas/plantilla.pages_friends.php ${NAME}/pages/${NAME}/friends.php
cargarPlantilla plantillas/plantilla.pages_owner.php ${NAME}/pages/${NAME}/owner.php





