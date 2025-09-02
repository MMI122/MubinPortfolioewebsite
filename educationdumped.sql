-- -- Create database
-- CREATE DATABASE education;

-- -- Use it
-- USE education;

-- Table for education timeline
CREATE TABLE education_timeline (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    institution VARCHAR(100) NOT NULL,
    year VARCHAR(50) NOT NULL,
    description TEXT,
    order_num INT DEFAULT 0
);

-- Insert sample data
INSERT INTO education_timeline (title, institution, year, description, order_num) VALUES
('Bachelor of Science in CS', 'University of Damascus', '2015 - 2020', 'Graduated with honors.', 1),
('Master in Web Development', 'Syrian Virtual University', '2020 - 2022', 'Specialized in full-stack.', 2);

-- Admin login table (simple, plain password)
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL  -- plain text
);

-- Insert admin user: admin / admin123
INSERT INTO admin_users (username, password) VALUES ('admin', 'admin123');