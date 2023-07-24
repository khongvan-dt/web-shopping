<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($conn, "shopping");

  
// sql to create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
  id int AUTO_INCREMENT PRIMARY KEY  not null,
  users_name varchar(50) not null,
  email varchar(100) not null,
  password varchar(100) not null
)";

if ($conn->query($sql) === false) {
    echo "Error creating table: " . $conn->error;
} 

// sql to create display table
$sql = "CREATE TABLE IF NOT EXISTS `display` (
  `id` int AUTO_INCREMENT PRIMARY KEY  not null,
  `img_logo` varchar(1000) not null,
  `title` varchar(500) not null
)";

if ($conn->query($sql) === false) {
    echo "Error creating table: " . $conn->error;
}

// sql to create category_admin table
$sql = "CREATE TABLE IF NOT EXISTS `category_admin` (
  `id` int AUTO_INCREMENT PRIMARY KEY not null,
  `category` varchar(100) not null
)";

if ($conn->query($sql) === false) {
    echo "Error creating table: " . $conn->error;
}

// sql to create logo table
$sql = "CREATE TABLE IF NOT EXISTS`logo` (
  `id` int AUTO_INCREMENT PRIMARY KEY not null,
  `name_shop` varchar(100) not null,
  `img` varchar(1000) not null
)";

if ($conn->query($sql) === false) {
    echo "Error creating table: " . $conn->error;
}

// sql to create users_admin table
$sql = "CREATE TABLE IF NOT EXISTS `users_admin` (
  `id` int AUTO_INCREMENT PRIMARY KEY  not null,
  `users_name` varchar(50) not null,
  `email` varchar(100) not null,
  `password` varchar(20) not null
)";

if ($conn->query($sql) === false) {
    echo "Error creating table: " . $conn->error;
}

// Tạo các loại sản phẩm 
$sql = "CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int AUTO_INCREMENT PRIMARY KEY   not null,
  `category_name` varchar(50) not null
)";

if ($conn->query($sql) === false) {
    echo "Error creating table: " . $conn->error;
}

//hãng sản phẩm 
$sql = "CREATE TABLE  IF NOT EXISTS `product_company` (
  `product_company_id` int AUTO_INCREMENT PRIMARY KEY  not null,
  `category_id2` int not null,
  `product_company_name` varchar (100) not null,
  FOREIGN KEY (`category_id2`) REFERENCES `categories`(`category_id`)
)";

if ($conn->query($sql) === false) {
    echo "Error creating table: " . $conn->error;
}

// sql to create products table
$sql = "CREATE TABLE  IF NOT EXISTS`products` (
  `product_id` int AUTO_INCREMENT PRIMARY KEY  not null,
  `category_id3` int not null,
  `product_company_id2` int not null,
  `name_sp` varchar(100) not null,
  `price` FLOAT not null,
  `discount` FLOAT not null,
  `img` varchar(500) not null,
  `description` varchar(1000) not null,
  FOREIGN KEY (`category_id3`) REFERENCES `categories`(`category_id`),
  FOREIGN KEY (`product_company_id2`) REFERENCES `product_company`(`product_company_id`)
)";

if ($conn->query($sql) === false) {
    echo "Error creating table: " . $conn->error;
}


// sql to create FeedBack table
$sql = "CREATE TABLE IF NOT EXISTS `FeedBack` (
  `id` int AUTO_INCREMENT PRIMARY KEY  not null,
  `user_id` int not null,
  `fullname` varchar(100) not null,
  `email` varchar(200) not null,
  `phone_number` varchar(10) not null,
  `subject_name` varchar(1000) not null,
  `note` varchar(500) not null,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
)";

if ($conn->query($sql) === false) {
    echo "Error creating table: " . $conn->error;
}

// sql to create Orders table
$sql = "CREATE TABLE  IF NOT EXISTS`Orders` (
  `order_id` int AUTO_INCREMENT PRIMARY KEY not null,
  `User_id` int not null,
  `fullname` varchar(100) not null,
  `phone_number` varchar(10) not null,
  `address` varchar(200) not null,
  `note` varchar(1000) not null,
  `order_date` DATETIME not null,
  FOREIGN KEY (`User_id`) REFERENCES `users`(`id`)
)";

if ($conn->query($sql) === false) {
    echo "Error creating table: " . $conn->error;
}
$sql = "CREATE TABLE if not exists Galery (
  Galery_id INT AUTO_INCREMENT PRIMARY KEY,
  product_id2 int not null,
  img2 VARCHAR(500) not null ,
  FOREIGN KEY (product_id2) REFERENCES Products(product_id)
)";
if ($conn->query($sql) === false) {
  echo "Lỗi khi tạo bảng Galery : " . mysqli_error($conn);
}
// sql to create Order_Details table
$sql = "CREATE TABLE IF NOT EXISTS `Order_Details` (
  `id` int AUTO_INCREMENT PRIMARY KEY not null,
  `order_id` int not null,
  `product_id` int not null,
  `num` int not null,
  `total_money` int not null,
  FOREIGN KEY (`order_id`) REFERENCES `Orders`(`order_id`),
  FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`)
)";

if ($conn->query($sql) === false) {
    echo "Error creating table: " . $conn->error;
}

?>
