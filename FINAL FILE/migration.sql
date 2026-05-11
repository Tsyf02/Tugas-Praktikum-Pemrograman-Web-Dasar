-- Add email column to user table (if not exists)
ALTER TABLE `user`
    ADD COLUMN IF NOT EXISTS `email`  VARCHAR(150) DEFAULT NULL AFTER `nama_lengkap`,
    ADD COLUMN IF NOT EXISTS `foto`   VARCHAR(255) DEFAULT NULL AFTER `email`,
    ADD COLUMN IF NOT EXISTS `bio`    TEXT          DEFAULT NULL AFTER `foto`;

-- Ensure penduduk table structure is correct
-- CREATE TABLE IF NOT EXISTS `penduduk` (
--   `id`     INT AUTO_INCREMENT PRIMARY KEY,
--   `nama`   VARCHAR(100) NOT NULL,
--   `alamat` VARCHAR(255) NOT NULL,
--   `nohp`   VARCHAR(20)  NOT NULL,
--   `jenis`  ENUM('Kost','Kontrak') NOT NULL DEFAULT 'Kost'
-- );

-- CREATE TABLE IF NOT EXISTS `user` (
--   `id`           INT AUTO_INCREMENT PRIMARY KEY,
--   `username`     VARCHAR(50)  NOT NULL UNIQUE,
--   `nama_lengkap` VARCHAR(100) NOT NULL,
--   `email`        VARCHAR(150) DEFAULT NULL,
--   `foto`         VARCHAR(255) DEFAULT NULL,
--   `bio`          TEXT         DEFAULT NULL,
--   `password`     VARCHAR(32)  NOT NULL,  -- MD5 hash
--   `role`         ENUM('admin','user') NOT NULL DEFAULT 'user'
-- );

-- Default admin account (password: admin123)
-- INSERT IGNORE INTO `user` (username, nama_lengkap, password, role)
-- VALUES ('sistem', 'Administrator', MD5('admin123'), 'admin');
