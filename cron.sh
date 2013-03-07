# This file is a cron job for prospective mirror owners to run. It gzips and
# zips up the encrypted images so others can download them and help keep the 
# service up in case a server gets seized or w/e else happens that causes Magic 
# Mirror to go down.
gzip /var/www/magicmirror/img/*;
zip -9 /var/www/magicmirror/vault.zip /var/www/magicmirror/img/*;
gunzip /var/www/magicmirror/img/*;
