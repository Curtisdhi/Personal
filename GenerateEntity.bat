
@set /p entityPath= Enter entity's name: 
php app/console doctrine:generate:entity --entity=HyperionPersonalBundle:%entityPath%
@PAUSE