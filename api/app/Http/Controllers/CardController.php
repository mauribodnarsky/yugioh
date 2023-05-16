<?php

namespace App\Http\Controllers;

use App\Models\Card as Model;
use Illuminate\Http\Request;
use Exception;
use Hamcrest\Type\IsInteger;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=Model::all();
        return response()->json(['response'=>$result],200);
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try{
            $dataCard = $request->all();
            $model = new Model();
            $datacreate = $dataCard;
            unset($datacreate['image']);
            $result = $model->create($datacreate);
            if($request->file('image')) {
                $logo = $request->file('image');
                $dataCard['image'] = $logo->getClientOriginalName(); 
            } else {
                $dataCard['image'] = '';
            }
            
            if(is_numeric($result->id)) {
                // Creamos una carpeta para la imagen si no existe
                if($request->file('image')) {
                    $carpetalogo = public_path('img/cartas/' . $result->id.'/');
                    if (!file_exists($carpetalogo)) {
                        mkdir($carpetalogo, 0777, true);
                    }
    
                    // Obtenemos el nombre original de la imagen
                    $nombreImage = $logo->getClientOriginalName();
                    // Guardamos la imagen en la carpeta correspondiente
                    $logo->move($carpetalogo, $nombreImage);
                    $imagePath = "img/cartas/". $result->id."/".$logo->getClientOriginalName();
                    $id=$result->id;
                    $result = $model->where('id', $result->id)->update(['image' => $imagePath]);
                    $result = $model->where('id', $id)->first();
                }
            }
    
        } catch(Exception $e) {
            return response()->json(['error'=>$e->getmessage()],400);
        }
    
        return response()->json(['response'=>$result],200);
    }
    

    
    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $dataCard = $request->all();
            $model = new Model();
            $datacreate = $dataCard;
            unset($datacreate['image']);
            $result = $model->where('id', $request->input('id'))->update($datacreate);


            if($request->file('image')) {
                $logo = $request->file('image');
                $dataCard['image'] = $logo->getClientOriginalName(); 
            } else {
                $dataCard['image'] = '';
            }
            
            if(is_numeric($request->input('id'))) {
                // Creamos una carpeta para la imagen si no existe
                if($request->file('image')) {
                    $carpetalogo = public_path('img/cartas/' . $request->input('id').'/');
                    if (!file_exists($carpetalogo)) {
                        mkdir($carpetalogo, 0777, true);
                    }
    
                    // Obtenemos el nombre original de la imagen
                    $nombreImage = $logo->getClientOriginalName();
                    // Guardamos la imagen en la carpeta correspondiente
                    $logo->move($carpetalogo, $nombreImage);
                    $imagePath = "img/cartas/". $request->input('id')."/".$logo->getClientOriginalName();
                    $id=$request->input('id');
                    $result = $model->where('id', $request->input('id'))->update(['image' => $imagePath]);
                    $result = $model->where('id', $id)->first();
                }
            }
    
        } catch(Exception $e) {
            return response()->json(['error'=>$e->getmessage()],400);
        }
    
        return response()->json(['response'=>$result],200);
    }
    
    public function destroy( $id)
    {
        try{

            $registro = Model::find($id);
            if ($registro) {
                $registro->delete();
                $registro=true;
            }else{
                $registro="no existe la carta.";
            }

        }catch(Exception $e){
            return response()->json(['error'=>$e->getmessage()],400);
        }
        return response()->json(['response'=>$registro],200);

    }
    public function search(Request $request)
    {
        
        // Realiza la búsqueda en la base de datos
        $result= Model::where('name', 'like', '%' . $request->input('search') . '%')->get();
        
        return response()->json(['response'=>$result],200);
    }
}
