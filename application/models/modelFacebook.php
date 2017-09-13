<?php

class modelFacebook extends Model
{

//Получаем логин линку
 function fbgetloginlink(){


$fb=$this->fbSdk();


$helper = $fb->getRedirectLoginHelper();


//Права доступа
$permissions = ['public_profile,email'];

$loginUrl = $helper->getLoginUrl(FB_URL.'facebook/callback', $permissions);

$loginUrl= htmlspecialchars($loginUrl);

$data['loginurl']=$loginUrl;

return $data;
}


 //Получаем данные юзера
 function fbgetUser($accessToken){


$fb=$this->fbSdk();

$helper = $fb->getRedirectLoginHelper();

$fbErrors=array();



try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  $fbErrors['Graph returned an error: ']=$e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
$fbErrors['Facebook SDK returned an error: ']=$e->getMessage();
  exit;
}

  if (isset($accessToken)) {
    
    $fb->setDefaultAccessToken($accessToken);
    try {
      //Получаеммые поля
      $response = $fb->get('/me?fields=id,name,email,gender');
      $userNode = $response->getGraphUser();
    }catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
   $fbErrors['Graph returned an error: ']=$e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
    $fbErrors['Facebook SDK returned an error: ']=$e->getMessage();
      exit;}


      //Формируем обьект юзера
      $fbuser = array(
        'fb_id'=>$userNode->getId(),
        'name'=>$userNode->getName(),
        'email'=>$userNode->getProperty('email'),
        'gender'=>$userNode->getProperty('gender'),
        //Получаем аватар
        'image'=>'https://graph.facebook.com/'.$userNode->getId().'/picture?width=50'
        );


 

  }
 //Подготавливаем данные для передачи в контроллер
     $data = array(
        'user'=>$fbuser,
        'errors'=>$fbErrors,
        'access_token'=> (string) $accessToken
        );

//Заносим обьект пользователя в сессию
$_SESSION['fb_user'] = $fbuser;


return $data;


  }

 //Записываем юзера в Базу Данных
  function sendUserToDb($user){

    $this->getredbeans();


    

   


   $us= R::findOne( 'users', 'user_fbid = '.$user['fb_id']);

    //делаем проверку. Если пользователь с Facebook ID есть в базе - обновляем данные. 
    //Если нет - заносим
    if($us!==NULL){
    $usr = R::load( 'users', $us['id'] );
    $usr->user_fbid=$user['fb_id'];
    $usr->name=$user['name'];
    $usr->email=$user['email'];
    $usr->gender=$user['gender'];
    $usr->image=$user['image'];
    R::store($usr);

    } else {

    $fbuser =  R::dispense('users');
    $fbuser->user_fbid=$user['fb_id'];
    $fbuser->name=$user['name'];
    $fbuser->email=$user['email'];
    $fbuser->gender=$user['gender'];
    $fbuser->image=$user['image'];
    R::store($fbuser);

    }

    
    

  }

  //Логаут
  function fblogout(){

    unset($_SESSION['fb_user']);

  }







































// Методы без PHP SDK (тестовые)
  //Получаем логин линку
    function oldgetloginlink(){

      require_once '/../config/facebookcfg.php';

       $loginlink = 'https://www.facebook.com/'.FB_DGV.'/dialog/oauth?client_id='.FB_ID.'&redirect_uri='.FB_URL.'&response_type=code&scope=public_profile,email';

       return $data=array(
        'loginurl'=>$loginlink

        );
    }

    //Получаем данные юзера
    function oldGetUser($code){

      require_once '/../config/facebookcfg.php';

      if (!$code) {
        exit('error code');
      }


      $token = json_decode(file_get_contents('https://graph.facebook.com/'.FB_DGV.'/oauth/access_token?client_id='.FB_ID.'&redirect_uri='.FB_URL.'&client_secret='.FB_SECRET.'&code='.$code), true);

      if (!$token) {
        exit('error token');
      }

      $data = json_decode(file_get_contents('https://graph.facebook.com/'.FB_DGV.'/me?client_id='.FB_ID.'&redirect_uri='.FB_URL.'&client_secret='.FB_SECRET.'&code='.$code.'&access_token='.$token['access_token'].'&fields=id,name,email,gender'), true);

      if (!$data) {
        exit('error data');
      }

      $data['image'] = 'https://graph.facebook.com/'.FB_DGV.'/'.$data['id'].'/picture?width=100';

      $data['loginurl']='';


       return $data;


    }






}