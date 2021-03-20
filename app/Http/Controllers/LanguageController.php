<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Translate;
use DB;
use auth;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', Translate::class);
        $language  = file_get_contents('resources/lang/bn.json');
        $language  = json_decode($language,true);
        $data['language'] = $language;
        return view('backend.language.index',compact('data'));
    }

    public function updateBangla(Request $request)
    {
        $this->authorize('update', Translate::class);
        $input   = $request->all();
        $key     = $input['key'];
        $value   = $input['value'];

        
        $oldFile   = 'resources/lang/bn.json';
        $newFile   = 'resources/lang/bn_backup.json';
        
        if (!copy($oldFile, $newFile)) {
          return [ 
           'status'  => false,
           'message' => 'Failed',
          ];
        }

        $language = file_get_contents('resources/lang/bn.json');
        $language = json_decode($language,true);
        $language[$key]  = $value;
        file_put_contents('resources/lang/bn.json',json_encode($language));
        return [ 
           'status'  => true,
           'message' => 'Success',
        ];
    }

    public function appendBangla($data)
    {
       $this->authorize('update', Translate::class);
       if(empty($data) || is_null($data)){
        return [ 
          'status'  => false,
          'message' => 'Failed',
         ];
       }

        $oldFile   = 'resources/lang/bn.json';
        $newFile   = 'resources/lang/ar_backup.json';
        
        if (!copy($oldFile, $newFile)) {
          return [ 
           'status'  => false,
           'message' => 'Failed',
          ];
        }

        $language = file_get_contents('resources/lang/bn.json');
        $language = json_decode($language,true);
        foreach($data as $key => $value){
          $language[$key] = $value;
        }
        file_put_contents('resources/lang/bn.json',json_encode($language));
        return [ 
           'status'  => true,
           'message' => 'Success',
        ];
    }

}
