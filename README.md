Alteris
=======================

Test kompetencji.

### Baza danych

Migracje wykonane za pomocą biblioteki https://github.com/vgarvardt/ZfSimpleMigrations .

Wymagania:
* skonfigurowany adapter bazy danych (PDO MySql),
* zftool.

Migrację uruchamiamy za pomocą:
> zf2 migration apply

### Doctrine

Tworzenie mapy encji:
> .\vendor\bin\doctrine-module.bat orm:convert-mapping --namespace="Task\Entity\\" --force  --from-database annotation ./module/Task/src/

Uzupełnienie o metody:
> .\vendor\bin\doctrine-module.bat orm:generate-entities ./module/Task/src --generate-annotations=true

Fix wygenerowanych klas:
> php .\public\index.php fix-entities

Komendy dla Linux-a będą nieco inne (różnice w pisowni ścieżek).

