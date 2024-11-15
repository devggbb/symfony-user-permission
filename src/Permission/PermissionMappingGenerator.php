<?php

declare(strict_types=1);

namespace Ggbb\SymfonyUserPermissionBundle\Permission;

final class PermissionMappingGenerator
{
    public static function generating(string $namespace, string $permissionsDirPath, ?string $middleDirPath = null): array
    {
        $files = [];
        /** @var \SplFileInfo $file */
        foreach (new \DirectoryIterator($permissionsDirPath) as $file) {
            if ($file->isFile()) {
                $typeFile = substr($file->getFilename(), -4);
                if ($typeFile !== '.php') {
                    continue;
                }

                $middleDirNamespace = '';
                if ($middleDirPath) {
                    $middleDirNamespace = str_replace('/', '\\', $middleDirPath);
                }

                $fileName = substr($file->getFilename(), 0, -4);
                $files[$fileName] = "{$namespace}{$middleDirNamespace}\\{$fileName}";
            }
            if ($file->isDir()) {
                if ($file->getRealPath() === $permissionsDirPath || in_array($file->getFilename(), ['..', '.'])) {
                    continue;
                }

                $middleDirName = str_replace($permissionsDirPath, '', $file->getRealPath());
                $files = array_merge($files, self::generating($namespace, $file->getRealPath(), "{$middleDirPath}{$middleDirName}"));
            }
        }
        return $files;
    }
}