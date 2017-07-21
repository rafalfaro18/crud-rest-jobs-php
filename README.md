# crud-rest-jobs-php
CRUD Rest Jobs MongoDB PHP Angular

Requerimientos:

+ Create a RESTful API using PHP. This API will expose CRUD operations for the following entities: candidate, resume, job position. Columns one each entity are up to you

+ Connect a MongoDB database to the API server for querying and persisting data

+ Create an admin web app using Angular, that will consume the API and create listing, add and edit pages for each data entity mentioned above

+ Desirable but not required: user authentication. Please add a readme file on the root of both projects with instructions on how to run it.


Instrucciones:

1. Instalar XAMPP 7.1.7 en Windows en la carpeta C:\xampp

2. Descargar http://windows.php.net/downloads/pecl/releases/mongodb/1.2.9/php_mongodb-1.2.9-7.1-ts-vc14-x86.zip y descomprimir el archivo .dll en la carpeta C:\xampp\php\ext

3. Renombrar el archivo descomprimido a php_mongo.dll

4. Editar el archivo php.ini y añadir la siguiente linea: extension=php_mongo.dll

5. Verificar que el directorio php de xampp C:\xampp\php se encuentre en las variables del sistema windows (PATH).

6. Iniciar XAMPP y el servidor apache.

7. Instalar MongoDB para Windows (https://fastdl.mongodb.org/win32/mongodb-win32-x86_64-2008plus-ssl-3.4.6-signed.msi) en la carpeta C:\

9. Permitir acceso en el firewall.

10. Crear la carpeta C:\data

11. Crear la carpeta C:\data\db

12. Abrir cmd y ejecutar: C:\mongodb\bin\mongod.exe

13. Abrir cmd y ejecutar: C:\mongodb\bin\mongo.exe

  13.1 Probar a insertar ejecutando: db.test.save({a:1}); db.test.find();

  13.2 Eliminar ejecutando: db.test.remove()


14. Descomprimir el proyecto https://github.com/rafalfaro18/crud-rest-jobs-php/archive/master.zip en C:\xampp\htdocs\

15. Navegar a localhost/crud-rest-jobs-php/index.php


