# CPanel-PHP-Backup  

This is a PHP based CPanel backup scripting solution I developed for one of my clients. I hope you find it useful.  

It uses the CPanel API 1 and API 2 PHP code base.  
https://documentation.CPanel.net/display/SDK/Guide+to+CPanel+API+1  
https://documentation.CPanel.net/display/SDK/Guide+to+CPanel+API+2  

This solution uses the CPanel cron job manager and schedules two scripts to run. One runs the backup.php file and the other runs the cleanup.php file. You could run them nightly, the first at 10pm and the second at 11pm.  

https://documentation.cpanel.net/display/ALD/Cron+Jobs  

This solution also requires: https://github.com/CPanelInc/xmlapi-php  

To set it up, you could create a folder off the root of your CPanel home directory called "bin" and save all the files in there.  

Rename the file xmlapi.php to xmlapi.php.inc  

You need to edit the config.php.inc file and enter the details for your particular CPanel account setup.  

The entries $backup_folder should specify the location where you want your backups to be saved to.  

You should also add that folder to your cpbackup-exclude.conf folder off the root of your home directory otherwise your full backup will include all your previous backups and keep growing.  

The entry $retention specifies how many days of backup you want to store. In my case I am storing 5 days worth of backups.  

strtotime("-5 days");  

The cron job entries are as follows:  
php -f /home/$youraccount/bin/backup.php  
php -f /home/$youraccount/bin/cleanup.php  



