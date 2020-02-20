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

namespace Woisks\Comment\Models\Services;

use Woisks\Comment\Models\Repository\CommentRepository;
use Woisks\Dict\Models\Services\DictGetServices;
use Woisks\Jwt\Services\JwtService;

/**
 * Class CommentServices.
 *
 * @package Woisks\Comment\Models\Services
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/1 10:20
 */
class CommentServices
{
    /**
     * @var CommentRepository
     */
    private $commentRepo;

    /**
     * CommentServices constructor. 2020/2/1 10:20.
     *
     * @param  CommentRepository  $commentRepo
     *
     * @return void
     */
    public function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    /**
     * create. 2020/2/1 10:20.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create($request)
    {
        $module_db = DictGetServices::get($request->input('module'));
        if (!$module_db) {
            return res('comment_module_error', '评论模块不存在');
        }
        $uid       = JwtService::jwt_account_uid();
        $module_id = $module_db->id;
        $numeric   = $request->input('numeric');
        $content   = $request->input('content');
        $parent_id = $request->input('parent_id', 0);
        $is_reply  = $request->input('is_reply', 1);


        try {
            \DB::beginTransaction();
            $db = $this->commentRepo->create($uid, $module_id, $numeric, $content, $parent_id, $is_reply);

            if ($parent_id) {
                $len = strlen($parent_id);
                if ($len == 18 || $len == 19) {
                    $this->commentRepo->reply_count_increment($parent_id);
                }
            }

        } catch (\Throwable $e) {

            \DB::rollBack();
            return res('services_error', '服务器开小差了,请稍后再试');
        }
        
        \DB::commit();
        return res('success', '创建成功', $db);
    }

    /**
     * delete. 2020/2/1 10:20.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $len = strlen($id);
        if (!($len == 18) && !($len == 19)) {
            return res('comment_numeric_error', '评价ID不合法');
        }

        $db = $this->commentRepo->first($id);
        if (!$db) {
            return res('comment_not_exists', '评价内容不存在');
        }

        if ($db->reply_count > 0 || $db->like > 0) {
            return res('comment_reply_or_like_not_empty', '评价已存在回复或喜欢,不能删除');
        }

        $uid = JwtService::jwt_account_uid();

        if ($db->account_uid != $uid) {
            return res('comment_uid_delete_error', '评价不归属当前用户，删除失败');
        }

        return $db->delete() ? res('success', '评价删除成功') : res('comment_delete_error', '评价删除失败,请稍后再试');

    }


    /**
     * get_uid. 2020/2/1 11:04.
     *
     * @param $uid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_uid($uid)
    {
        $len = strlen($uid);
        if (!($len == 18) && !($len == 19)) {
            return res('comment_uid_error', '评价UID不合法');
        }
        $db = $this->commentRepo->get_uid($uid);
        if ($db->isEmpty()) {
            return res('comment_not_exists', '评价内容不存在');
        }

        return res('success', '获取成功', $db);
    }

    /**
     * module_numeric. 2020/2/1 11:04.
     *
     * @param $module
     * @param $numeric
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function module_numeric($module, $numeric)
    {
        $len = strlen($numeric);
        if (!($len == 18) && !($len == 19)) {
            return res('comment_numeric_error', '评价numeric不合法');
        }

        $module_db = DictGetServices::get($module);
        if (!$module_db) {
            return res('comment_module_not_exists', '评价模块不存在');
        }

        $module_id = $module_db->id;

        $db = $this->commentRepo->module_numeric_get($module_id, $numeric);
        if ($db->isEmpty()) {
            return res('comment_db_not_exists', '评价内容不存在');
        }
        return res('success', '获取成功', $db);
    }

    /**
     * reply. 2020/2/1 11:13.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reply($id)
    {
        $len = strlen($id);
        if (!($len == 18) && !($len == 19)) {
            return res('comment_ID_error', '评价ID不合法');
        }
        $db = $this->commentRepo->reply($id);
        if ($db->isEmpty()) {
            return res('comment_reply_not_exists', '评价回复不存在');
        }
        return res('success', '获取成功', $db);

    }


}