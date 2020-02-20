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

namespace Woisks\Tag\Models\Services;

use Illuminate\Support\Facades\DB;
use Woisks\Dict\Models\Services\DictGetServices;
use Woisks\Tag\Models\Repository\IndexRepository;
use Woisks\Tag\Models\Repository\TagRepository;

class TagServices
{
    private $indexRepo;

    private $tagRepo;

    public function __construct(TagRepository $tagRepo, IndexRepository $indexRepo)
    {
        $this->tagRepo   = $tagRepo;
        $this->indexRepo = $indexRepo;
    }

    /**
     * create. 2020/1/31 19:06.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create($request)
    {
        $tag       = $request->input('tag');
        $module_db = DictGetServices::get($request->input('module'));
        $module_id = $module_db->id;

        try {
            DB::beginTransaction();
            $tag_db = $this->tagRepo->firstOrCreate($tag);
            $this->indexRepo->firstOrCretae($module_id, $tag_db->id);
        } catch (\Throwable $e) {

            DB::rollback();
            return res('services_error', '服务器开小差了,请稍后再试');
        }
        DB::commit();
        return res('success', '标签创建成功', $tag_db);
    }

    /**
     * get. 2020/1/31 19:37.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($request)
    {
        $tags = $request->input('tag');
        $db   = $this->tagRepo->find($tags);
        if ($db->isEmpty()) {
            return res('tag_not_exists', '数据不存在');
        }
        return res('success', '获取成功', $db);
    }

    public function index($tag_id)
    {
        $len = strlen($tag_id);

        if (!($len == 18) && !($len == 19)) {
            return res('tag_length_error', '标签ID不符合规则');
        }

        $index_db = $this->indexRepo->get($tag_id);
        if ($index_db->isEmpty()) {
            return res('tag_index_not_exists', '标签索引不存在');
        }

        foreach ($index_db as $item) {
            $dict_db     = DictGetServices::get_id($item->module_id);
            $item->alias = $dict_db->alias;
            $item->name  = $dict_db->name;
        }
        return res('success', '获取成功', $index_db);

    }
}