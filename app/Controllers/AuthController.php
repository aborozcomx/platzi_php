<?php
    namespace App\Controllers;
    use App\Models\User;
    use Respect\Validation\Validator as v;
    use Zend\Diactoros\Response\RedirectResponse;
    
    class AuthController extends BaseController {
        public function getLogin(){
            return $this->renderHTML('login.twig');
        }

        public function postLogin($request){
            $postData = $request->getParsedBody();
            $responseMessage = null;
            $user = User::where('email', $postData['email'])->first();
            if($user){
                if(\password_verify($postData['password'],$user->password)){
                    return new RedirectResponse('/platzi_php/admin');
                }else{
                    $responseMessage = 'Bad credentials';
                }
            }else{
                $responseMessage = 'Bad credentials';
                
            }

            return $this->renderHTML('login.twig',[
                'responseMessage' => $responseMessage
            ]);
        }
    }