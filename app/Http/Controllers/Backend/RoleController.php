<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use DB;

class RoleController extends Controller
{
    function index(Request $request)
    {
      $this->authorize('Index', Role::class);   
      $input = $request->all();
    	$data['roles'] = Role::where(function($query) use ($input) {
          if(isset($input['p']) && !empty($input['p'])){
              $query->where('role_title','like',$input['p']);
          }
        })->where('id' , '!=' , '1')->orderBy('id','desc')->paginate();
       $data['request'] = $input;
    	return view('backend.role.index',compact('data'));
    }

    function create(Request $request)
    {  
        $this->authorize('create', Role::class);
        $data['modules'] = Module::select( 'id' , 'module_name')->where('id' , '!=' , '12')->orderBy('module_name', 'ASC')->get();
        $data['role'] = array();
        $data['users'] = User::whereNotIn('role_id',['1'])->orderBy('name','asc')->get();
        return view("backend.role.add", compact('data'));
    }

    function destroy(Request $request)
    {
       $this->authorize('delete', Role::class);
       $id = $request->id;
       $Role = Role::find($id);
       $Role->deleted_at = date('Y-m-d H:i:s'); 
       if($Role->save()){
        return ['status' => 'success' , 'message' => 'Successfully deleted group'];
       }else{
           return ['status' => 'failed' , 'message' => 'Failed to delete group'];
        }
    }
function store(Request $request)
{
     $this->authorize('create', Role::class);   
     $role        = $request->role;
     $description = $request->description;
     $permissions = $request->permissions;

     $request->validate([
       'role'    => 'required|min:2|max:50|unique:roles,role_title,NULL,id,deleted_at,NULL',
     ]);
       
     $role = new Role;
     $role->role_title  = $request->role;
     $role->description = $description ?? null; 
     $role->save();

     if(!empty($permissions)){
       $role->permissions()->sync($permissions);
     }

     if($request->users){
      \DB::table('users')->whereIn('id',$request->users)->update(['role_id'=>$role->id]);
    }

     if($role->id){
       return  redirect()->route('admin/role/index')->with('status' , true )->with('message' , 'Group Created successfully');
     }else{
      return  redirect()->route('admin/role/index')->with('status' , false )->with('message' , 'Failed to create group');
     }

}
function edit($id){
      $this->authorize('index', Role::class);
      $id  = $id;
      $data['role']             = Role::find($id);
      $data['modules']          = Module::select( 'id' , 'module_name')->where('id' , '!=' , '12')->orderBy('module_name', 'ASC')->get();
      $data['users'] = User::whereNotIn('role_id',['1'])->orderBy('name','asc')->get();
      return view('backend.role.edit',compact('data'));
}

function update(Request $request,$id)
{
    $this->authorize('update', Role::class);
    $id          = $id;
    $role        = $request->role;
    $permissions = $request->permissions;
    $description = $request->description;

    $validatedData = $request->validate([
        'role'    => 'required|min:2|max:50|unique:roles,role_title,'.$id.',id,deleted_at,NULL',
    ]);
       
      $role       = Role::find($id);
      $role->role_title  = $request->role;
      $role->description = $request->description ?? null;
      $role->permissions()->sync($permissions);
      
      \DB::table('users')->where('role_id',$id)->update(['role_id'=>'2']);
      if($request->users){
        \DB::table('users')->whereIn('id',$request->users)->update(['role_id'=>$id]);
      }

       if($role->save()){
        return  redirect()->back()->with('status' , true )->with('message' , 'Group updated uccessfully');
       }else{
        return  redirect()->back()->with('status' , false )->with('message' , 'Failed to update group');
       }
  }

    public function returnResponse($status , $message , $redirect ){
       
       return redirect()->route('role/'.$redirect)->with('msg' , $message)->with('status' , $status );

    }

    public function status(Request $request){
        $this->authorize('update', Role::class);
        $id = $request->id;
        $role = Role::find($id);
        $status = $role->status ? '0' : '1';
        $role->status = $status;
        $text =  $status ? 'Active' : 'Inactive';
        if($role->save()){
          return ['status' => true , 'message' => 'Successfully '.$text.' group'];
        }
        else{
          return ['status' => false , 'message' => 'Failed '.$text.' group'];
        }
 
    }

}
