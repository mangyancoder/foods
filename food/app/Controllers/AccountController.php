<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\AccountModel;
use App\Models\UserModel;
/**
* March 5, 2022
*/
class AccountController extends Controller
{
  public function ModAccount(){
    $municipality = $this->request->getVar('municipality');
    $barangay = $this->request->getVar('barangay');
    $sitio = $this->request->getVar('sitio');
    $hono = $this->request->getVar('hono');
    $phone = $this->request->getVar('phone');
    $session = session();
    $id = session()->get('id');
    if($municipality == '1'){
      $mun = "Baco";
    }
    if($municipality == '2'){
      $mun = "Bansud";
    }
    if($municipality == '3'){
      $mun = "Bongabong";
    }
    if($municipality == '4'){
      $mun = "Bulalacao";
    }
    if($municipality == '5'){
      $mun = "Calapan";
    }
    if($municipality == '6'){
      $mun = "Gloria";
    }
    if($municipality == '7'){
      $mun = "Mansalay";
    }
    if($municipality == '8'){
      $mun = "Naujan";
    }
    if($municipality == '9'){
      $mun = "Pinamalayan";
    }
    if($municipality == '10'){
      $mun = "Pola";
    }
    if($municipality == '11'){
      $mun = "Puerto Galera";
    }
    if($municipality == '12'){
      $mun = "Roxas";
    }
    if($municipality == '13'){
      $mun = "San Teodoro";
    }
    if($municipality == '14'){
      $mun = "Socorro";
    }
    if($municipality == '15'){
      $mun = "Victoria";
    }
    $rules = [
      'phone'      => 'required|regex_match[/^[0-9]{4}-[0-9]{3}-[0-9]{4}$/]'
    ];
    if($this->validate($rules))
    {
      $province = $this->request->getVar('province');
      $municipality = $this->request->getVar('municipality');
      $barangay = $this->request->getVar('barangay');
      $sitio = $this->request->getVar('sitio');
      $hono = $this->request->getVar('hono');
      $phone = $this->request->getVar('phone');
      $completename = $this->request->getVar('cname');
      $accountModel = new AccountModel();
      $data = [
        'completename' => $completename,
        'province'    => $province,
        'town'        => $mun,
        'barangay'    => $barangay,
        'sitio'       => $sitio,
        'hono'        => $hone,
        'phone'       => $phone,
      ];
      $accountModel->set($data)
      ->where('id',  $id)
      ->update();
      return redirect()->to('/orders');
    }else{
      $data['validation'] = $this->validator;
      $session->setFlashdata('msg', $data);
      return redirect()->to('/orders');
      // echo '<pre>';
      // print_r($data);
      // echo '</pre>';
    }
  }
  public function sendMail($to, $subject, $message){
    $session = session();
    $to = $to;
    $subject = $subject;
    $message = $message;

    $email = \Config\Services::email();
    $email->setTo($to);
    $email->setFrom('krizchan31@gmail.com', 'Confirm Registration');

    $email->setSubject($subject);
    $email->setMessage($message);
    if ($email->send())
    {
      $session->setFlashdata('msg', 'a link was sent to your email');
    }else{
      $data = $email->printDebugger(['headers']);
      $session->setFlashdata('msg', $data);
    }
  }
  public function request($type = null){
    return $type;
  }

