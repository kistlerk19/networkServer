<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\UserImageUploadRequest;
use App\Models\UserFile;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserFileController extends Controller
{
    protected $imageUploadService;
    protected $responseHelper;

    public function __construct(ImageUploadService $imageUploadService, ResponseHelper $responseHelper)
    {
        $this->imageUploadService = $imageUploadService;
        $this->responseHelper = $responseHelper;
    }

    public function store(UserImageUploadRequest $request)
    {
        // dd(url(Storage::url('bob')));
       $file = $request->file->storeAs(
           'public/images/' . auth()->user()->id, $request->file->getClientOriginalName()
       );

       $this->imageUploadService->saveFile($file);

      return $this->responseHelper->successResponse(true, "Image Upload Success!", []);
    }
    
    public function addFriend($id)
    {
        // Add Friend
        // $addFriend = auth()->user()->friends()->attach([2,3,5,6]);

        // Remove Friend
        // $removeFriend = auth()->user()->friends()->detach([$id]);
        // Sync friends
        $removeFriend = auth()->user()->friends()->sync([$id]);

      return $this->responseHelper->successResponse(true, "Added User!", []);
    }


    public function show(UserFile $userFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserFile  $userFile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserFile $userFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserFile  $userFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserFile $userFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserFile  $userFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserFile $userFile)
    {
        //
    }
}
