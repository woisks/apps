<?php
declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                   At all timesI love the moment                      |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2019 www.Woisk.com All rights reserved.                |
 * +----------------------------------------------------------------------+
 * |  Author:  Maple Grove  <bolelin@126.com>   QQ:364956690   286013629  |
 * +----------------------------------------------------------------------+
 */

namespace Woisks\Media\Models\Services;


use Woisks\Dict\Models\Services\DictGetServices;
use Woisks\Jwt\Services\JwtService;
use Woisks\Media\Models\Entity\PhotoEntity;
use Woisks\Media\Models\Repository\PhotoRepository;

/**
 * Class MediaServices.
 *
 * @package Woisks\Media\Models\Services
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/12 17:18
 */
class PhotoServices
{

    public function create($request)
    {
        $file       = $request->file('upload');
        $module     = $request->input('module');
        $folder     = $request->input('folder', 0);
        $title      = $request->input('title', '');
        $readme     = $request->input('readme', '');
        $is_comment = $request->input('is_comment', 1);

        $module_db = DictGetServices::get($module);
        if (!$module_db) {
            return res('photo_module_error', '图片模块不合法');
        }
        $module_id = $module_db->id;

        $suffix = $file->extension();
        //验证图片后缀
        if ($suffix == 'svg') {
            return res('Media_not_supported_svg', '图片不支持svg格式');
        }


        if ($this->qiniu($id = create_photo_id().create_photo_type(), $file, $suffix)) {
            //上传图片成功
            $account_uid = JwtService::jwt_account_uid();

            try {
                \DB::beginTransaction();

                //创建图片记录
                $db = app()->make(PhotoRepository::class)->created($account_uid, $id, $module_id, $folder, $title,
                    $readme, $is_comment);

            } catch (\Throwable $e) {
                \DB::rollBack();
                return res('services_error', '服务器开小差了,稍后再试');
            }

            \DB::commit();
            return res('success', '上传成功', [
                'uploaded' => true,
                'id'       => $id,
                'url'      => config('filesystems.disks.qiniu.access_url').'/'.$id
            ]);

        }
        return res('Media_upload_error', '图片上传失败，稍后再试');
    }

    /**
     * qiniu. 2019/7/30 22:03.
     *
     * @param $id
     * @param $file
     * @param $suffix
     *
     * @return bool
     */
    public function qiniu($id, $file, $suffix)
    {
        if ($suffix == 'gif' || $suffix == 'bmp') {

            return QiniuStore::disk('qiniu')->put($id, $file) ? true : false;
        }

        return QiniuStore::disk('qiniu')->put($id, \Image::make($file)->encode($file->extension(), 70)) ? true : false;

    }

    /**
     * exists. 2019/7/30 23:14.
     *
     * @param $id
     *
     * @return bool
     */
    public static function exists($id)
    {
        $db = PhotoEntity::where('id', $id)->first();
        if ($db) {
            return $db->account_uid == JwtService::jwt_account_uid() ? true : false;
        }
        return false;
    }


    /**
     * transUrl. 2019/7/30 23:14.
     *
     * @param  $id
     * @param  $model
     *
     * @return mixed|string
     */
    public static function transUrl($id, $model)
    {
        $suffix = (int) substr((string) $id, -1, 1);

        if (in_array($suffix, [1, 3, 5, 7, 9])) {
            return config('filesystems.disks.qiniu.access_url').'/'.$id;
        } else {
            return env('Media_PHOTO_NOT_EXISTS_URL'.'/'.$model);
        }
    }
}
