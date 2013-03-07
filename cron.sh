# This file is for gzipping and zipping the images so that 
# prospective mirror owners can download them. I have it on a once-a-day cron
# job, but you could run it every minute if you really wanted.
#
gzip /var/www/magicmirror/img/*
zip /var/www/magicmirror/vault.zip /var/www/magicmirror/img/*
gunzip /var/www/magicmirror/img/*
