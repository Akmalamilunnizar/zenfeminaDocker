ls -l ~/.ssh/github-actions
exit
ssh -i /root/.ssh/github-actions root@167.71.202.134
exit
mkdir -p /var/www/zenfemina
chown -R root:root /var/www/zenfemina
docker-compose up -d
cd /var/www/zenfemina
git clone git@github.com:Akmalamilunnizar/zenfeminaDocker.git /var/www/zenfemina
ssh-keygen -t ed25519 -C "vps-deploy"
cat /root/.ssh/id_ed25519.pub
git clone https://github.com/Akmalamilunnizar/zenfeminaDocker.git /var/www/zenfemina
cd /var/www/zenfemina
docker-compose up -d
docker exec -it app bash
docker exec -it php bash
docker ps
docker logs laravel_app
docker logs laravel_app --tail 50
exit
ssh -i /root/.ssh/github-actions root@167.71.202.134
chmod 600 /root/.ssh/github-actions
ssh -i /root/.ssh/github-actions root@167.71.202.134
docker logs laravel_app --tail 50
exit
docker ps -a
docker exec -it laravel_app bash
cd /var/www
npm install
npm run build
docker-compose build --no-cache
docker-compose up -d
exit
clear
mkdir -p ~/.ssh
nano ~/.ssh/authorized_keys
docker --version
docker-compose --version
sudo apt update
sudo apt upgrade -y
sudo apt install -y docker.io
sudo systemctl start docker
sudo systemctl enable docker
docker --version
sudo apt install -y docker-compose
sudo curl -L "https://github.com/docker/compose/releases/download/v2.18.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
docker-compose --version
sudo usermod -aG docker $USER
scp -i ~/.ssh/github-actions install_docker.sh root@167.71.202.134:~
scp -i ~/.ssh/github-actions "D:\Doc Tugas\Semester 6\Workshop Developer Operational\Ujian Devops 27 Mei\zenfeminaLaravel\install_docker.sh" root@167.71.202.134:~
ssh -i ~/.ssh/github-actions root@167.71.202.134
ssh -i ~/.ssh/github-actions root@167.71.202.134
sudo cp ~/.ssh/github-actions /root/.ssh/github-actions
sudo chmod 600 /root/.ssh/github-actions
ssh -i /root/.ssh/github-actions root@167.71.202.134
ls ~/.ssh/github-actions
sudo cp /home/uzumakisujai/.ssh/github-actions /root/.ssh/github-actions
sudo chmod 600 /root/.ssh/github-actions
sudo mkdir -p /root/.ssh
/home/uzumakisujai/.ssh/github-actions
ssh -i /root/.ssh/github-actions root@167.71.202.134
ssh -i /root/.ssh/github-actions root@167.71.202.134
docker ps -a | grep laravel_app
docker exec -it laravel_app bash
ls -l /var/www/zenfemina/.env
cp /var/www/zenfemina/.env.example /var/www/zenfemina/.env
nano /var/www/zenfemina/.env
docker exec -it laravel_app php artisan key:generate
docker ps -a | grep laravel_app
docker exec -it laravel_app composer install
docker logs laravel_app --follow
docker run --rm -v /var/www/zenfemina:/var/www/zenfemina -w /var/www/zenfemina laravelsail/php82-composer:latest composer install
nano docker-compose.yml
ls
ls -l /var/www/zenfemina/.env
cd /var/www/zenfedocker
[200~cd /var/www/zenfemina~
cd /var/www/zenfemina
ls
nano docker-compose.yml
docker-compose down
docker-compose up -d --build
docker ps
nano docker-compose.yml
:
docker-compose down
docker-compose up -d --build
docker ps
ls -l Dockerfile

docker-compose down --volumes
docker-compose build --no-cache
docker-compose up -d
docker ps
docker-compose up -d
ls
nano Dockerfile
nano .env
docker exec -it laravel_app php artisan key:generate
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
docker exec -it laravel_app php artisan migrate
nano default.conf
ls
nano docker\nginx\conf.d\default.conf
nano docker/nginx/conf.d/default.conf
docker-compose restart webserver
php artisan route:list | grep forgot
docker exec -it laravel_app tail -f storage/logs/laravel.log
docker exec -it laravel_app php artisan migrate --force
nano docker-compose.yml
nano .env
docker-compose down
docker-compose up -d --build
docker exec -it laravel_app php artisan migrate --force
nano docker-compose.yml
docker-compose down -v
docker-compose up -d --build
adocker exec -it laravel_app php artisan migrate --force
docker exec -it laravel_app php artisan migrate --force
npm install
npm run build
docker exec -it laravel_app bash
nano Dockerfile
docker-compose down
docker-compose up --build -d
cd /var/www/zenfemina
docker-compose build --no-cache
docker-compose up -d
ls public/static/images/bg/
nano .env
composer install
sudo apt update
sudo apt install php-cli unzip curl
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
composer install
nano .env
php artisan key:generate
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php8.2 php8.2-cli php8.2-mbstring php8.2-xml php8.2-bcmath php8.2-curl php8.2-mysql php8.2-zip unzip
sudo lsof -i :80
docker ps
sudo systemctl restart apache2
root@arvita8-10-06-2028:/var/www/zenfemina# sudo systemctl restart apache2
Job for apache2.service failed because the control process exited with error code.
See "systemctl status apache2.service" and "journalctl -xeu apache2.service" for details.
root@arvita8-10-06-2028:/var/www/zenfemina#
sudo apt install php8.2 php8.2-cli php8.2-mbstring php8.2-xml php8.2-bcmath php8.2-curl php8.2-mysql php8.2-zip unzip
sudo update-alternatives --set php /usr/bin/php8.2
php -v
composer install
php artisan key:generate
php artisan migrate:fresh
php artisan db:seed
php artisan serve
mysql -u root -p
sudo apt update
sudo apt install mysql-client-core-8.0
mysql -u root -p
nano .env
mysql -u root -p
dpkg -l | grep mysql-server
sudo apt update
sudo apt install mysql-server
sudo tail -n 50 /var/log/mysql/error.log
sudo journalctl -xe | grep mysql
sudo lsuf -i 3306
