Alteris
=======================

Test kompetencji.

### Baza danych

Migracje wykonane za pomocą biblioteki https://github.com/vgarvardt/ZfSimpleMigrations .

Wymagania to:
* skonfigurowany adapter bazy danych (PDO MySql),
* zftool.

Migrację uruchamiamy za pomocą:
> zf2 migration apply

.\vendor\bin\doctrine-module.bat orm:convert-mapping --namespace="Task\Entity\\" --force  --from-database annotation ./module/Task/src/
.\vendor\bin\doctrine-module.bat orm:generate-entities ./module/Task/src/ --generate-annotations=true


