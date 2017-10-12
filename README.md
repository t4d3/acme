# acme
School assignments for BYU-Idaho CIT 336 (Spring, 2017 - Bro. Robertson)

Get it up and running in linux in no time!
---
Required packages:
> sudo apt-get install __apache2 php5 php5-mysql mysql-server__

clone it into /var/www/html/
> git clone https://github.com/t4d3/acme /var/www/html/acme

Add the acme database into mySQL, add the user, and import the tables
> CREATE DATABASE acme; \
> GRANT ALL on acme.* TO 'iClient'@'localhost' IDENTIFIED BY 'M9dWfazqKFV9HFyt'; \
> exit
>
> mysql -u root -p acme < /var/www/html/acme/sql/acmeFINAL.sql

If apache and mysql is running, you should be good to go!
> sudo service apache2 restart

It should now be viewable at http://localhost/acme
