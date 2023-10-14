# symfony-user-permission

```console
composer require ggbb/symfony-user-permission
```

```
// ggbb_user_role.yaml
ggbb_user_permission:
  entity:
    user: App\Entity\User
    user_role: App\Entity\UserRole
```

```
// security.yaml
security:
    providers:
        users:
            id: Ggbb\SymfonyUserPermission\Security\UserProvider
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
```