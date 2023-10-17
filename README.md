# symfony-user-permission

```console
composer require ggbb/symfony-user-permission
```

```console
php bin/console role:create-default-user-role
```

```
// ggbb_user_permission.yaml
ggbb_user_permission:
  entity:
    user: App\Entity\User
    user_role: App\Entity\UserRole
  mapping:
    permissions_dir: '%kernel.project_dir%/src/Permission'
    namespace: App\Permission
```

```
// security.yaml
security:
    providers:
        users:
            id: ggbb.user_permission.user_provider
    access_decision_manager:
        strategy: unanimous
    ...
```

```
// UserRepository.php
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface, UserLoaderInterface
{
    use UserRoleUserLoaderTrait;
    ...
}
```

```
// User.php
class User implements UserInterface, UserRoleFieldInterface
{
    use GetRolesMethodTrait;
    ...
}
```

```
// UserRole.php
namespace App\Entity;

#[ORM\Entity(repositoryClass: UserRoleRepository::class)]
class UserRole implements UserRoleInterface
{
    use RoleFieldTrait;
    use RolePermissionFieldTrait;
    ...
}
```

```
// src/Permission/MyPermission.php

```