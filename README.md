# Paso para ejecutar List Contact API
#### Cristobal Cordero 
#### Tiempo de realizacion 3:40H


1. crear base de datos

```sh
CREATE DATABASE Contact; 
```

### tabla

```sh

CREATE TABLE IF NOT EXISTS `Contacts` (
    `contactId` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(80) NOT NULL,
    `lastname` varchar(50) NOT NULL,
    `email` varchar(50),
    `phone` varchar(13),
    PRIMARY KEY (`contactId`)
    )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;

```

### datos de prueba

```sh

INSERT INTO `Contacts` (`contactId`, `name`, `lastname`,`email`, `phone`) VALUES
(1, 'John','Doe', 'johndoe@gmail.com', 80950112320),
(2, 'David',' Costa', 'sam.mraz1996@yahoo.com', 8095011229),
(3, 'Todd','Martell', 'liliane_hirt@gmail.com', 8095011236),
(4, 'Adela',' Marion', 'michael2004@yahoo.com', 8095011242);

```

2. levantar el sevidor

```sh
php -S 127.0.0.1:8080
```

3. Probar enpoint

**POST**

```sh
http://127.0.0.1:8080/api/v1/contacts.php

{
"name": "cristobal",
"lastname": "cordero",
"email": "cristobal6@yahoo.com",
"phone": "8095012132"
}
```

**GET**

```sh
http://127.0.0.1:8080/api/v1/contacts.php?page=1
```

**DELETE**

```sh
http://127.0.0.1:8080/api/v1/contacts.php

{
    "contactId": 1
}
```
