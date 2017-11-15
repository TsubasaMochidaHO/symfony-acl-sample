symfony-acl-sample
==================

This is a symfony project to demonstrate an advanced use of the Symfony Security
ACL and SecurityBundle.

# The model

![Database Model](https://raw.githubusercontent.com/spelcaster/symfony-acl-sample/master/model/model.png)

# Setup the database

```shell
bin/console init:acl
bin/console doctrine:database:create
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load --append
```

# Start a development web server

```shell
php -S localhost:4444 web/app_dev.php
```

# Users

**User**: admin
**Password**: admin
**Roles**: ROLE_ADMIN

**User**: tesseract
**Password**: tesseract
**Roles**: ["ROLE_TESSERACT_OWNER", "ROLE_USER"]

**User**: foo
**Password**: foo
**Roles**: ["ROLE_TESSERACT_USER", "ROLE_USER"]

**User**: eigen
**Password**: eigen
**Roles**: ["ROLE_EIGEN_OWNER", "ROLE_USER"]

**User**: bar
**Password**: bar
**Roles**: ["ROLE_EIGEN_USER" "ROLE_USER"]

# TODO

- [ ] Allow the user to change the group profile in use (see Profile::groupProfile)
- [ ] Create dynamic firewall rules to control access to routes
- [ ] Implement authorization checks in the Group\*Controller actions (this was
implemented only in the showAction)

# References

- [How to Load Security Users from the Database] (http://symfony.com/doc/current/security/entity_provider.html#security-serialize-equatable)
- [How to Implement a Simple Registration Form] (http://symfony.com/doc/current/doctrine/registration_form.html)
- [SecurityBundle Configuration] (https://symfony.com/doc/current/reference/configuration/security.html)
- [How to Work with Doctrine Associations / Relations](http://symfony.com/doc/current/doctrine/associations.html)
- [Doctrine Event Listeners and Subscribers](http://symfony.com/doc/current/doctrine/event_listeners_subscribers.html)
- [Basic Mapping](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/basic-mapping.html)
- [Association Mapping](docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/association-mapping.html#association-mapping)
- [Types](http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/types.html)
- [Using advanced Request matchers to activate firewall](https://matthiasnoback.nl/2012/07/symfony2-security-using-advanced-request-matchers-to-activate-firewalls/)
- [Creating dynamic roles (using RoleInterface)](https://matthiasnoback.nl/2012/07/symfony2-security-creating-dynamic-roles-using-roleinterface/)
- [Implementing ACL rules in your Data Fixtures](https://adayinthelifeof.nl/2012/07/04/symfony2-implementing-acl-rules-in-your-data-fixtures/)
