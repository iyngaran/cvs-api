<?php

use App\Domain\User\Repositories\PermissionRepositoryInterface;
use App\Domain\User\Repositories\RoleRepositoryInterface;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\File;
use App\Domain\User\Actions\CreateRoleAction;
use \App\Domain\User\Actions\CreatePermissionAction;
use Illuminate\Support\Facades\App;
use \App\Domain\User\Exceptions\RoleNotFoundException;
use \App\Domain\User\Exceptions\PermissionNotFoundException;
use \Illuminate\Support\Carbon;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now()->format('Y_m_d_H_s');
        $path = storage_path('app/data/roles-and-permissions/');
        $files = File::allFiles($path);

        if ($files) {
            foreach ($files as $file) {
                $data = json_decode(file_get_contents($file->getPathname()), true);
                if (!empty($data) && is_array($data)) {
                    foreach ($data as $role => $permissions) {
                        $roleRepository = App::make(RoleRepositoryInterface::class);
                        try {
                            $role = $roleRepository->findByName($role);
                        } catch (RoleNotFoundException $ex) {
                            $role = (new CreateRoleAction())->execute(['name' => $role]);
                        }

                        if ($role) {
                            if ($permissions) {
                                foreach ($permissions as $permission) {
                                    $permissionRepository = App::make(PermissionRepositoryInterface::class);
                                    try {
                                        $permission = $permissionRepository->findByName($permission);
                                    } catch (PermissionNotFoundException $ex) {
                                        $permission = (new CreatePermissionAction())->execute(['name' => $permission]);
                                    }
                                    $role->givePermissionTo($permission);
                                }
                            }
                        }
                    }
                }

                // move the file to archive folder..
                File::move($file->getPathname(), storage_path('app/archive/roles-and-permissions/'.$currentTime.'_'.$file->getFilename()));
            }
        }
    }
}
