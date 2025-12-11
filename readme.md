
# Kabul Royals Logistics

## Project Overview
Kabul Royals Logistics is a web-based application designed to manage job postings and applications for a logistics company. It includes an admin panel for managing job postings and a public-facing careers page where users can view and apply for jobs.

---

## Project Setup Instructions

### 1. Clone the Repository
To get started, clone the repository to your local machine:
```bash
git clone https://github.com/your-username/Kabul-Royals-Logistics.git
```

### 2. Place the Project in the `htdocs` Directory
Move the project folder to your XAMPP `htdocs` directory:
```bash
c:/xampp/htdocs/Kabul-Royals-Logistics
```

### 3. Import the Database
To set up the database:
1. Open [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/) in your browser.
2. Create a new database named `kabul_royals_logistics`.
3. Import the `kabul_royals_logistics.sql` file located in the `database` folder of the project:
   ```
   kabul_royals_logistics.sql
   ```

### 4. Start the XAMPP Server
1. Open the XAMPP Control Panel.
2. Start the **Apache** and **MySQL** services.

### 5. Access the Application
- To access the **admin login page**, open your browser and go to:
  ```
  http://localhost/Kabul-Royals-Logistics/login.php
  ```

### 6. Admin Login Credentials
Use the following credentials to log in as an admin:
- **Username:** `admin`
- **Password:** `Royals@2025`

---

## Features

### Admin Panel
- **Add Job Postings:** Create new job postings with a title, description, and requirements.
- **Edit Job Postings:** Modify existing job postings.
- **Delete Job Postings:** Remove job postings from the system.

### Careers Page
- **View Job Postings:** Users can view all available job postings.
- **Apply for Jobs:** Users can submit their applications for specific job postings.

### Database Integration
- **Job Postings:** Stored in the `careers` table.
- **Applications:** Stored in the `applications` table.