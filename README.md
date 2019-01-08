# database
<br />
Installare **XAMPP** su Windows (https://www.apachefriends.org/it/index.html).
<br />
Installare il database **POSTGRESQL** (https://www.postgresql.org/download/windows/ [download the installer])con PGADMIN. 
<br />
**ESEGUIRE IL SEGUENTE COMANDO PER CREARE IL DATABASE E LA TABELLA IN POSTGRESQL:**
<br />
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
<br />
**MODIFICHE AL FILE php.ini DELLA CARTELLA PHP IN C:\xampp**

**Togliere il commento (;) alle seguenti righe:**
<br />
extension=php_pdo_mysql.dll
<br />
extension=php_pdo_pgsql.dll
<br />
extension=php_pdo_sqlite.dll
<br />
extension=php_pgsql.dll

**Modificare questa riga:**
<br />
upload_max_filesize=50M


**MODIFICHE AL FILE httpd.conf DELLA CARTELLA APACHE IN C:\xampp**
<br />
**Aggiungere alla fine del file la seguente riga:**
<br />
LoadFile "C:\xampp\php\libpq.dll"

**ANDARE IN C:\xampp\htdocs**
<br />
Creare una nuova cartella dal nome "InventarioNicola" e creare dentro di essa un'altra cartella dal nome "inventarioImages".
