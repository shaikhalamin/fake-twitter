<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStorageFileRequest;
use App\Http\Requests\UpdateStorageFileRequest;
use App\Models\StorageFile;

class StorageFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStorageFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStorageFileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StorageFile  $storageFile
     * @return \Illuminate\Http\Response
     */
    public function show(StorageFile $storageFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StorageFile  $storageFile
     * @return \Illuminate\Http\Response
     */
    public function edit(StorageFile $storageFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStorageFileRequest  $request
     * @param  \App\Models\StorageFile  $storageFile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStorageFileRequest $request, StorageFile $storageFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StorageFile  $storageFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(StorageFile $storageFile)
    {
        //
    }
}
