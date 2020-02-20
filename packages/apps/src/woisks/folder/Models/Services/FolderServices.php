<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                   At all timesI love the moment                      |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2019 www.Woisk.com All rights reserved.                |
 * +----------------------------------------------------------------------+
 * |  Author:  Maple Forest  <Woisks@126.com>   QQ:364956690   286013629  |
 * +----------------------------------------------------------------------+
 */

namespace Woisks\Folder\Models\Services;


use Illuminate\Database\QueryException;
use Woisks\Dict\Models\Services\DictGetServices;
use Woisks\Folder\Models\Repository\FolderRepository;
use Woisks\Jwt\Services\JwtService;


/**
 * Class FolderServices.
 *
 * @package Woisks\Folder\Models\Services
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/30 11:40
 */
class FolderServices
{

    /**
     * @var FolderRepository
     */
    private $folderRepo;


    /**
     * FolderServices constructor. 2020/1/30 11:40.
     *
     * @param  FolderRepository  $folderRepo
     *
     * @return void
     */
    public function __construct(FolderRepository $folderRepo)
    {
        $this->folderRepo = $folderRepo;
    }


    /**
     * 创建文件夹
     * create. 2020/1/30 11:40.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create($request)
    {
        $id        = create_numeric_id();
        $uid       = JwtService::jwt_account_uid();
        $module_db = app()->make(DictGetServices::class)->first($request->input('module'));
        if (!$module_db) {
            return res('folder_module_error', '文件夹模块不存在');
        }
        $module_id      = $module_db->id;
        $cover_photo_id = $request->input('cover_photo_id');
        $title          = $request->input('title');
        $readme         = $request->input('readme');
        $is_public      = $request->input('is_public') ?? true;

        try {
            $db = $this->folderRepo->create($id, $uid, $module_id, $cover_photo_id, $title, $readme, $is_public);

            return $db ? res('success', '创建成功') : res('folder_create_error', '创建失败');

        } catch (QueryException $e) {
            return res('database_error', '数据库异常,请稍后再试');
        } catch (\Throwable $e) {
            return res('services_error', '服务器开小差了,请稍后再试');
        }
        return res('folder_create_error', '创建失败');
    }

    /**
     * 获取用户公开的文件夹
     * public_folder. 2020/1/30 11:57.
     *
     * @param $uid
     * @param $module
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function public_folder($uid, $module)
    {
        if ($module == 'all') {
            return $this->public_folder_all($uid);
        }
        //$module 转换 module ID
        $module_db = app()->make(DictGetServices::class)->first($module);
        if (!$module_db) {
            return res('folder_module_error', '文件夹模块不存在');
        }

        $module_id = $module_db->id;
        $db        = $this->folderRepo->get_uid_module_public($uid, $module_id);

        if ($db->isEmpty()) {
            return res('folder_not_exists', '数据不存在');
        }
        return res('success', '获取成功', $db);
    }

    /**
     * 获取用户所有公开文件夹
     * public_folder_all. 2020/1/30 12:06.
     *
     * @param $uid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function public_folder_all($uid)
    {
        $db = $this->folderRepo->get_uid_public($uid);

        if ($db->isEmpty()) {
            return res('folder_not_exists', '数据不存在');
        }
        return res('success', '获取成功', $db);
    }

    /**
     * 获取会员指定模块的文件夹
     * get. 2020/1/30 11:56.
     *
     * @param $module
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function get($module)
    {
        if ($module == "all") {
            return $this->all();
        }
//        $module 转换ID
        $module_db = app()->make(DictGetServices::class)->first($module);

        if (!$module_db) {
            return res('folder_module_error', '文件夹模块不存在');
        }

        $module_id = $module_db->id;
        $uid       = JwtService::jwt_account_uid();

        $db = $this->folderRepo->get_uid_module($uid, $module_id);
        if ($db->isEmpty()) {
            return res('folder_not_exists', '数据不存在');
        }
        return res('success', '获取成功', $db);
    }

    /**
     * 获取会员的所有文件夹
     * all. 2020/1/30 11:56.
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $uid = JwtService::jwt_account_uid();

        $db = $this->folderRepo->get_uid($uid);
        if ($db->isEmpty()) {
            return res('folder_not_exists', '数据不存在');
        }
        return res('success', '获取成功', $db);
    }

    /**
     * update. 2020/1/30 14:28.
     *
     * @param $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($request, $id)
    {
        $uid = JwtService::jwt_account_uid();
        $db  = $this->folderRepo->first($id);
        if (!$db) {
            return res('folder_not_exists', '文件夹不存在');
        }
        if ($uid != $db->account_uid) {
            return res('folder_update_error', '文件夹修改失败,没有权限');
        }

        $cover_photo_id = $request->input('cover_photo');
        if ($cover_photo_id) {
            $db->cover_photo_id = $cover_photo_id;
            $db->save();
        }
        $title = $request->input('title');
        if ($title) {
            $db->title = $title;
            $db->save();
        }
        $readme = $request->input('readme');
        if ($readme) {
            $db->readme = $readme;
            $db->save();
        }
        $is_public     = $request->input('is_public') ?? $db->is_public;
        $db->is_public = $is_public;
        $db->save();

        return res('success', '修改成功', $db);
    }

    /**
     * delete. 2020/1/30 14:50.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $uid = JwtService::jwt_account_uid();
        $db  = $this->folderRepo->first($id);
        if (!$db) {
            return res('folder_database_not_exists', '文件夹不存在');
        }

        if ($uid !== $db->account_uid) {
            return res('folder_update_error', '文件夹删除失败,没有权限');
        }

        if ($db->count > 0) {
            return res('folder_delete_error', '文件夹已有收录,无法删除');
        }

        if ($db->delete()) {
            return res('success', '文件夹删除成功');
        }
        return res('folder_delete_error', '文件夹删除失败,稍后再试');
    }

    /**
     * exists. 2020/2/3 10:34.
     *
     * @param $folder_id
     *
     * @return mixed
     */
    public function exists($folder_id)
    {
        return $this->folderRepo->exists($folder_id);
    }

}
