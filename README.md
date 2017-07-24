# crud-rest-jobs-php
CRUD Rest Jobs MongoDB PHP Angular

Requerimientos:

+ Create a RESTful API using PHP. This API will expose CRUD operations for the following entities: candidate, resume, job position. Columns one each entity are up to you

+ Connect a MongoDB database to the API server for querying and persisting data

+ Create an admin web app using Angular, that will consume the API and create listing, add and edit pages for each data entity mentioned above

+ Desirable but not required: user authentication. Please add a readme file on the root of both projects with instructions on how to run it.


Instrucciones de Instalacion:

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

  13.1 Probar a insertar documentos ejecutando: db.test.save({a:1}); db.test.find();

  13.2 Eliminar documento de prueba ejecutando: db.test.remove()


14. Instalar composer https://getcomposer.org/Composer-Setup.exe

15. Descomprimir el proyecto https://github.com/rafalfaro18/crud-rest-jobs-php/archive/master.zip en C:\xampp\htdocs\

16. Navegar a http://localhost/crud-rest-jobs-php/test.php para probar la conexion a la base de datos. Debe decir Ok: 1



Instrucciones de uso:

1. Navegar a http://localhost/crud-rest-jobs-php/#!/
2. Hacer click en ADD Candidate para añadir Candidatos.
3. Hacer click en Candidates para ver Candidatos.
  3.1 Dentro de la lista de Candidatos hacer click Edit para editar un Candidato.
4. Hacer click en ADD Job para añadir Puestos.
5. Hacer click en Jobs para ver Puestos.
  5.1 Dentro de la lista de Puestos hacer click Edit para editar un Puesto.
4. Hacer click en ADD Resume para añadir Curriculos. (Deben existir antes Candidatos)
5. Hacer click en Resumes para ver Curriculos.
  5.1 Dentro de la lista de Curriculos hacer click Edit para editar un Curriculos


Notas:

+ Para eliminar un elemento debe ir a editar y hacer click en Delete.
+ No acceder a los archivos .html del proyecto directamente, usar la navegación de la aplicación.