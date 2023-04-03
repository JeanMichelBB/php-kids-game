# Kid's game

## About this project

This project is a game for kids, where they can learn about the alphabet and numbers.

## Stack

- PHP 7.4
- Bootstrap 4
- MySQL 8.0.32 - MySQL Community Server
- Docker

## How to run this project
### If you are using XAMPP

1. Go to the XAMPP directory and choose the folder `htdocs`

2. Open your Command line, right click and chose the option `Open in Terminal`

3. Clone this repository running in your Command line:
    
    ```bash
      git clone https://github.com/anyruizd/php-final-project.git
    ```
4. Access the website in http://localhost/php-final-project


### If you are using Docker 
1. Install [Docker](https://www.docker.com/) on your machine
2. Clone this repository running:
    
    ```bash
      git clone https://github.com/anyruizd/php-final-project.git
    ```
3. In the main folder of the project run: 
   
   ```bash
    docker-compose up -d
    ```
4. Go to [this file](db/login_info.php), uncomment the credentials for Docker and comment the credentials for XAMPP
4. Access the website in http://localhost
5. Access the phpmyadmin in http://localhost:8000
6. Stop the project with
 
    ```bash
     docker-compose down
     ```

## Contributors

- [Any](https://github.com/anyruizd)
  - Level 1 and 2
  - Game structure
  - Database components
  - Project & HTML structure
  - Overall layout and styles
  - Validation auth forms
- [Jean-Michel](https://github.com/JeanMichelBB)
  - Level 3 and 4
  - Login, Registration and Change password forms and validation
  - Database components
  - Game over page
  - Project setup
  - Validation game forms
- [Allan](https://github.com/allanbarcelos)
  - Level 5 and 6
  - Login, Registration and Change password forms html and styles
  - Project setup
