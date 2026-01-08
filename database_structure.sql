-- Database: session_php

-- Tabel user (sudah ada)
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default user
INSERT INTO `user` (`username`, `password`) VALUES
('admin', 'admin123');

-- Tabel mahasiswa (baru)
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `alamat` text,
  `telepon` varchar(15),
  `email` varchar(50),
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nim` (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data mahasiswa
INSERT INTO `mahasiswa` (`nim`, `nama`, `prodi`, `kelas`, `alamat`, `telepon`, `email`) VALUES
('A11.2024.15569', 'Nalendra Yogatama', 'Teknik Informatika', '4316', 'Surakarta', '081234567890', 'nalendra@student.ac.id'),
('A11.2024.15570', 'Budi Santoso', 'Teknik Informatika', '4316', 'Semarang', '082345678901', 'budi@student.ac.id'),
('A11.2024.15571', 'Siti Nurhaliza', 'Sistem Informasi', '4317', 'Yogyakarta', '083456789012', 'siti@student.ac.id');