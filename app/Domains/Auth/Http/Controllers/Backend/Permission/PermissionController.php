<?php

namespace App\Domains\Auth\Http\Controllers\Backend\Permission;

use App\Domains\Auth\Http\Requests\Backend\Permission\StorePermissionRequest;
use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Services\PermissionService;

/**
 * Class PermissionController
 */
class PermissionController
{
    /**
     * @var PermissionService
     */
    protected $permissionService;

    /**
     * RoleController constructor.
     *
     * @param  PermissionService  $permissionService
     */
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.auth.permission.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.permission.create')
            ->withCategories($this->permissionService->getCategorizedPermissions())
            ->withGeneral($this->permissionService->getUncategorizedPermissions());
    }

    /**
     * @param  StorePermission  $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StorePermissionRequest $request)
    {
        $this->permissionService->store($request->validated());

        return redirect()->route('admin.auth.permission.index')->withFlashSuccess(__('The permission was successfully created.'));
    }

    /**
     * @param  StorePermission  $request
     * @param  Permission  $role
     *
     * @return mixed
     */
    public function edit(StorePermissionRequest $request, Permission $role)
    {
        return view('backend.auth.role.edit')
            ->withCategories($this->permissionService->getCategorizedPermissions())
            ->withGeneral($this->permissionService->getUncategorizedPermissions());
    }

    /**
     * @param  StorePermissionRequest  $request
     * @param  Permission  $role
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(StorePermissionRequest $request, Permission $permission)
    {
        $this->permissionService->update($permission, $request->validated());

        return redirect()->route('admin.auth.permission.index')->withFlashSuccess(__('The permission was successfully updated.'));
    }

    /**
     * @param  Permission  $permission
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Permission $permission)
    {
        $this->permissionService->destroy($permission);

        return redirect()->route('admin.auth.role.index')->withFlashSuccess(__('The role was successfully deleted.'));
    }
}
