<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/sliders",
     * operationId="getAllSliders",
     * tags={"Slider"},
     * summary="Menampilkan semua slider (untuk admin)",
     * @OA\Response(response=200, description="Operasi berhasil")
     * )
     */
    public function index()
    {
        // Mengembalikan full URL untuk gambar
        $sliders = Slider::orderBy('order', 'asc')->get()->map(function ($slider) {
            $slider->image_url = asset('storage/' . $slider->image_path);
            return $slider;
        });
        return response()->json(['success' => true, 'data' => $sliders]);
    }

    /**
     * @OA\Get(
     * path="/api/sliders/public",
     * operationId="getActiveSliders",
     * tags={"Slider"},
     * summary="Menampilkan slider yang aktif saja (untuk user)",
     * @OA\Response(response=200, description="Operasi berhasil")
     * )
     */
    public function public()
    {
        // Mengembalikan slider yang aktif saja dengan full URL untuk gambar
        $sliders = Slider::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get()->map(function ($slider) {
                $slider->image_url = asset('storage/' . $slider->image_path);
                return $slider;
            });

        return response()->json(['success' => true, 'data' => $sliders]);
    }

    /**
     * @OA\Post(
     * path="/api/sliders",
     * operationId="storeSlider",
     * tags={"Slider"},
     * summary="Membuat slider baru",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * type="object",
     * required={"image","order"},
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="image", type="file", format="binary"),
     * @OA\Property(property="order", type="integer"),
     * @OA\Property(property="is_active", type="boolean")
     * )
     * )
     * ),
     * @OA\Response(response=201, description="Berhasil dibuat"),
     * @OA\Response(response=422, description="Validasi gagal")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'required|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $path = $request->file('image')->store('sliders', 'public');
        $slider = Slider::create([
            'title' => $request->title,
            'image_path' => $path,
            'order' => $request->order,
            'is_active' => $request->boolean('is_active'),
        ]);

        // Tambahkan URL lengkap ke respons
        $slider->image_url = asset('storage/' . $slider->image_path);

        return response()->json([
            'success' => true,
            'message' => 'Slider berhasil ditambahkan.',
            'data' => $slider,
        ], 201);
    }
    
    /**
     * @OA\Get(
     * path="/api/sliders/{id}",
     * operationId="getSliderById",
     * tags={"Slider"},
     * summary="Menampilkan detail satu slider",
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Operasi berhasil"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show(Slider $slider)
    {
        $slider->image_url = asset('storage/' . $slider->image_path);
        return response()->json(['success' => true, 'data' => $slider]);
    }

    /**
     * @OA\Post(
     * path="/api/sliders/{id}",
     * operationId="updateSlider",
     * tags={"Slider"},
     * summary="Memperbarui slider (gunakan POST dengan _method=PUT)",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * type="object",
     * required={"order", "_method"},
     * @OA\Property(property="_method", type="string", example="PUT"),
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="image", type="file", format="binary"),
     * @OA\Property(property="order", type="integer"),
     * @OA\Property(property="is_active", type="boolean")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Berhasil diperbarui"),
     * @OA\Response(response=422, description="Validasi gagal")
     * )
     */
    public function update(Request $request, Slider $slider)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'required|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $path = $slider->image_path;
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($slider->image_path);
            $path = $request->file('image')->store('sliders', 'public');
        }

        $slider->update([
            'title' => $request->title,
            'image_path' => $path,
            'order' => $request->order,
            'is_active' => $request->boolean('is_active'),
        ]);

        $slider->image_url = asset('storage/' . $slider->image_path);

        return response()->json([
            'success' => true,
            'message' => 'Slider berhasil diperbarui.',
            'data' => $slider
        ]);
    }

    /**
     * @OA\Delete(
     * path="/api/sliders/{id}",
     * operationId="deleteSlider",
     * tags={"Slider"},
     * summary="Menghapus slider",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Berhasil dihapus"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->image_path);
        $slider->delete();

        return response()->json(['success' => true, 'message' => 'Slider berhasil dihapus.']);
    }
}