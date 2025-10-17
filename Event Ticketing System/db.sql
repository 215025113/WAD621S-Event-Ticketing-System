-- Database schema for Event Ticketing System
CREATE DATABASE IF NOT EXISTS event_ticketing;
USE event_ticketing;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('user','admin') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  description TEXT,
  venue VARCHAR(200),
  event_date DATE,
  capacity INT DEFAULT 100,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  event_id INT NOT NULL,
  seat_number VARCHAR(50),
  ticket_code VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);

-- sample admin user (password: admin123)
INSERT INTO users (name, email, password, role) VALUES ('Admin','admin@example.com', '{PASSWORD_PLACEHOLDER}', 'admin');

-- sample event
INSERT INTO events (title, description, venue, event_date, capacity) VALUES
('Campus Music Night', 'An evening of music by student bands.', 'Main Hall', '2025-11-15', 200);
