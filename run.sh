

#COLORES
green='\033[1;32m'
red='\e[;31m'
endcolor='\033[0m'
install_library='\033[1;31m'

#LIBRERIAS
php_installed=`which php`
php_curl_installed=`php -m | grep curl`
theharvester_installed=`which theHarvester`
kalitorify_installed=`which kalitorify`
php_xml_installed=`php -m | grep -i SimpleXML`

echo " "
echo "Checking necessary programs for D4TA-HUNTER"
echo "==========================================="

sleep 0.5

#Check as ROOT
if ! [ $(id -u) = 0 ]; 
    then 
        echo ""
        echo " ${red} EXECUTE AS ROOT!! ${endcolor}" 
        exit  
fi

#Check PHP
if [ -z $php_installed ] #si php_installed es vacío..
    then
        echo "PHP ${red} KO ${endcolor}"
        echo ""
        echo "${install_library} Put 'apt install php' on terminal ${endcolor}"
        exit
    else
        echo "PHP ${green} OK ${endcolor}"
fi

sleep 0.5

#Check PHP-CURL
if [ -z $php_curl_installed ]
    then
        echo "PHP CURL ${red} KO ${endcolor}"
        echo ""
        echo "${install_library} Put 'apt-get install php-curl' ${endcolor}"
        exit
    else
        echo "PHP-CURL ${green} OK ${endcolor}"
fi

sleep 0.5

#Check PHP-XML
if [ -z $php_xml_installed ]
    then
        echo "PHP XML ${red} KO ${endcolor}"
        echo ""
        echo "${install_library} Put 'apt-get install php-simplexml' ${endcolor}"
        exit
    else
        echo "PHP-XML ${green} OK ${endcolor}"
fi

sleep 0.5

#Check TheHarvester
if [ -z $theharvester_installed ]
    then
        echo "TheHarvester ${red} KO ${endcolor}"
        echo ""
        echo "${install_library} Put 'apt-get install theHarvester' ${endcolor}"
        exit
    else
        echo "TheHarvester ${green} OK ${endcolor}"
fi

sleep 0.5

#Check Kalitorify
if [ -z $kalitorify_installed ]
    then
        echo "Kalitorify ${red} KO ${endcolor}"
        echo ""
        echo "${install_library} Put 'git clone https://github.com/brainfucksec/kalitorify' on /OPT ${endcolor}"
        exit
    else
        echo "Kalitorify ${green} OK ${endcolor}"
fi

sleep 0.5

echo "BreachDirectory ${green} OK ${endcolor}"

sleep 1

echo " "
echo "Launching D4TA-HUNTER"
echo "======================"

sleep 1

#LAUNCH APACHE
/etc/init.d/apache2 restart

systemctl start apache2

sleep 1

echo "Apache Started"

sleep 1

  rm -r /var/www/html/D4ta-hunter/ #borramos el directorio y su contenido
  mkdir /var/www/html/D4ta-hunter/ #volvemos a crear el directorio
  mkdir /var/www/html/D4ta-hunter/theHarvester_results/
  cp -r * /var/www/html/D4ta-hunter/ #copiamos todos los archivos al nuevo directorio
  chmod 777 /var/www/html/D4ta-hunter/img/tor.gif #damos permisos a la imagen de tor para que pueda mostrarse
  chmod -R 777 /var/www/html/D4ta-hunter/
  
sleep 1

echo ""
echo "${red}HAPPY HUNT!!!${endcolor}"

xdg-open "http://localhost/D4ta-hunter/D4ta-hunter.php"

exit
