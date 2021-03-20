<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LanguageController;
use Auth;
use DB;
use App;
use App\Models\Field;
use App\Models\Category;


class FieldController extends Controller
{
    public function index(Request $request){
        $this->authorize('index', Field::class);
        $fields = Field::where(function($query) use ($request){
             if($request->search){
                $query->whereRaw('LOWER(name) like ?', '%'.strtolower($request->search).'%');
             }
        })->whereNull('deleted_at')->orderBy('id','desc')->get();
        return view('backend.field.index',compact('fields'));
    }

    public function create(){
        $this->authorize('create', Field::class);
        return view('backend.field.create');
    }

    public function store(Request $request){
        $this->authorize('create', Field::class);
       $rules = [
          'name' => 'required',
          'type' => 'required',
       ];
       $request->validate($rules);
       $input = $request->all();
       DB::beginTransaction();
       try{
           $translateArray = array();
           $translateArray[$input['name']] = $input['name'];
           $fieldId = \DB::table('fields')->insertGetId(['name'=>$input['name'],'type'=>$input['type']]);
           if(isset($input['option']) && !empty($input['option'])){
                 $options = explode(',',$input['option']);
                 $optionStoreData = array();
                 foreach($options as $option){
                    $translateArray[$option] = $option;
                    array_push($optionStoreData,[
                        'field_id' => $fieldId,
                        'option'   => $option
                    ]);
                 }
               \DB::table('field_options')->insert($optionStoreData);
           }
           DB::commit();
           $translate = new LanguageController;
           $translate->appendBangla($translateArray);
           return redirect()->route('admin.field.index')->with('status',true)->with('message','Added successfully');
       }catch(\Exception $e){
           DB::rollback();
           return $e->getMessage();
           return redirect()->route('admin.field.index')->with('status',false)->with('message','Failed to add field');
       }
    }

    public function edit($id)
    {   
        $this->authorize('index', Field::class);
        $field = Field::find($id);
        return view('backend.field.edit',compact('field'));
    }

    public function update(Request $request,$id)
    {   
        $this->authorize('update', Field::class);
        $rules = [
            'name' => 'required',
            'type' => 'required',
         ];
         $request->validate($rules);
         $input = $request->all();
         DB::beginTransaction();
         try{
             \DB::table('fields')->where('id',$id)->update(['name'=>$input['name'],'type'=>$input['type']]);
             if(isset($input['option']) && !empty($input['option'])){
                   $options = explode(',',$input['option']);
                   $optionStoreData = array();
                   foreach($options as $option){
                      array_push($optionStoreData,[
                          'field_id' => $id,
                          'option'   => $option
                      ]);
                   }
                 \DB::table('field_options')->where('field_id',$id)->delete();
                 \DB::table('field_options')->insert($optionStoreData);
             }
             DB::commit();
             return redirect()->route('admin.field.index')->with('status',true)->with('message','Updated successfully');
         }catch(\Exception $e){
             DB::rollback();
             return $e->getMessage();
             return redirect()->route('admin.field.index')->with('status',false)->with('message','Failed to update field');
         }
    }

    public function destroy($id){
        $this->authorize('delete', Field::class);
        try{
             DB::beginTransaction();
             DB::table('fields')->where('id',$id)->delete();
             DB::table('field_options')->where('field_id',$id)->delete();
             DB::table('ad_values')->where('field_id',$id)->delete();
             DB::commit();
            return ['status'=>'success','message'=>'Field deleted successfully'];
        }catch(\Exception $e){
             DB::rollback();
            return ['status'=>'failed','message'=>'Faield to delete field'];
        }
    }

}
