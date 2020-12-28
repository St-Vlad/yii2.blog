<?php

namespace app\blog\services;

use yii\rbac\DbManager;

class RoleManageService
{
    private DbManager $manager;

    public function __construct(DbManager $manager)
    {
        $this->manager = $manager;
    }

    public function assignRole($roleName, $userId)
    {
        $role = $this->manager->getRole($roleName);
        if (!$role) {
            throw new \DomainException('Role' . $roleName . 'does not exist');
        }
        $this->manager->revokeAll($userId);
        $this->manager->assign($role, $userId);
    }
}
