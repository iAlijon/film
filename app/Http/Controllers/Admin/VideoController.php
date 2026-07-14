<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Repositories\VideoRepository;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function __construct(protected Request $request, protected VideoRepository $repo)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        return view('admin.video.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'video_file'   => 'required|file|mimetypes:video/mp4,video/avi,video/webm|max:15360',
            'width_ratio'  => 'required|integer|min:1|max:100',
            'height_ratio' => 'required|integer|min:1|max:100',
            'status'       => 'required|in:1,2',
        ], [
            'video_file.required'  => 'Video fayl majburiy!',
            'video_file.file'      => 'Noto\'g\'ri fayl!',
            'video_file.mimetypes' => 'Faqat MP4, AVI, MOV, MKV, WEBM formatlar qabul qilinadi!',
            'video_file.max'       => 'Video hajmi 15 MB dan oshmasligi kerak!',
            'width_ratio.required' => 'Kenglik nisbati majburiy!',
            'height_ratio.required'=> 'Balandlik nisbati majburiy!',
            'status.required'      => 'Status majburiy!',
        ]);

        $model = $this->repo->create($request->all());

        if ($model) {
            $request->session()->flash('success', 'Video muvaffaqiyatli qo\'shildi!');
            return redirect()->route('video.index');
        }

        $request->session()->flash('error', 'Xatolik yuz berdi!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->repo->findById($id);
        return view('admin.video.edit', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->repo->findById($id);
        return view('admin.video.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'video_file'   => 'nullable|file|mimetypes:video/mp4,video/avi,video/webm|max:15360',
            'width_ratio'  => 'required|integer|min:1|max:100',
            'height_ratio' => 'required|integer|min:1|max:100',
            'status'       => 'required|in:1,2',
        ], [
            'video_file.file'      => 'Noto\'g\'ri fayl!',
            'video_file.mimetypes' => 'Faqat MP4, AVI, MOV, MKV, WEBM formatlar qabul qilinadi!',
            'video_file.max'       => 'Video hajmi 15 MB dan oshmasligi kerak!',
            'width_ratio.required' => 'Kenglik nisbati majburiy!',
            'height_ratio.required'=> 'Balandlik nisbati majburiy!',
            'status.required'      => 'Status majburiy!',
        ]);

        $model = $this->repo->update($id, $request->all());

        if ($model) {
            $request->session()->flash('success', 'Video muvaffaqiyatli yangilandi!');
            return redirect()->route('video.index');
        }

        $request->session()->flash('error', 'Xatolik yuz berdi!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('video.index')->with('success', 'Video o\'chirildi!');
    }

    /**
     * Toggle video status via AJAX.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function videoStatus(Request $request)
    {
        $data  = $request->only(['id', 'status']);
        $model = Video::find($data['id']);

        if (!$model) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $model->update(['status' => $data['status']]);

        return response()->json($model);
    }
}
