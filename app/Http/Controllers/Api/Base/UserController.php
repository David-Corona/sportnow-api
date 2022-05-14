<?php

namespace App\Http\Controllers\Api\Base;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;


// use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{

    //TODO: filtros? ordenar?
    public function index(Request $request)
    {
        try{
            $users = User::where('deleted_at', null)->orderBy('name','ASC')->get();
            return response()->json(['status' => 'success', 'data' => $users], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'item' => null, 'message' => $e->getMessage()]);
        }
    }

    public function me(){
        try {
            $user = auth()->user();
            return response()->json(['status' => 'success', 'data' => $user, 'me' => true], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'item' => null, 'message' => $e->getMessage()]);
        }
    }

    public function show($id){
        try {
            // $user = User::where('id', $request->id)->get()->first();
            $user = User::findOrFail($id);
            $isMe = auth()->user()->id==$id ? true : false;
            return response()->json(['status' => 'success', 'data' => $user, 'me' => $isMe], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'item' => null, 'message' => $e->getMessage()]);
        }
    }

    public function updateMe(Request $request){
        try {
            $v = Validator::make($request->all(), [
                'email' => 'required|email',
                'name'  => 'required',
            ]);

            if ($v->fails()) {
                return response()->json(['status' => 'error', 'errors' => $v->errors()], 422);
            }

            $user = auth()->user();
            $user->email = $request->email; //TODO: quizá no tenga sentido permitir cambiarse el email
            $user->name = $request->name;
            $user->save();

            return response()->json(['status' => 'success', 'data' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'item' => null, 'message' => $e->getMessage()]);
        }
    }

    // TODO: limpiar si está bien
    public function updateAvatar(Request $request){

        try {
            //https://stackoverflow.com/questions/39942670/how-to-send-put-request-with-a-file-and-an-array-of-data-in-laravel
            if($request->hasFile('avatar')) {
                $nombreFichero = $request->file('avatar')->getClientOriginalName(); // "Nombre Imagen.jpg"
                $nombreAvatar = pathinfo($nombreFichero, PATHINFO_FILENAME); // "Nombre Imagen"
                $extension = $request->file('avatar')->getClientOriginalExtension(); //"jpg"
                $nuevoNombre = '/uploads/'.str_replace(' ', '_', $nombreAvatar).'-'.date('YmdHis').'.'.$extension; //"Nombre_Imagen-20220508115359.jpg"

                // $path = $request->file('avatar')->storeAs(public_path().'/uploads', $nuevoNombre, 'public');
                $request->file('avatar')->move(public_path('uploads'), $nuevoNombre); //guarda en public/uploads

                $user = auth()->user();
                $user->avatar = $nuevoNombre;
                $user->save();

                return response()->json(['status' => 'success', 'data' => $user], 200);
            } else {
                return response()->json(['status' => 'error', 'data' => 'No se ha podido cargar la imagen.'], 200);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'item' => null, 'message' => $e->getMessage()]);
        }

        //return response()->json(['status' => 'success', 'data' => $user], 200);

        // $user = auth()->user();
        // $request->validate([
        //     'avatar' => 'required', //|image|mimes:jpeg,png,jpg,gif,svg|max:2048
        // ]);

        //Recibo: data:image/jpeg;base64,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
        // MIRAR formato recibido del file reader, error entre lo que mando y recibo, no compatibles
        //  $file = base64_decode($request['avatar']);
        //  $safeName = 'asdasdsd'.'.'.'png'; //str_random(10)
        //  $success = file_put_contents(public_path().'/uploads/'.$safeName, $file);


        // $data = Input::all();
        // $png_url = "product-".time().".png";
        // $path = public_path().'img/designs/' . $png_url;
        // Image::make(file_get_contents($data->base64_image))->save($path);


        // $v = Validator::make($request->all(), [
        //     'avatar'  => 'required',
        // ]);
        // if ($v->fails()) {
        //     return response()->json(['status' => 'error', 'errors' => $v->errors()], 422);
        // }

        //$imageName = time().'.'.$request->avatar->extension();
        //$request->avatar->move(public_path('images'), $imageName);
        // Store Image in Storage Folder
        // $request->avatar->storeAs('images', $imageName); // storage/app/images/file.png


        // $name = $request->file('image')->getClientOriginalName();
        // $path = $request->file('image')->store('public/images');
        // $save = new Photo;
        // $save->name = $name;
        // $save->path = $path;
        // $save->save();


        // if($request->hasFile('image')){
        //     $filename = $request->image->getClientOriginalName();
        //     $request->image->storeAs('images',$filename,'public');
        //     Auth()->user()->update(['image'=>$filename]);
        // }


        // $data= new Postimage();
        // if($request->file('image')){
        //     $file= $request->file('image');
        //     $filename= date('YmdHi').$file->getClientOriginalName();
        //     $file-> move(public_path('public/Image'), $filename);
        //     $data['image']= $filename;
        // }
        // $data->save();


    }

    public function updatePassword(Request $request){
        try {
            $v = Validator::make($request->all(), [
                'password'  => 'required|min:6',
            ]);

            if ($v->fails()) {
                return response()->json(['status' => 'error', 'errors' => $v->errors()], 422);
            }

            $user = auth()->user();
            $user->password = bcrypt($request->password);
            $user->save();

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'item' => null, 'message' => $e->getMessage()]);
        }
        return response()->json(['status' => 'success', 'data' => $user], 200);
    }
}
