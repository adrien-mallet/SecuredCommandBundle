# SecuredContainerBundle

Symfony bundle to remove some command from the container

## Configuration example :
```
secured_container:
    unauthorized:
        - "doctrine.database_drop_command"
        - "doctrine.schema_drop_command"
        - "command.identifier"
```
