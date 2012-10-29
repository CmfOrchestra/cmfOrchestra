If you are using Doctrine it automatically registers a listener for SchemaTool to create
the routing_translations table for your database backend, you only have to call:

php app/console doctrine:schema:update --dump-sql
php app/console doctrine:schema:update --force