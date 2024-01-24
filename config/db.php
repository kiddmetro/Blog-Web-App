<?php
    session_start();
    $hostname ="localhost";
    $username = "root";
    $password = "";
    $database = "blog_database";

    mysqli_report(MYSQLI_REPORT_STRICT|MYSQLI_REPORT_ERROR); //This is needed to use oop on user data

    $db = new mysqli($hostname,$username,$password,$database);
    if($db->connect_error) echo "Unable to connect to database";
    // else echo "connection seccessful";

     //CREATE USER TABLE IN DATABASE
     $create_user_table = $db->query("CREATE TABLE IF NOT EXISTS users (
        user_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        user_image VARCHAR(50)  NOT NULL,
        username VARCHAR(50)  NOT NULL, 
        firstname VARCHAR(50)  NOT NULL, 
        lastname VARCHAR(50)  NOT NULL, 
        email VARCHAR(100)  NOT NULL,
        password VARCHAR(50)  NOT NULL,
        status TINYINT(5) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");

     //CREATE BLOG TABLE IN DATABASE
    $create_blog_table = $db->query("CREATE TABLE IF NOT EXISTS blogs (
        blog_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        image VARCHAR(50)  NOT NULL, 
        category VARCHAR(50)  NOT NULL, 
        title VARCHAR(255) NOT NULL, 
        author_name VARCHAR(100) NOT NULL,
        author_image VARCHAR(50)  NOT NULL,
        publication_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        formatted_date VARCHAR(15) NOT NULL,
        read_time VARCHAR(10)  NOT NULL,
        sample_text TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");


    //CREATE COMMENT TABLE IN DATABASE
    $create_comment_table = $db->query("CREATE TABLE IF NOT EXISTS comments (
        comment_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        blog_id INT,
        user_image VARCHAR(255) NOT NULL,
        user_id INT, 
        username VARCHAR(50) NOT NULL, 
        comment_text TEXT NOT NULL,
        comment_date DATETIME,
        parent_comment_id INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");

    // CREAT REPLIES TABLE IN DATABASE
    $create_replies_table = $db->query("CREATE TABLE IF NOT EXISTS replies (
        reply_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        blog_id INT,
        comment_id INT,
        user_id INT, 
        username VARCHAR(50) NOT NULL, 
        reply_text TEXT NOT NULL,
        reply_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");


?>