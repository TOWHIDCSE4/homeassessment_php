# Simple Blog Feature

## Backend (PHP & PostgreSQL)

- Ensure you have PHP7 and PostgreSQL installed.
- Create a PostgreSQL database and update credentials in `backend/Database.php`.
- Use `composer install` to install any necessary dependencies. composer install `slim/slim `and `slim/psr7`
- Set up your web server (e.g., Apache or Nginx) to serve PHP files from the `backend` directory.
-run Run a local PHP server in your project directory: php -S localhost:8000

## Frontend (HTML/CSS)
- Simply open `frontend/index.html` and run different port.
- api call through `frontend ajax api request` and run `frontend site'

## Running the Application
1. Set up the backend as described above.
2. Open `frontend/index.html` in a web browser.

## Application Structure

- `backend/`: Contains PHP scripts for the REST API.
- `frontend/`: Contains HTML, CSS, and JavaScript for the frontend UI.

## Design Choices

- The backend uses PHP and PostgreSQL to handle data storage and retrieval.
- The frontend UI is kept simple and responsive using HTML, CSS, and jQuery.

