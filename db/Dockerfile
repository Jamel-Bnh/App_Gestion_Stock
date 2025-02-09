FROM mysql:5.7

# Copy initialization scripts
COPY init.sql /docker-entrypoint-initdb.d/01-init.sql
COPY my.cnf /etc/mysql/conf.d/my.cnf
COPY init-permissions.sh /docker-entrypoint-initdb.d/00-init-permissions.sh

# Set correct permissions
RUN chmod +x /docker-entrypoint-initdb.d/00-init-permissions.sh && \
    chown -R mysql:mysql /docker-entrypoint-initdb.d/ && \
    sed -i 's/\r$//' /docker-entrypoint-initdb.d/00-init-permissions.sh