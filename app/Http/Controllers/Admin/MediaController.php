<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\MediaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function __construct(Media $model)
    {
        $this->model = new MediaRepository($model);
    }

    public function destroy(Request $request, Media $media)
    {
        try {
            if ($this->model->delete($media->id)) {
                $request->session()->flash('success', 'Success!');

                return response()->json(['message' => 'Success!']);
            }

            return response()->json(['message' => 'Not Found!'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json(['message' => 'Error!'], 400);
        }
    }
}
