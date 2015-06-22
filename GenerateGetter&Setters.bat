
@set /p entityPath= Enter entity's name: 
php app/console doctrine:generate:entities Hyperion/PersonalBundle/Entity/%entityPath%
@PAUSE