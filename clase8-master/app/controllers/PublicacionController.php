<?php

class PublicacionController extends BaseController {
    
    public function postCrear(){
        $publicacion=[
            'publicacion'=>Input::get('publicacion'),
            'tipo'=>'0',
            'usuario_id'=>Auth::user()->id,  
            'receptor'=> Input::get('receptor')
    ];
        DB::table('publicacion')->insert($publicacion);
        return Redirect::to("/perfil/ver/".Input::get('receptor'));
    }
    public function postMegusta(){
        $publicacion= Input::get('publicacion');
        $usuario= Usuario::find(Auth::user()->id);
        
        if($usuario->leGustaPublicacion($publicacion)){
            $usuario->yaNoLeGustaPublicacion($publicacion);
            $data['type']=-1;
        } else{
            $megusta = [
                'publicacion_id' => $publicacion,
                'usuario_id' => Auth::user()->id
        ];
        DB::table('me_gusta')->insert($megusta);       
        $data['type']=1;
             
        }

        $data ['nlikes'] = Publicacion::likes($publicacion);
        
        return Response::json($data);
    }
    
    public function postComentar(){
        if(Request::ajax()){
            $publicacion=Publicacion::find(Input::get('comentario'));
            //$comentario;
        };
    }
    public function getEliminar($id){
        $publicacion=Publicacion::find($id);
        if($publicacion && $publicacion->usuario_id==Auth::user()->id){
            $publicacion->delete();
        }
        return Redirect::to("/perfil");
        
    }

}
