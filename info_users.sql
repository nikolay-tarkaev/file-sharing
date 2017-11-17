USE database_name;
CREATE TABLE IF NOT EXISTS info_users(id int AUTO_INCREMENT, user_id int, user_firstname varchar(30), user_lastname varchar(30), user_sex char(1), day_of_born int(2), month_of_born int(2), year_of_born int(4), PRIMARY KEY(id), FOREIGN KEY(user_id) REFERENCES users(id));
