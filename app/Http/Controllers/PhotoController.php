<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Models\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     * This method redirects to a view.
     */
    public function index()
    {
        $page = "Photos List";

        $photos = Photo::query()
            ->with('user')
            ->where('private', 0)
            ->orderByDesc('created_at')
            ->paginate(28);

        return view('photos.index', compact('photos', 'page'));
    }

    public function personalDashboard()
    {
        $photos = auth()->user()->photos()->paginate(28);
        $page = "Your Photos";
        return view('photos.index', compact('photos', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     * This method redirects to a view.
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PhotoRequest  $request
     * @return RedirectResponse
     */
    public function store(PhotoRequest $request)
    {
        $file = $request->file('file');

        auth()->user()->photos()->create([
            'artist_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'private' => $request->private,
            'path' => $this->storePhotoAndGetPath($file),
            'original_name' => $this->getPhotoOriginalName($file)
        ]);

        return redirect()->route('photos.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        $this->authorize('manage-photo', $photo);
        return view('photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PhotoRequest  $request
     * @param  Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoRequest $request, Photo $photo)
    {
        $this->authorize('manage-photo', $photo);

        if($request->hasFile('file')) {

            $this->removePhotoFile($photo->path);

            $file = $request->file('file');
            $photo->update([
                'path' => $this->storePhotoAndGetPath($file),
                'original_name' => $this->getPhotoOriginalName($file)
            ]);
        }

        $photo->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'private' => $request->private,
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Photo  $photo
     * @return RedirectResponse
     */
    public function destroy(Photo $photo)
    {
        $this->authorize('manage-photo', $photo);
        $this->authorize('delete-photo', $photo);
        $this->removePhotoFile($photo->path);
        $photo->delete();
        return redirect()->route('dashboard');
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    private function storePhotoAndGetPath(UploadedFile $file)
    {
        return "storage/" . $file->store('photos/' . auth()->id(), 'public');
    }

    private function getPhotoOriginalName(UploadedFile $file)
    {
        return str_replace(' ','_', $file->getClientOriginalName());
    }

    /**
     * @param string $path
     */
    private function removePhotoFile(string $path)
    {
        Storage::disk('public')->delete($this->getPhotoPath($path));
    }

    private function getPhotoPath(string $rawPath)
    {
        return explode('storage/', $rawPath)[1];
    }
}
