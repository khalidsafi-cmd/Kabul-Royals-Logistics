
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
- **Password:** `123456`

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

---

## Folder Structure
```
Kabul-Royals-Logistics/
│
├── admin/
│   ├── add-job.php
│   ├── dashboard.php
│   ├── edit-job.php
│   ├── delete-job.php
│   ├── logout.php
│
├── components/
│   ├── header.php
│   ├── footer.php
│
├── config/
│   ├── db.php
│
├── css/
│   ├── style.css
│
├── database/
│   ├── kabul_royals_logistics.sql
│
├── lib/
│   ├── easing/
│   ├── waypoints/
│
├── js/
│   ├── main.js
│
├── index.php
├── login.php
├── career.php
├── apply.php
```

---

## Troubleshooting

### Common Issues

1. **Database Connection Error:**
   - Ensure the database credentials in `config/db.php` match your local setup.
   - Default credentials for XAMPP:
     - **Username:** `root`
     - **Password:** (leave empty)

2. **Page Not Found:**
   - Ensure the project folder is placed in the `htdocs` directory.
   - Access the application via `http://localhost/Kabul-Royals-Logistics/`.

3. **Admin Login Fails:**
   - Ensure the `admins` table contains the correct username and hashed password.
   - Use the following SQL to reset the admin credentials:
     ```sql
     UPDATE admins SET password = '$2y$10$wH8Q9z9Q9z9Q9z9Q9z9Q9z9Q9z9Q9z9Q9z9Q9z9Q9z9Q9z9Q9z9Q9' WHERE username = 'admin';
     ```
     The password will be reset to `123456`.

---

## License
This project is open-source and free to use for educational purposes.

---

Let me know if you encounter any issues!
