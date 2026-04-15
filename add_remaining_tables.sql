-- Create holidays table
CREATE TABLE IF NOT EXISTS holidays (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Add tgl_akhir_kegiatan column to surat table
ALTER TABLE surat ADD COLUMN tgl_akhir_kegiatan DATE NULL DEFAULT NULL;

-- Create configurasi table
CREATE TABLE IF NOT EXISTS configurasi (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(255) NOT NULL,
    value TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Add nama_kegiatan column to surat table
ALTER TABLE surat ADD COLUMN nama_kegiatan VARCHAR(255) NULL DEFAULT NULL;

-- Add file column to surat table
ALTER TABLE surat ADD COLUMN file VARCHAR(255) NULL DEFAULT NULL;

-- Create pegawais table
CREATE TABLE IF NOT EXISTS pegawais (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    nip VARCHAR(255) NOT NULL,
    jabatan VARCHAR(255) NULL DEFAULT NULL,
    pangkat VARCHAR(255) NULL DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Create st_pegawai table
CREATE TABLE IF NOT EXISTS st_pegawai (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pegawai_id BIGINT UNSIGNED NOT NULL,
    nomor_st VARCHAR(255) NOT NULL,
    tanggal_st DATE NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Create pegawai_st_pegawai table (pivot table)
CREATE TABLE IF NOT EXISTS pegawai_st_pegawai (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pegawai_id BIGINT UNSIGNED NOT NULL,
    st_pegawai_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Create ak_kredits table
CREATE TABLE IF NOT EXISTS ak_kredits (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);