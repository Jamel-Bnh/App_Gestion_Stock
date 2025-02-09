#!/bin/bash
set -e

# Copy the configuration file with the correct permissions
cp /etc/mysql/conf.d/custom.cnf /etc/mysql/conf.d/custom.cnf.tmp
chmod 644 /etc/mysql/conf.d/custom.cnf.tmp
mv /etc/mysql/conf.d/custom.cnf.tmp /etc/mysql/conf.d/custom.cnf

# Configure MySQL directories
mkdir -p /var/run/mysqld
mkdir -p /var/lib/mysql-files
chown -R mysql:mysql /var/run/mysqld
chown -R mysql:mysql /var/lib/mysql-files
chmod 755 /var/run/mysqld
chmod 750 /var/lib/mysql-files