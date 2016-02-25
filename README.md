# simple-dyndns-server
Simple dynamic DNS record server

This program will allow you to add or update server names and its IPs without
accessing the actual DNS records. This script can be used to keep track of the
ip of a self-hosted Dynamic DNS server and it should be located in a "known
location".

This simple script has 4 functions:
 - Returns curren client IP
 - Saves designated IP to specified server register
    -- requires POST: key, server, ip
 - Returns last registered IP of specified server
    -- requires POST: key, server
 - Returns all registered servers and last IP addresses
    -- requires POST: key

All data is returned in JSON format.

## Installation
1 Download and install GIT, Apache2 and PHP5.
2 Go to the location on the server where you want the scrpt.
```
cd /var/www/html
```
3 Clone the project.
```
git clone https://github.com/devalfrz/simple-dyndns-server
```
4 Create the database and change the owner or change permissions on the db file.
```
touch simple-dyndns-server/db.csv
chown www-data:www-data simple-dyndns-server/db.csv
```

## Testing
There is a simple tool that can be used to test the content of the server.
```
http://localhost/simple-dyndns-server/test.html
```
![Testing Tool](http://behuns.com/media/simple-dynds-server/testing-tool.png?1 "Testing Tool")

## Managing the database
This is a simple tool that is intended for personal or testing purposes, the only
way to delete information from the database is to edit the `db.csv` file manually.

