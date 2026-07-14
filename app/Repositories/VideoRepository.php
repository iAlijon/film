<?php

namespace App\Repositories;

use App\Models\Video;
use App\Traits\ImageUploads;

class VideoRepository extends BaseRepository
{
    use ImageUploads;

    public function __construct()
    {
        $this->model = new Video();
    }

    public function index($request)
    {
        $query = $this->model;

        if (isset($request->status) && $request->status !== null && $request->status !== ''){
            $query = $query->where('status', $request->status);
        }

        return $query->orderBy('id', 'desc')->paginate($this->limit)->appends($request->query());
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        $videoPath = null;
        if (isset($data['video_file'])) {
            $videoPath = $this->video($data['video_file']);
        }

        $model = $this->model->create([
            'video' => $videoPath,
            'width_ratio' => $data['width_ratio'] ?? 16,
            'height_ratio' => $data['height_ratio'] ?? 9,
            'status' => $data['status'] ?? 1,
        ]);

        return $model;
    }

    public function update($id, $data)
    {
        $model = $this->findById($id);

        $videoPath = $model->video;
        if (isset($data['video_file'])) {
            if ($model->video && file_exists(public_path($model->video))) {
                @unlink(public_path($model->video));
            }
            $videoPath = $this->video($data['video_file']);
        }

        $model->update([
            'video' => $videoPath,
            'width_ratio' => $data['width_ratio'] ?? 16,
            'height_ratio' => $data['height_ratio'] ?? 9,
            'status' => $data['status'] ?? 1,
        ]);

        return $model;
    }

    public function delete($id)
    {
        $item = $this->findById($id);
        if ($item->video && file_exists(public_path($item->video))) {
            @unlink(public_path($item->video));
        }
        $item->delete();
        return true;
    }
}
