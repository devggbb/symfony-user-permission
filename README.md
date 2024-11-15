# SymfonyUserPermission
This bundle extends the capabilities of the standard Symfony security mechanism by adding custom access rights for roles.

## Installation
Installation from composer
```console
composer require ggbb/symfony-user-permission
```

config/packages/ggbb_user_permission.yaml
```yaml
ggbb_user_permission:
  entity:
    user: App\Entity\User
    user_role: App\Entity\UserRole
  mapping:
    permissions_dir: '%kernel.project_dir%/src/Permission'
    namespace: App\Permission
```

config/packages/security.yaml
```yaml
security:
  providers:
    users:
      id: ggbb.user_permission.user_provider
  access_decision_manager:
    strategy: unanimous
  # ...
```

.../UserRepository.php
```php
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface, UserLoaderInterface
{
    use UserRoleUserLoaderTrait;
    ...
}
```

.../User.php
```php
class User implements UserInterface, UserRoleFieldInterface
{
    use GetRolesMethodTrait;
    ...
}
```

.../UserRole.php
```php
namespace App\Entity;

#[ORM\Entity(repositoryClass: UserRoleRepository::class)]
class UserRole implements UserRoleInterface
{
    use RoleFieldTrait;
    use RolePermissionFieldTrait;
    ...
}
```


## Using
### Creating and assigning default roles for users
```console
php bin/console role:create-default-user-role
```

### Application in the controller
```php
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class YourController extends AbstractController
{
    public function yourAction(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            // ...
        }

        $object = ...;
        if ($this->isGranted('EDIT', $object)) {
            // ...
        }

        return new Response('...');
    }
}
```

### Usage in the api-platform
```php
#[Patch(
    security: "is_granted('PostPermission::EDIT') or is_granted('PostPermission::MY_EDIT', object.getAddedByUser())",
)]
class Post
{
    // ...
}
```

### Creating permissions
.../src/Permission/MyPermission.php
```php
<?php

namespace App\Permission;

use Ggbb\SymfonyUserPermissionBundle\Permission\AbstractPermission;

class PostPermission extends AbstractPermission
{
    public const VIEW = 'PostPermission::VIEW';
    public const ADD = 'PostPermission::ADD';
    public const EDIT = 'PostPermission::EDIT';
    public const MY_EDIT = 'PostPermission::MY_EDIT';
    public const DELETE = 'PostPermission::DELETE';


    public function getPermissions(): array
    {
        return [
            self::VIEW => [
                'title' => 'Просмотр всех объектов',
            ],
            self::ADD => [
                'title' => 'Добавить объект',
            ],
            self::EDIT => [
                'title' => 'Отредактировать все объекты',
            ],
            self::DELETE => [
                'title' => 'Удалить все объекты',
            ],
        ];
    }

    public function getName(): string
    {
        return 'Объекты';
    }
}

```
