# PS6-MySQL
Реализован простой веб чат. Данные которого хранятся в базе даных MySql.

1. Настройки к базе данных лежат в файле PS6-MySQL/app/config/dbConfig.php
2. Готовая база данных находится в файле PS6-MySQL/database/chat.sql
3. В базе данных есть две таблици:


    users структура :
    id - int(11) - AUTO_INCREMENT
    user_name - varchar(25)
    password - varchar(255)
    
    messages структура:
    id - int(11) - AUTO_INCREMENT
    id_user 	int(11) 
    message_date 	timestamp  current_timestamp()
    message 	varchar(255)  	 	
   