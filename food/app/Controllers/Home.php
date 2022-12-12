<?php

namespace App\Controllers;
use App\Models\Booking;
use App\Models\ProductModel;
use App\Models\Category;
use App\Models\PackagesModel;
use App\Models\OrderModel;
use App\Models\SalesModel;
use App\Models\DeliveryModel;
use App\Models\TransHistory;
use App\Models\GCashModel;
use App\Models\ReservationModel;
use App\Models\PackageList;
use App\Models\CommentModel;
use App\Models\SiteModel;
use App\Models\OrderPaymentModel;
class Home extends BaseController
{
  public function getUserNo()
  {
    $phone = session()->get('phone');
    return $phone;
  }
  public function getUserEmail()
  {
    $email = session()->get('email');
    return $email;
  }

  public function sendMail($subject, $message){
    $session = session();
    $to = $this->getUserEmail();
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
  public function sendSms($message=null){

    $email = "johnwarfrickv@gmail.com";
    $apicode = 'PR-JOHNW325318_BMLTF';
    $password = 'johnwarfrick';
    $number = $this->getUserNo();
    $SenderId = "VIA ITM";
    $ch = curl_init();
    $recipient = array();
    array_push($recipient, $number);
    $itexmo = array('Email' => $email,  'Password' => $password, 'ApiCode' => $apicode,'Recipients' => $recipient, 'Message' => $message, 'SenderId' =>$SenderId);
    curl_setopt($ch, CURLOPT_URL,"https://api.itexmo.com/api/broadcast");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($itexmo));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    return curl_exec ($ch);
    curl_close ($ch);
  }
  
