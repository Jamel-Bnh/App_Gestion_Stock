#!/bin/bash
set -e

# Configure MySQL directories
mkdir -p /var/run/mysqld
mkdir -p /var/lib/mysql-files

# Set proper permissions
chown -R mysql:mysql /var/run/mysqld
chown -R mysql:mysql /var/lib/mysql-files
chmod 755 /var/run/mysqld
chmod 750 /var/lib/mysql-files

# Ensure proper MySQL socket directory permissions
touch /var/run/mysqld/mysqld.sock
chown mysql:mysql /var/run/mysqld/mysqld.sock
chmod 644 /var/run/mysqld/mysqld.sock