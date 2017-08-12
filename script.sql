USE db_name;
SET CHARACTER SET utf8;
CREATE TABLE IF NOT EXISTS model_files(id int AUTO_INCREMENT, file_name varchar(100), file_description longtext, file_passw varchar(255), file_number varchar(255), file_extension varchar(255), file_size varchar(255), PRIMARY KEY(id));
INSERT INTO model_files(file_name, file_description, file_passw, file_number, file_extension, file_size) values("Тестовый файл", "Здесь будет описание к файлу", "test", "00001", "rar", "71.12 KB");
INSERT INTO model_files(file_name, file_description, file_passw, file_number, file_extension, file_size) values("Второй файл", "Пароль для удаления всех тестовый файлов - test", "test", "00002", "exe", "426.27 KB");
INSERT INTO model_files(file_name, file_description, file_passw, file_number, file_extension, file_size) values("Не знаю как назвать", "", "test", "00003", "dll", "423.14 KB");
INSERT INTO model_files(file_name, file_description, file_passw, file_number, file_extension, file_size) values("Документ word", "Файл загружен для ...", "test", "00004", "docx", "21.92 KB");