  public function mybooking()
  {
    $user =  $this->getUserID();
    $book = new Booking();
    $site = new SiteModel();
    $data = [
      'site' => $site->first(),
      'booking' => $book->where('userID', $user)->findAll(),
    ];
    return view('mybookings', $data);
  }
  public function verification($length){
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($str_result),
    0, $length);
  }
  public function view($id=null)
  {
    $product = new ProductModel();
    $site = new SiteModel();
    $data = [
      'site' => $site->first(),
      'pr' => $product->where('pid', $id)->first()
    ];
    return view('view', $data);
  }
  public function categories($id =null)
  {
    $pr = new ProductModel();
    $site= new SiteModel();
    $cat = new Category();
    $site = new SiteModel();
    $data = [
      'site' => $site->first(),
      'product' => $pr->where('category', $id)->findAll(),
      'site' => $site->first(),
      'categories' => $cat->where('cid', $id)->first(),
    ];
    return view('categories', $data);

  }
  public function orders()
  {
    $uid =session()->get('uid');
    $order = new OrderModel();
    $site = new SiteModel();
    $data = [
      'site' => $site->first(),
      'product' => $order->where('userID', $uid)->findAll(),
    ];
    return view('orders', $data);
  }
  public function sbook()
  {
    $ds = session()->get('ds');
    $uid =session()->get('uid');
    $package = $this->request->getVar('package');
    $price = $this->request->getVar('price');
    $mop = $this->request->getVar('mop');
    $dt = '';
    if (empty($_FILES['file']['file'])) {
      $image = $this->request->getFile('file');
      $imageName = $image->getName();
      $dir = 'gcash/payments/';
      if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
      }
      $image->move($dir . '/', $imageName);
      $ggp = $dir.$imageName;
      // echo $imageName;
      $data = [
        'userID'  =>  $uid,
        'title'   =>  $ds['title'],
        'start'   =>  $ds['start'],
        'end'     =>  $ds['end'],
        'pax'     =>  $ds['pax'],
        'package' =>  $package,
        'amount'  =>  $price,
        'email'   =>  $ds['email'],
        'phones'  =>  $ds['phones'],
        'location'=>  $ds['location'],
        'mop'     =>  $mop,
        'gproof'  =>  $ggp,
        'bstatus' =>  'pending'
      ];

    }
    $b = new Booking();
    $isLoggedIn = session()->get('isLoggedIn');
    if($isLoggedIn):
      $b->save($data);
      $session = session();
      $session->removeTempdata('ds');
      $session->setFlashdata('msg', 'New Reservation was submitted for evaluation');
      return redirect()->to('/bookc');

    endif;
  }

  public function cbook()
  {
    $ds = session()->get('ds');
    $uid =session()->get('uid');
    $mop = $this->request->getVar('mop');
    $package = $this->request->getVar('package');
    $product = $this->request->getVar('product');
    $price = $this->request->getVar('price');
    $data = [
      'userID'  =>  $uid,
      'title'   =>  $ds['title'],
      'start'   =>  $ds['start'],
      'end'     =>  $ds['end'],
      'pax'     =>  $ds['pax'],
      'package' =>  $package,
      'product'=>   $product,
      'amount'  =>  $price,
      'email'   =>  $ds['email'],
      'phones'  =>  $ds['phones'],
      'location'=>  $ds['location'],
      'mop'     =>  $mop,
      'gproof'  =>  '',
      'bstatus' =>  'pending'
    ];
    $b = new Booking();
    $isLoggedIn = session()->get('isLoggedIn');
    if($isLoggedIn):
      $b->save($data);
      $session = session();
      $session->removeTempdata('ds');
      $session->setFlashdata('msg', 'New Reservation was submitted for evaluation');
      return redirect()->to('/bookc');

    endif;
  }
  public function checkc()
  {
    $sm = new SalesModel();
    $th = new TransHistory();
    $opy = new OrderPaymentModel();
    $img;
    if ( 0 < $_FILES['file']['error'] ) {
      echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
      move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
      $img = 'uploads/' . $_FILES['file']['name'];
    }
    $id = $this->request->getVar('id');
    $tlid = $this->request->getVar('tlid');
    $amount = $this->request->getVar('amount');
    $data = [
      'o_tlid' => $tlid,
      'status' => 'pending'
    ];
    $d1 = [
      'tlid' => $tlid,
      'tstatus' => 'Order was Placed'
    ];
    // foreach ($id as $d) {
    $where = [
      'oid' =>$id
    ];
    $gg = [
      'tlid' =>$tlid,
      'type' =>'gcash',
      'amount'=>$amount,
      'picture'=>$img,

    ];
    $sm->where($where)->set($data)->update();
    $th->save($d1);
    $opy->save($gg);
    // sms
    $message = "We have received your order with order no. ". $tlid . ". Please check your email address for receipt.\nthank you for patronizing us!";


    // $this->sendSms($message);
    // $this->sendMail($subject, $body);

  }
  public function checkd()
  {
    $sm = new SalesModel();
    $th = new TransHistory();
    $opy = new OrderPaymentModel();
    $id = $this->request->getVar('id');
    $tlid = $this->request->getVar('tlid');
    $data = [
      'o_tlid' => $tlid,
      'status' => 'pending'
    ];
    $d1 = [
      'tlid' => $tlid,
      'tstatus' => 'Order was Placed'
    ];
    // foreach ($id as $d) {
    $where = [
      'oid' =>$id
    ];

    $sm->where($where)->set($data)->update();
    $th->save($d1);
    $opy->save($gg);
    // sms
    $message = "We have received your order with order no. ". $tlid . ". Please check your email address for receipt.\nthank you for patronizing us!";


    // $this->sendSms($message);
    // $this->sendMail($subject, $body);
  }
  public function checkout()
  {
    $sm = new SalesModel();
    $th = new TransHistory();
    $id = $this->request->getVar('id');
    $tlid = $this->verification(10);
    $data = [
      'o_tlid' => $tlid,
      'status' => 'pending'
    ];
    $d1 = [
      'tlid' => $tlid,
      'tstatus' => 'Order was Placed'
    ];

    foreach ($id as $d) {
      $where = [
        'oid' =>$d
      ];
      $sm->where($where)->set($data)->update();
    }
    // $session->setFlashdata('msg', 'Facebook page ID was updated');
    $th->save($d1);
    return 'okay';
    // return redirect()->to('/');

  }
  public function products()
  {
    $pr= new ProductModel();
    $cat = new Category();
    $cart = new SalesModel();
    $id = $this->getUserID();
    $site = new SiteModel();
    $data = [
      'site' => $site->first(),
      'count'   => $cart->select('count(*) as count')->where('userID', $id)->where('status', 'added')->first(),
      'category' => $cat->findAll(),
      'product' => $pr->join('category', 'product.category=category.cid')->findAll(),
      'htype' => 'transparent',
    ];
    return view('products', $data);
  }
  public function packages()
  {
    $pk = new PackagesModel();
    $site = new SiteModel();
    $data = [
      'site' => $site->first(),
      'packages' => $pk->findAll(),
      'htype' => '',
    ];
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    return view('packages', $data);
  }
  public function cart()
  {
    $cart = new SalesModel();
    $ds = new DeliveryModel();
    $gc = new GCashModel();
    $id = $this->getUserID();
    $site = new SiteModel();
    $data = [
      'site' => $site->first(),
      'val'     => $ds->first(),
      'gcash'    => $gc->first(),
      'count'   => $cart->select('count(*) as count')->where('userID', $id)->where('status','added')->first(),
      'product' => $cart->where('status', 'added')->where('userID', $id)->findAll(),
      'tlid'    => $this->verification(10)
    ];
    $val = $cart->where('status', 'added')->where('userID', $id)->findAll();
    // if(!$val){
    //   echo 'wala';
    // }else{
     return view('cart', $data);
    // }
  }
  public function addtocart()
  {
    $productID = $this->request->getVar('productID');
    $type = $this->request->getVar('type');
    $price = $this->request->getVar('price');
    $quantity = $this->request->getVar('quantity');
    $sales = new SalesModel();
    // $session = session();
    $isLoggedIn = session()->get('isLoggedIn');
    $uid =session()->get('uid');

    if($isLoggedIn):
      $checker = $sales->where('packageID', $productID)->where('userID', $uid)->where('type', $type)->where('status', 'added')->first();
      if($checker){
        $qty = $checker['o_quantity'] + $quantity;
        $data = [
          'packageID' =>$productID,
          'userID'    =>$uid,
          'status'    => 'added',
          'o_quantity' => $qty,
          'p_price'   => $price,
          'type'      => $type,
        ];
        $sales->set($data)->where('oid', $checker['oid'])->update();
        echo 'updated';
      }else{
        $data = [
          'packageID' =>$productID,
          'userID'    =>$uid,
          'status'    => 'added',
          'o_quantity'=> $quantity,
          'p_price'   => $price,
          'type'      => $type,
        ];
        $sales->save($data);
        echo 'okay';
      }

    else:
      echo 'please login';
    endif;

  }
  public function comment()
  {
    $comment = new CommentModel();
    $msg = $this->request->getVar('comment');
    $rating = $this->request->getVar('rating');
    $id = $this->getUserID();
    $data = [
      'userID' => $id,
      'rating' => $rating,
      'comment' => $msg,
      'status' => 'posted'
    ];

    $comment->save($data);
    return redirect()->to($_SERVER['HTTP_REFERER']);
  }
  public function getUserID()
  {

    $id = session()->get('uid');
    return $id;
  }

  public function index()
  {
    $pr= new ProductModel();
    $cat = new Category();
    $comment = new CommentModel();
    $cart = new SalesModel();
    $site = new SiteModel();
    // $uid =session()->get('uid');
    $id = $this->getUserID();
    $data = [
      'count'   => $cart->select('count(*) as count')->where('userID', $id)->where('status', 'added')->first(),
      'category'=> $cat->findAll(),
      'product' => $pr->join('category', 'product.category=category.cid')->paginate(12),
      'htype'   => 'transparent',
      'message' => $comment->join('users', 'users.uid=comment.userID')->orderBy('cmid', 'RANDOM')->limit(10)->findAll(),
      'site'  => $site->first(),
      'rn1' =>$pr->where('category', '1')->orderBy('pid', 'RANDOM')->limit(3)->findAll(),
      'rn2' =>$pr->where('category', '2')->orderBy('pid', 'RANDOM')->limit(3)->findAll(),
      'uid' => $this->getUserID(),
    ];

    return view('index', $data);
  }
  public function bookc()
  {
    $site = new SiteModel();
    $data = [
      'site' => $site->first()
    ];
    return view('bookc', $data);
  }
  public function check()
  {
    $book = new Booking();
    $st = $this->request->getVar('st');
    $ed = $this->request->getVar('ed');

    $data = $book->where('date(start)<=', $st)->where('date(end)>=', $ed)->findAll();
    // $data = $book->select('(select * from booking where date(start) ='.$st .'and date(end) = '.$ed .')', false);
    if($data):
      echo '<pre>';
      print_r($data);
      echo '</pre>';
    else:
      echo 'wala';
    endif;
  }
  public function checkb()
  {
    $session = session();
    $site = new SiteModel();
    $cat = new Category();
    $ds = [
      'title' => $this->request->getVar('title'),
      'start' => $this->request->getVar('start'),
      'end' => $this->request->getVar('end'),
      'pax' => $this->request->getVar('pax'),
      'email' => $this->request->getVar('email'),
      'location' => $this->request->getVar('location'),
      'phones' => $this->request->getVar('phones'),
    ];

    if (!$ds) {
      return redirect()->to('/bookc');
    }else{
      $isLoggedIn = session()->get('isLoggedIn');
      $user =session()->get('type');
      $uid =session()->get('uid');
      if($isLoggedIn):
        $session->setTempdata('ds', $ds);
        // $a = session()->get('ds');
        $pk = new PackagesModel();
        $data = [
          'packages' => $pk->findAll(),
          'htype' => '',
          'category' => $cat->findAll(),
          'site' => $site->first(),
        ];

        return view('continueb', $data);
      endif;
    }
  }
  public function testpayment()
  {
    $pr = $this->request->getPost('products');
    $pcid = $this->request->getPost('pcid');
    $product = new ProductModel();
    $plist = new PackageList();
    $site = new SiteModel();
    $gc= new GCashModel();
    $rs = new ReservationModel();
    $data = $plist->where('packageID', $pcid)->findAll();
    foreach ($data as $fd) {
      $cat =  $fd['pl_category'];
      $count = $fd['pl_quantity'];

    }


    $data = [
      'product' => $pr,
      'packages' => $this->request->getVar('add'),
      'gcash'    => $gc->first(),
      'reservation'=>$rs->where('status', 'active')->first(),
      'package' =>$pcid,
      'site' => $site->first(),
    ];
    return view('cart1', $data);
  }
  public function angular()
  {
    return view('angular');
  }
  public function sample()
  {
    $pk = new PackagesModel();
    $data['names'] = $pk->findAll();
    echo json_encode($data);
  }
  public function cpayment()
  {
    $add = $this->request->getVar('add');
    $gc= new GCashModel();
    $rs = new ReservationModel();
    $site = new SiteModel();
    $data = [
      'packages' => $this->request->getVar('add'),
      'gcash'    => $gc->first(),
      'reservation'=>$rs->where('status', 'active')->first(),
      'site' => $site->first(),
    ];
    // $ass = session()->get('ds');
    // if(!$ass):
    // return redirect()->to('/bookc');
    // else:
    return view('payment',  $data);
    // endif;

  }
  public function kpayment()
  {
    $prod = $this->request->getVar('products');
    $pcid = $this->request->getVar('pcid');
    $pl = new PackageList();
    $pr = new ProductModel();
    foreach($prod as $pra){
      $data = $pr->where('pid', $pra)->first();
      // echo
      // $f = $pl->where('pl_category', $data['category'])->first();
      // echo $f['pl_quantity'] . '- '. $f['pl_category'] . '<br>';
    }
    return view('payment');
  }
  // public function checkb()
  // {
  //   $book = new Booking();
  //   $title = $this->request->getVar('title');
  //   $start = $this->request->getVar('start');
  //   $end = $this->request->getVar('end');
  //   $pax = $this->request->getVar('pax');
  //   $email = $this->request->getVar('email');
  //   $location = $this->request->getVar('location');
  //   $phones = $this->request->getVar('phones');
  //   $isLoggedIn = session()->get('isLoggedIn');
  //   $user =session()->get('type');
  //   $uid =session()->get('uid');
  //   if($isLoggedIn):
  //     $data = [
  //       'userID' => $uid,
  //       'title' => $title,
  //       'start' => $start,
  //       'end' => $end,
  //       'pax' => $pax,
  //       'email' => $email,
  //       'phones' => $phones,
  //       'location' => $location,
  //       'bstatus' => 'pending'
  //     ];
  //     $book->save($data);
  //     $session = session();
  //     $session->setFlashdata('msg', 'New package was created. please add food product to this package');
  //     return redirect()->to($_SERVER['HTTP_REFERER']);
  //     // echo'<pre>';
  //     // print_r($data);
  //     // echo'</pre>';
  //   endif;
  //
  // }
}
