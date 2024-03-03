CREATE TABLE IF NOT EXISTS image (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL UNIQUE, 
    extension VARCHAR(5) NOT NULL,
    type VARCHAR(10) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT ck_restricted_type CHECK(type IN ('profile', 'thumbnail'))
);

CREATE TABLE IF NOT EXISTS user (
    id VARCHAR(64) DEFAULT(UUID()) PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    bio TEXT,
    img_id INT(11) DEFAULT(1),
    created_at DATETIME NOT NULL DEFAULT(CURRENT_TIMESTAMP),
    updated_at DATETIME NOT NULL DEFAULT(CURRENT_TIMESTAMP) ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_profile_img FOREIGN KEY (img_id) 
    REFERENCES image(id)
);

CREATE VIEW user_profile AS
SELECT  u.id, u.first_name, u.last_name, u.email, u.bio, u.created_at, u.updated_at, 
        i.id AS profile_img_id, i.file_name AS profile_img_name, i.extension AS profile_img_extension, i.type AS profile_img_type, i.created_at AS profile_img_created_at
FROM user AS u
LEFT JOIN image AS i
ON i.id = u.img_id;

CREATE TABLE IF NOT EXISTS cookie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    selector VARCHAR(255) NOT NULL,
    validator VARCHAR(255) NOT NULL,
    user_id VARCHAR(64) NOT NULL,
    expiry DATETIME NOT NULL,
    CONSTRAINT fk_user_id FOREIGN KEY (user_id)
    REFERENCES user (id) 
    ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS video (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(64) NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    extension VARCHAR(5) NOT NULL, 
    title VARCHAR(100) NOT NULL,
    description TEXT,
    thumbnail_id INT,
    created_at DATETIME NOT NULL DEFAULT(CURRENT_TIMESTAMP),
    updated_at DATETIME NOT NULL DEFAULT(CURRENT_TIMESTAMP) ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_vid_user_id FOREIGN KEY (user_id)
    REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT uq_complete_file_name UNIQUE(file_name, extension),
    CONSTRAINT fk_thumbnail_id FOREIGN KEY (thumbnail_id)
    REFERENCES image(id) 
    ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE VIEW video_preview AS 
SELECT v.id, i.id AS thumb_id, i.file_name AS thumb_name, i.extension AS thumb_extension, v.title, v.created_at AS upload_date, u.id AS author_id, u.first_name AS author_first_name, u.last_name AS author_last_name,
ip.id AS pic_id, ip.file_name AS pic_name, ip.extension AS pic_extension
FROM video AS v 
LEFT JOIN user AS u 
ON v.user_id = u.id 
LEFT JOIN image AS i
ON i.id = v.thumbnail_id
JOIN image AS ip
ON ip.id = u.img_id
ORDER BY v.created_at DESC;

CREATE VIEW show_video AS
SELECT v.id AS video_id, v.file_name AS video_name, v.extension AS video_extension, v.title, v.description, v.created_at AS upload_date,
u.id AS author_id, u.first_name AS author_first_name, u.last_name AS author_last_name,
i.id AS img_id, i.file_name AS img_name, i.extension AS img_extension
FROM video AS v
JOIN user AS u
ON u.id = v.user_id
JOIN image AS i
ON i.id = u.img_id;

CREATE TABLE IF NOT EXISTS comment (
    user_id VARCHAR(64),
    video_id INT,
    text TEXT,
    created_at DATETIME NOT NULL DEFAULT(CURRENT_TIMESTAMP),

    CONSTRAINT pk_comment PRIMARY KEY(user_id, video_id, created_at),
    CONSTRAINT fk_comment_user FOREIGN KEY (user_id) 
    REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_comment_video FOREIGN KEY (video_id) 
    REFERENCES video(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE VIEW video_comment AS
SELECT c.text AS comment_text, c.created_at AS comment_created_at, c.video_id,
       u.id AS user_id, u.first_name, u.last_name,
       ip.id AS pic_id, ip.file_name AS pic_name, ip.extension AS pic_extension
FROM comment AS c
JOIN video AS v 
ON v.id = c.video_id
JOIN user AS u 
ON u.id = c.user_id
JOIN image AS ip
ON ip.id = u.img_id
ORDER BY c.created_at DESC;