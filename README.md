# My PHP Application

This project is a PHP application that runs in a Docker environment. It consists of two main components: the PHP application itself and a database service.

## Project Structure

```
my-php-app :

AppStock_DMSP/
├── alertmanager/
├── backups/
├── db/
├── docker/
├── Documentation/
├── nginx/
│   └── nginx.conf
├── prometheus/
├── src/
│   └── frontend-php/
│       ├── controllers/
│       ├── public/
│       ├── tests/
│       ├── views/
│       │   ├── login.php
│       │   └── ...
│       ├── auth.php
│       ├── config.php
│       ├── config.php.bak
│       ├── datain.php
│       ├── Dockerfile
│       ├── index.php
│       ├── init-permissions.sh
│       ├── js_link.php
│       ├── menu.php
│       ├── myheader.php
│       ├── myheader.php.bak
│       ├── mysql.cnf
│       ├── php.ini
├── docker-compose.yml
├── README.md
├── start.bat
├── start.sh
├── stop.bat


## Getting Started

To get started with this project, you need to have Docker and Docker Compose installed on your machine.

### Setup

1. Clone the repository:
   ```
   git clone <repository-url>
   cd my-php-app
   ```

2. Build and run the application using Docker Compose:
   ```
   docker-compose-down
   docker-compose up --build
   ```

3. Access the application at `http://localhost:8080/login.php`.

## Usage

- The PHP application can be accessed through the web browser.
- The database service is configured to work with the PHP application and can be accessed internally.

## Contributing

Feel free to submit issues or pull requests for any improvements or bug fixes.
