# iiSpeed

### Prerequisite

Debian/Ubuntu users:

Step 1: `sudo apt-get update && sudo apt-get upgrade -y`

Step 2: `sudo apt-get install apache2 php5 libapache2-mod-php5 mysql-client mysql-server php5-mysql python-mysqldb -y`

Step 3: `sudo pip install speedtest-cli`

CentOS 7 users:

Step 1: `yum install httpd mariadb-server mariadb-libs php-mysql php-cli python2-pip -y`

Step 2: `systemctl enable httpd mariadb && systemctl start httpd mariadb`

Step 3: Follow secure install guide for MariaDB here: https://mariadb.com/kb/en/mariadb/mysql_secure_installation/

### MySQL

Step 1: `mysql -h localhost -u root -p` 

    CREATE DATABASE iiSpeed;  
    CREATE USER 'iiSpeed'@'localhost' IDENTIFIED BY 'password'; 
    GRANT ALL PRIVILEGES ON iiSpeed.* TO 'iiSpeed'@'localhost'; 
    FLUSH PRIVILEGES;
    USE iiSpeed;
    CREATE TABLE data ( sample_date_utc bigint unsigned, ping decimal(8,3), downspeed decimal(12,6), upspeed decimal(12,6) );
    QUIT;

### speedtest-cli

Step 1: `sudo mkdir /usr/local/sbin/iiSpeed && cp speedtest_cli.py /usr/local/sbin/iiSpeed/`

Step 2: `sudo chmod 775 /usr/local/sbin/iiSpeed/speedtest_cli.py`

Step 3: `sudo echo '*/20 * * * * root /usr/local/sbin/iiSpeed/speedtest_cli.py' > /etc/cron.d/iispeed_cron`

### Verify (Wait 1 hour)

Step 1: `mysql -h localhost -u iiSpeed -p`

    USE iiSpeed;
    SELECT * FROM data;
    QUIT;

### Webpage

Step 1: `sudo mkdir /var/www/html/iispeed && mv index.php /var/www/html/iispeed/`

Step 2: Copy your MySQL password for iiSpeed user:
        `sudo vi /var/www/html/iispeed/index.php`
