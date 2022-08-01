<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use App\Http\Resources\DocumentResource;
use App\Http\Resources\DocumentResource;
use App\Models\Models\Document;
use Storage;

class DocumentsController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'document' => 'required|mimes:pdf,png,jpg|max:9999',
        ]);

        $base_location = 'user_documents';

        // Handle File Upload
        if($request->hasFile('document')) {
            //Using store(), the filename will be hashed. You can use storeAs() to specify a name.
            //To specify the file visibility setting, you can update the config/filesystems.php s3 disk visibility key,
            //or you can specify the visibility of the file in the second parameter of the store() method like:
            //$documentPath = $request->file('document')->store($base_location, ['disk' => 's3', 'visibility' => 'public']);

            $documentPath = $request->file('document')->store($base_location, ['disk' => 's3', 'visibility' => 'public']);

        } else {
            return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
        }

        //We save new path
        $document = new Document();
        $document->path = $documentPath;
        $document->name = $request->name;
        $document->save();

        return response()->json(['success' => true, 'message' => 'Document successfully uploaded', 'document' => new DocumentResource($document)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
