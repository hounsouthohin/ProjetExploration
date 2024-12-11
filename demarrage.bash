cd /var/www/html/ProjetExploration/ProjetWeb/SiteStatistique/
sudo systemctl restart apache2
lxterm -e 'bash -c "cd /var/www/html/ProjetExploration/ProjetWeb/SiteStatistique/ && php artisan serv & sudo python3 /var/www/html/ProjetExploration/raspberry/script.py; read x"'


