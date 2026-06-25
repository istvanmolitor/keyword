<?php

namespace Molitor\Keyword\Database\Seeders;

use Illuminate\Database\Seeder;
use Molitor\User\Exceptions\PermissionException;
use Molitor\User\Services\AclManagementService;

class KeywordSeeder extends Seeder
{
    public function run(): void
    {
        try {
            /** @var AclManagementService $aclService */
            $aclService = app(AclManagementService::class);

            $aclService->createPermission(
                'keyword',
                'Kulcsszavak kezelése',
                'admin',
                'Keyword'
            );
        } catch (PermissionException $e) {
            $this->command?->error($e->getMessage());
        }
    }
}
