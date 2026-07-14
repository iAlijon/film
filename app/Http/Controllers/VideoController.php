<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Barcha faol videolar ro'yxati (paginated).
     *
     * GET /api/videos
     * Query params:
     *   per_page  - sahifadagi elementlar soni (default: 10)
     *   status    - 1 yoki 0 (default: faqat faollar)
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $data = Video::where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        if ($data->isNotEmpty()) {
            $result = $data->toArray();
            $result['data'] = collect($data->items())->map(function ($item) {
                return $this->formatVideo($item);
            });

            return successJson($result, 'ok');
        }

        return errorJson('Undefined Element!', 404);
    }

    /**
     * Bitta videoni qaytarish.
     *
     * GET /api/videos/{id}
     */
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * Video obyektini API formatiga o'tkazish.
     */
    private function formatVideo(Video $video): array
    {
        return [
            'id'           => $video->id,
            'video'        => $video->video ? $video->video : null,
            'width_ratio'  => $video->width_ratio,
            'height_ratio' => $video->height_ratio,
            'status'       => $video->status,
            'created_at'   => $video->created_at,
        ];
    }
}
