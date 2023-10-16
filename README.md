# symfony-user-permission

```console
composer require ggbb/symfony-user-permission
```

```console
php bin/console role:create-default-user-role
```

```
// ggbb_user_role.yaml
ggbb_user_permission:
    entity:
        user: App\Entity\User
        user_role: App\Entity\UserRole
    ...
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