# database

Installare **XAMPP** su Windows (https://www.apachefriends.org/it/index.html).

Installare il database **POSTGRESQL** (https://www.postgresql.org/download/windows/ [download the installer])con PGADMIN. 

**ESEGUIRE IL SEGUENTE COMANDO PER CREARE IL DATABASE E LA TABELLA IN POSTGRESQL:**

```
CREATE DATABASE inventario;

CREATE TABLE collezione (
	id SERIAL NOT NULL,
	titolo varchar(255),
	artista varchar(255),
	anno int,
	etichetta varchar(255),
	tipo varchar(255),
	copertina varchar(5000),
	interno varchar(5000),
	PRIMARY KEY(id)
	);
```

**MODIFICHE AL FILE php.ini DELLA CARTELLA PHP IN C:\xampp**

**Togliere il commento (;) alle seguenti righe:**
```
extension=php_pdo_mysql.dll
extension=php_pdo_pgsql.dll
extension=php_pdo_sqlite.dll
extension=php_pgsql.dll
```
**Modificare questa riga:**
```
upload_max_filesize=50M
```

**MODIFICHE AL FILE httpd.conf DELLA CARTELLA APACHE IN C:\xampp**

**Aggiungere alla fine del file la seguente riga:**
```
LoadFile "C:\xampp\php\libpq.dll"
```
**ANDARE IN C:\xampp\htdocs**

Creare una nuova cartella dal nome "InventarioNicola" e creare dentro di essa un'altra cartella dal nome "inventarioImages".
