# My PHP Application

This project is a PHP application that runs in a Docker environment. It consists of two main components: the PHP application itself and a database service.

## Project Structure

```
App_Stock/
├── Documentation/
├── backup_frontend_php/
├── database/
├── db/
├── frontend-php/
├── nginx/
├── README.md
├── docker-compose.yml
├── settings.json
├── start.ps1
├── start.sh
├── stop.bat
├── stop.sh
├── update-code.sh
├── update.bat
├── update.ps1



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

3. Access the application at `http://localhost:8081/login`.

## Usage

- The PHP application can be accessed through the web browser.
- The database service is configured to work with the PHP application and can be accessed internally.

## Contributing

Feel free to submit issues or pull requests for any improvements or bug fixes.
