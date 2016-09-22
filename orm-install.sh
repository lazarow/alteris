./vendor/bin/doctrine-module orm:convert-mapping --namespace="Task\Entity\\" --force  --from-database annotation ./module/Task/src/
./vendor/bin/doctrine-module orm:generate-entities ./module/Task/src --generate-annotations=true
php ./public/index.php fix-entities