  public function activate(){
    $municipality = $this->request->getVar('municipality');
    $barangay = $this->request->getVar('barangay');
    $sitio = $this->request->getVar('sitio');
    $hono = $this->request->getVar('hono');
    $phone = $this->request->getVar('phone');
    $token = $this->request->getVar('token');
    if($municipality == '1'){
      $mun = "Baco";
    }
    if($municipality == '2'){
      $mun = "Bansud";
    }
    if($municipality == '3'){
      $mun = "Bongabong";
    }
    if($municipality == '4'){
      $mun = "Bulalacao";
    }
    if($municipality == '5'){
      $mun = "Calapan";
    }
    if($municipality == '6'){
      $mun = "Gloria";
    }
    if($municipality == '7'){
      $mun = "Mansalay";
    }
    if($municipality == '8'){
      $mun = "Naujan";
    }
    if($municipality == '9'){
      $mun = "Pinamalayan";
    }
    if($municipality == '10'){
      $mun = "Pola";
    }
    if($municipality == '11'){
      $mun = "Puerto Galera";
    }
    if($municipality == '12'){
      $mun = "Roxas";
    }
    if($municipality == '13'){
      $mun = "San Teodoro";
    }
    if($municipality == '14'){
      $mun = "Socorro";
    }
    if($municipality == '15'){
      $mun = "Victoria";
    }
    $rules = [
      'phone'      => 'required|regex_match[/^[0-9]{4}-[0-9]{3}-[0-9]{4}$/]'
    ];
    if($this->validate($rules))
    {
      $province = $this->request->getVar('province');
      $municipality = $this->request->getVar('municipality');
      $barangay = $this->request->getVar('barangay');
      $sitio = $this->request->getVar('sitio');
      $hono = $this->request->getVar('hono');
      $phone = $this->request->getVar('phone');
      $completename = $this->request->getVar('cname');
      $accountModel = new AccountModel();
      $data = [
        'completename' => $completename,
        'province'    => $province,
        'town'        => $mun,
        'barangay'    => $barangay,
        'sitio'       => $sitio,
        'hono'        => $hone,
        'phone'       => $phone,
        'astatus'      => 'active',
        'token' => $this->verification(50)

      ];
      // print_r($data);
      echo $token;
      $accountModel->set($data)
      ->where('token',  $token)
      ->update();
      return redirect()->to('/signin');
    }else{
      $data['validation'] = $this->validator;
      echo view('verify', $data);
    }

  }
  public function verify($token = null){
    $session = session();
    $accountModel = new AccountModel();
    $data = $accountModel->where('token', $token)->first();
    if($data){
      $data['token'] = $token;
      return view('complete', $data);
    }else{
      $session->setFlashdata('msg', '<h1>Invalid Link</h1>');
      return redirect()->to('/signin');
    }
  }
  // public function verify($token = null){
  //   $session = session();
  //   $accountModel = new AccountModel();
  //   $data = $accountModel->where('token', $token)->first();
  //
  //   if($data){
  //     $data = [
  //       'status' => 'active',
  //       'token' => $this->verification(50)
  //     ];
  //
  //     $accountModel->set($data)
  //                  ->where('token',  $token)
  //                  ->update();
  //     $session->setFlashdata('msg', '<h1>Account verified</h1>');
  //     return redirect()->to('/signin');
  //
  //   }else{
  //     $session->setFlashdata('msg', '<h1>Invalid Link</h1>');
  //     return redirect()->to('/signin');
  //   }
  // }
  public function accountreset($token = null)
  {
    $session = session();
    $accountModel = new AccountModel();
    $data = $accountModel->where('token', $token)->first();
    if($data){
      // $session->setFlashdata('msg', '<h1>Enter new Password</h1>');
      $data['token'] = $token;
      return view('changepass', $data);
    }else{
      $session->setFlashdata('msg', '<h1>Invalid Link</h1>');
      return redirect()->to('/signin');
    }
  }
  public function changePass(){
    $session = session();
    helper(['form']);
    $accountModel = new AccountModel();
    $password = $this->request->getVar('password');
    $confirmpassword = $this->request->getVar('confirmpassword');
    $token = $this->request->getVar('token');
    $rules = [
      'password'      => 'required|min_length[4]|max_length[50]',
      'confirmpassword'  => 'matches[password]'
    ];

    if($this->validate($rules))
    {
      $data = [
        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        'token'    => $this->verification(50),
      ];
      $accountModel->set($data)
      ->where('token',  $token)
      ->update();
      return redirect()->to('/signin');
    }else{
      $data['validation'] = $this->validator;
      echo view('changepass', $data);
    }
  }
  public function resetAccount(){
    $session = session();
    $userModel = new AccountModel();
    $to = $this->request->getVar('email');
    $data = $userModel->where('email', $to)->first();
    if($data){
      $token = $data['token'];
      $subject = 'password reset';
      $message = "Please click the link to reset your password <a href='".base_url('/accountreset'). '/'. $token ."'>here</a>";
      $this->sendMail($to, $subject, $message);
    }else{
      $session->setFlashdata('msg', 'Email does not exist.');
    }
    return redirect()->to('/signin');
  }
  public function forgot(){
    return view('forgot');
  }
  public function index(){
    return view('index');
  }
  public function verification($length){
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($str_result),
    0, $length);
  }
  public function register(){
    helper(['form']);
    $data = [];
    echo view('register', $data);
  }
  public function signin(){
    helper(['form']);
    helper("cookie");
    echo view('login');
  }
  public function store()
  {
    $session = session();
    helper(['form']);
    $rules = [
      'name'          => 'required|min_length[2]|max_length[50]',
      'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[accounts.email]',
      'password'      => 'required|min_length[4]|max_length[50]',
      'confirmpassword'  => 'matches[password]'
    ];

    if($this->validate($rules)){
      $userModel = new AccountModel();
      $token =$this->verification(50);
      $data = [
        'username'     => $this->request->getVar('name'),
        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        'email'    => $this->request->getVar('email'),
        'type'     => 'client',
        'astatus'   => 'inactive',
        'token'    => $token
      ];
      $userModel->save($data);
      $session->setFlashdata('msg', 'Please check your email address to confirm your Registration');
      $to = $this->request->getVar('email');
      $name = $this->request->getVar('name');
      $subject = 'Please confirm your registration';
      $message ='Hi ' .$name .'<br><h1>welcome to website!</h1>

      please confirm your registration by clicking this <a href="' . base_url('/verify') . '/' . $token .' ">link</a>';
      $this->sendMail($to, $subject, $message);
      return redirect()->to('/signin');
    }else{
      $data['validation'] = $this->validator;
      echo view('register', $data);
    }
  }
  public function auth()
  {
    $email = $this->request->getVar('username');
    $password = $this->request->getVar('password');
    // $url = $this->request->getVar('url');
    $session = session();
    // $session()->setTempdata('url', $url);
    $userModel = new UserModel();
    $data = $userModel->where('email', $email)->first();
    if($data){
      $pass = $data['password'];
      $authenticatePassword = password_verify($password, $pass);
      if($authenticatePassword){
        $user = $data['uid'];
        $session_data = [
          'uid' => $user,
          'name' => $data['uname'],
          'email'=>$email,
          'phone' =>$data['phone'],
          'type'=> $data['utype'],
          'isLoggedIn' => TRUE
        ];
        $session->set($session_data);
        echo 1;
      }else{
        echo 0;
      }
    }else{
      echo 0;
    }
  }
  public function validates()
  {
    $isLoggedIn = session()->get('isLoggedIn');
    $user =session()->get('name');
    $type = session()->get('type');
    $loopback = session()->get('url');
    if($isLoggedIn){
      echo $type;
      if($type == 'client'){
        return redirect()->to('/');
      }elseif($type =='admin') {
        return redirect()->to('/admin');
      }
    }else{
      return redirect()->to(base_url(). '/');
    }


  }
  public function logout(){
    $session = session();
    $session->destroy();
    return redirect()->to('/');
  }

}
