<?php

namespace app\commands;

use app\blog\repositories\NotFoundException;
use app\blog\repositories\UserRepository;
use app\blog\roles\RbacRoles;
use app\blog\services\RoleManageService;
use http\Exception\RuntimeException;
use yii\console\Controller;

class AssignController extends Controller
{
    private $repositiry;
    private $service;

    public function __construct(
        $id,
        $module,
        UserRepository $repository,
        RoleManageService $service,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->repositiry = $repository;
        $this->service = $service;
    }

    public function actionIndex()
    {
        echo 'to assign admin role to user, type \'./yii assign/admin {user_id}\'' . PHP_EOL;
        echo 'to assign user role to user, type \'./yii assign/user {user_id}\'' . PHP_EOL;
    }

    public function actionAdmin($id)
    {
        $user = $this->getUser($id);
        $this->service->assignRole(RbacRoles::ADMIN, $user->id);
        echo 'success' . PHP_EOL;
    }

    public function actionUser($id)
    {
        $user = $this->getUser($id);
        $this->service->assignRole(RbacRoles::USER, $user->id);
        echo 'success' . PHP_EOL;
    }

    private function getUser($id)
    {
        return $this->repositiry->get($id);
    }
}
