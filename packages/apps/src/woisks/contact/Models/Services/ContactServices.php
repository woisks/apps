<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                   At all timesI love the moment                      |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2019 www.Woisk.com All rights reserved.                |
 * +----------------------------------------------------------------------+
 * |  Author:  Maple Grove  <Woisks@126.com>   QQ:364956690   286013629  |
 * +----------------------------------------------------------------------+
 */

namespace Woisks\Contact\Models\Services;


use Woisks\Contact\Models\Repository\ContactRepository;
use Woisks\Folder\Models\Services\FolderServices;
use Woisks\Jwt\Services\JwtService;
use Woisks\Photo\Models\Services\PhotoServices;

/**
 * Class ContactServices.
 *
 * @package Woisks\Contact\Models\Services
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/1 17:07
 */
class ContactServices
{
    /**
     * @var ContactRepository
     */
    private $contactRepo;

    /**
     * ContactServices constructor. 2020/2/1 17:07.
     *
     * @param  ContactRepository  $contactRepo
     *
     * @return void
     */
    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepo = $contactRepo;
    }

    /**
     * create. 2020/2/1 17:07.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create($request)
    {
        $folder_id     = $request->input('folder_id');
        $folder_exists = app()->make(FolderServices::class)->exists($folder_id);
        if (!$folder_exists) {
            return res('contact_folder_error', '联系信息文件夹不合法');
        }

        $isp_id     = $request->input('isp_id');
        $isp_exists = app()->make(ISPServices::class)->exists($isp_id);
        if (!$isp_exists) {
            return res('contact_isp_error', '联系信息服务商不合法');
        }
        //服务商统计
        app()->make(ISPServices::class)->increment($isp_id);


        $qrcode_id = $request->input('qrcode_id', 0);
        if ($qrcode_id) {
            $qrcode_exists = PhotoServices::exists($qrcode_id);
            if (!$qrcode_exists) {
                return res('contact_qrcode_photo_error', '联系信息图片不合法');
            }
        }

        $passport = $request->input('passport');
        $title    = $request->input('title', '');
        $readme   = $request->input('readme', '');
        $uid      = JwtService::jwt_account_uid();
        $db       = $this->contactRepo->create($uid, $folder_id, $isp_id, $qrcode_id, $passport, $title, $readme);

        return $db ? res('success', '创建成功', $db) : res('contact_folder_not_exists', '联系信息文件夹不存在');
    }

    /**
     * folder_get. 2020/2/1 18:02.
     *
     * @param $folder_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function folder_get($folder_id)
    {
        $len = strlen($folder_id);
        if (!($len == 18) && !($len == 19)) {
            return res('contact_folder_error', '联系信息文件夹ID不合法');
        }
        $db = $this->contactRepo->folder_get($folder_id);
        if ($db->isEmpty()) {
            return res('contact_folder_not_exists', '联系信息文件夹不存在');
        }

        return res('success', '获取成功', $db);
    }

    /**
     * delete. 2020/2/1 18:25.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $len = strlen($id);
        if (!($len == 18) && !($len == 19)) {
            return res('contact_id_error', '联系信息ID不合法');
        }

        $db = $this->contactRepo->first($id);
        if (!$db) {
            return res('contact_id_not_exists', '联系信息不存在');
        }
        $uid = JwtService::jwt_account_uid();
        if ($uid != $db->account_uid) {
            return res('contact_uid_error', '联系信息权限不符');
        }
        return $db->delete() ? res('success', '联系信息删除成功') : res('contact_delete_error', '联系信息删除失败,稍后再试');
    }
}