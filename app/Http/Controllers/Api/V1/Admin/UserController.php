<?php
/**
 * Created by PhpStorm.
 * User: leviton
 * Date: 17/08/2016
 * Time: 15:26
 */

namespace ApiWebPsp\Http\Controllers\Api\V1\Admin;

use ApiWebPsp\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ApiWebPsp\Services\UserService;
use ApiWebPsp\Services\PermissionService;

class UserController extends Controller
{

    use UtilTrait;
    /**
     * @var UserService
     */
    private $service;
    private $permissionService;

    /**
     * UserController constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service, PermissionService $permissionService)
    {
        $this->service = $service;
        $this->permissionService = $permissionService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
    */
    public function login(Request $request)
    {
        /*
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type");
        header('Content-Type: application/json');
        */


        $data = $request->all();
        $data360 = new \stdClass();
        if (isset($data['token360'])) {
            $token360 = $data['token360'];
            $userData = $this->getAuthenticatedUser360($token360);

            if (!$userData)
                return response()->json(["error" => "invalid_credentials", "message" => "The token credentials was incorrect."]);

            $userData = $userData->user;
            //$username = $userData->email;
            $username = $userData->username;
            //$password = md5($userData->email);
            $password = md5($userData->username);


            $data['username'] = $username;
            $data['password'] = $password;

            $data360->token_type = "Bearer";
            $data360->access_token = $token360;


        }
        else {
            $username = $request->input('username');
            $password = $request->input('password');

            $data360 = $this->login360($request->all());

            if ($data360->success == false) {
                $resp = new \stdClass();
                $resp = $data360;
                return response()->json($resp);
            } else
                $data360->access_token = $data360->token;

        }



        $user = $this->service->getEmail($username);

        if (!$user) {
            $userPermissions = array();
            $permissions = $this->permissionService->get();
            foreach ($permissions as $permission) {
                $userPermissions[$permission->id] = true;
            }

            $userData = [
                'name' => $username,
                'email' => $username,
                'password' => $password,
                'role' => 'admin',
                'img_profile' => '',
                'status' => 'ativo',
                'permission' => []
            ];
            $result = $this->service->create($userData);

            $user = $this->service->getEmail($username);
        }

        $id = (int) $user['id'];
        $this->service->updatePass($id, $password);

        $data = $this->loginLocal($data);
        $data->data360 = $data360;

        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return mixed
     *
     * @transformercollection \ApiWebPsp\Transformers\UserTransformer
     * @transformerModel \ApiWebPsp\Models\User
     */
    public function index(Request $request)
    {
        $status = $request->get('status')?$request->get('status'):'ativo';
        return $this->service->getUsers($status);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     *
     * @bodyParam name string required. Example: Leiviton
     * @bodyParam email string required e email valido. Example: example@example.com
     * @bodyParam role nivel do usuário. Example: admin
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email',
            'role' => 'required'
        ], [
            'name.required' => 'Nome do usuário é obrigatório',
            'name.length' => 'Nome deve conter no minimo 4 caracteres',
            'email.email' => 'Email precisa ser um endereço válido',
            'email.unique' => 'Email já está em uso no sistema',
            'role.required' => 'Tipo de usuário é obrigatório'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $data = $request->all();

        $result = $this->service->create($data);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Cadastro realizado com sucesso', 'status' => 'success', 'title' => 'Sucesso','user' => $result['user']], 201);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function permission(Request $request)
    {
        $data = $request->all();

        $result = $this->service->createPermission($data['user_id'],$data['permission_id']);

        if ($result['status'] == 'success') {
            return response()->json(['message' => $result['message'], 'status' => 'success', 'title' => 'Sucesso'], 201);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updatePassword($id, Request $request)
    {
        $validator = Validator($request->all(),
            [
                'password' => 'required|min:6',
                'password_repeat' => 'required|same:password'
            ],
            [
                'password.required' => 'Senha é obritaoria',
                'password.length' => 'Tamanho da senha invádio',
                'password_repeat.same' => 'Campo confirmar senha diferente de senha',
                'password_repeat.required' => 'Campo confirmar senha é obritaorio'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $result = $this->service->updatePassword($id, $request->get('password'));

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'ALteração de Senha realizada com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @return mixed
     */
    public function authenticated()
    {
        $user = \Auth::guard()->user();
        return $this->service->authenticated($user->id);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateStatus($id, Request $request)
    {

        $result = $this->service->updateStatus($id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Status atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update($id, Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|min:4',
            'role' => 'required'
        ], [
            'name.required' => 'Nome do usuário é obrigatório',
            'name.length' => 'Nome deve conter no minimo 4 caracteres',
            'role.required' => 'Nível de usuário é obrigatório'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $result = $this->service->update($request->all(),$id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Usuario atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete($id) {
        $result = $this->service->delete($id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Usuario excluido com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @return mixed
     */
    public function getAttendant()
    {
        return $this->service->getUsersAttend();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->service->getId($id);
    }

}
