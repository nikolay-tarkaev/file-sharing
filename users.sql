USE database_name;
CREATE TABLE IF NOT EXISTS users(id int AUTO_INCREMENT, user_login varchar(30), user_password varchar(255), user_email varchar(255), user_status varchar(15), user_ip varchar(15), date_reg varchar(10), user_delete int(1), PRIMARY KEY(id));
