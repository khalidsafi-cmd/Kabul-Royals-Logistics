CREATE TABLE IF NOT EXISTS careers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    requirements TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO careers (title, description, requirements) VALUES
('Logistics Coordinator', 'Responsible for coordinating logistics operations.', 'Bachelors degree in Logistics or related field.'),
('Warehouse Manager', 'Oversees warehouse operations and inventory management.', 'Experience in warehouse management and leadership skills.'),
('Supply Chain Analyst', 'Analyzes supply chain data to improve efficiency.', 'Strong analytical skills and experience with supply chain software.');

CREATE TABLE IF NOT EXISTS applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    resume TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (job_id) REFERENCES careers(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert admin user with a hashed password
INSERT INTO admins (username, password) 
VALUES ('baharanoorzai', '13b5e30edf8e14b52dd8cca04909aa4c05177d51');

