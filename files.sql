USE database_name;
CREATE TABLE IF NOT EXISTS files(id int AUTO_INCREMENT, file_name varchar(100), file_description longtext, file_passw varchar(255), file_number varchar(255), file_extension varchar(255), file_size varchar(255), uploaded_by_user varchar(30), date_upload varchar(30), PRIMARY KEY(id));
