# Volunteer Management System

The Volunteer Management System is a web application that connects volunteers with non-profit organizations to facilitate community engagement and volunteer opportunities.

## Features

- User Sign Up and Sign In:
  - Individuals can sign up as volunteers.
  - Organizations can sign up to post events and engage with volunteers.
  - User authentication is implemented to secure user data.

- Volunteer Dashboard:
  - Volunteers can view upcoming events and opportunities.
  - Volunteers can register for events and view their registrations.
  
- Organization Dashboard:
  - Organizations can post events, including event details and volunteers needed.
  - Organizations can view registered volunteers for their events.
  
## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/kundnanl/volunteers_camp.git
   
2. Set up your web server (e.g., Apache, Nginx) to serve the project from the root directory.

3. Create a MySQL database named php and import the provided SQL file (database.sql) to set up the required tables.

4. Update database connection details in PHP files under private directory: volunteer_dashboard.php, organization_dashboard.php, register_event.php, view_volunteers.php.

5. Access the application through your web browser.

Folder Structure:

public/: Publicly accessible pages and assets.
private/: Private pages and scripts accessible after user authentication.
css/: Stylesheets for styling the application.
images/: Images used in the application.

Technologies Used:
PHP
MySQL
HTML
CSS

