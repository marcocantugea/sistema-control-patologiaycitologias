<?php 

namespace app\Services;

use app\Application;
use app\Models\Usuario;
use app\Handlers\Filters;
use app\Handlers\Encryptor;
use app\Interfaces\IServices;
use app\Interfaces\IRepository;
use app\Repositories\UsuariosRepositorio;

class UsuariosServicios implements IServices{

    /** @var UsuariosRepositorio $repository */
    private $repository= null;

    function getRepository() : IRepository{
        return $this->repository;
    }

    function __construct(){
        $this->repository= new UsuariosRepositorio();
    }

    public function loginUser(string $usuario,string $password){

        //revisa si el usuario es el admin configurado
        if($usuario==Application::getConfiguration('adminUser')){
            //revisamos la contrasenia
            if($password==Encryptor::encryptInfo(Application::getConfiguration('adminPass'))){
                $usuario= new Usuario();
                $usuario->user="admin";
                $usuario->email=Application::getConfiguration("adminEmail");

                Application::setSessionVariable('user',$usuario); 
                return [
                    'success'=>true,
                    'message' => 'usuario y contraseña valida',
                    'data' => $usuario
                ];
            }
        }

        //buscamos el usuario en la base de datos, si no existe regresamos
        // un objeto de respuesta que no existe el usuario o la contrasenia es invalida
        $userObj= $this->repository->getUser($usuario,$password);
        if(empty($userObj)) {
            return [
                'success'=>false,
                'message'=>'usuario y/o contraseña invalida',
                'data'=>null
            ];
        }

        return [
            'success'=>true,
            'message' => 'usuario y contraseña valida',
            'data' => $userObj
        ];

    }

    public function addUser(Usuario $user){

        //limpiamos de XSS o codigo maligno
        $user->user= Filters::xss_clean($user->user);
        $user->email= Filters::xss_clean($user->email);

        //revisamos que no este vacio el objeto $user
        if(empty($user->user) || empty($user->email) || empty($user->password)) {
            return [
                'success'=>false,
                'message' => 'informacion incompleta de usuario, favor de llenar todos los campos',
                'data' => null
            ];

        }

        //revisamos si ya existe el usuario en la base de datos
        $userFound= $this->repository->getUserByUserName($user->user);
        if(!empty($userFound)) {
            return [
                'success'=>false,
                'message' => 'el nombre de usuario ya esta registrado',
                'data' => null
            ];
        }

        //encriptamos el password del usuario
        $user->password = Encryptor::encryptInfo($user->password);

        //insertamos en la base de datos el usuario
        try {
            $response=$this->repository->add($user);
        } catch (\Throwable $th) {
            return [
                'success'=>false,
                'message' => 'Error al registrar el usuario',
                'data' => null
            ];
        }
        
        return [
            'success'=>true,
            'message' => 'Usuario registrado exitosamente',
            'data' => [
                'usuario'=>$user,
                'response'=>$response
            ]
        ];

    }

    public function getUsuarios():array {

        $listaUsuarios= $this->repository->getAll()->toArray();
        return [
            'success'=>true,
            'message'=>'lista de usuarios',
            'data'=>$listaUsuarios
        ];
    }

    public function eliminarUsuario(string $id){

        $respuesta= $this->repository->delete($id);

        return [
            'success'=>true,
            'message'=>'usuario eliminado',
            'data'=>$respuesta
        ];

    }

    public function actualizarContrasena(string $id,string $nuevaContrasena){

        if(empty($id)) 
            return [
                'success'=>false,
                'message' => 'el id esta vacio',
                'data' => null
            ];

        //obtenemos el usuario a actualizar
        $userObj = $this->repository->getById($id);

        if(empty($userObj))
            return [
                'success'=>false,
                'message' => 'El usuario no existe',
                'data' => null
            ];

        //actualizamos el password
        $userObj->password= Encryptor::encryptInfo($nuevaContrasena);
        $response=$this->repository->update($id,$userObj);

        return [
            'success'=>true,
            'message' => 'se actualizo la contraseña exitosamente',
            'data' => [
                'usuario'=>$userObj,
                'result'=>$response
            ]
        ];

    }

}