<?php

namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\PackagesModel;
use App\Models\PackageList;
use App\Models\SalesModel;
use App\Models\Booking;
use App\Models\TransHistory;
use App\Models\SmsModel;
use App\Models\GCashModel;
use App\Models\DeliveryModel;
use App\Models\BPayment;
use App\Models\ReservationModel;
use App\Models\UserModel;
use App\Models\WalkinModel;
use App\Models\Category;
use App\Models\SiteModel;
use App\Models\ OrderPaymentModel;

class AdminController extends BaseController
{

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
  public function sendSms($message=null, $no = null){
    $email = "johnwarfrickv@gmail.com";
    $apicode = 'PR-JOHNW325318_BMLTF';
    $password = 'johnwarfrick';
    $number = $no;
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
  public function graph()
  {
    $order = new SalesModel();
    // $all = $order->findAll();
    $all = $order->select('SUM(p_price) as total, YEAR(ocreated_at) as year')->groupBy('YEAR(ocreated_at), YEAR(p_price)')->findAll();
    echo json_encode($all);
  }
  public function reservation()
  {
    $rv = new ReservationModel();
    $data = [
      'reservation' =>$rv->findAll(),
      'transactID' => $this->verification(12),
    ];
    return view('admin/reservation', $data);
  }
  public function confirmb()
  {
    $name = $this->request->getVar('name');
    $type = $this->request->getVar('type');
    $amount = $this->request->getVar('amount');
    $bid = $this->request->getVar('bid');
    $user = $this->request->getVar('user');
    $no = $this->getUserNo($user);
    $data = [
      'bid'=> $bid,
      'payor' => $name,
      'userID' => $user,
      'type' => $type,
      'amount'=> $amount
    ];
    $dt = [
      'bstatus' => 'approved',
    ];
    $bp  = new BPayment();
    $bk = new Booking();
    $bp->save($data);
    $bk->set($dt)->where('id', $bid)->update();
    $message = 'We have received your ' . $type .' amounting of ' . $amount;
    $this->sendSms($message, $no);
    return redirect()->to($_SERVER['HTTP_REFERER']);

  }
  public function ev($id = null)
  {

    $book = new Booking();
    $bp = new BPayment();
    $data = [
      'header' => 'Events',
      'book' => $book->join('users', 'book.userID=users.uid', 'inner')->where('id', $id)->first(),
      'payment' =>$bp->where('bid', $id)->findAll(),
      'bid' =>$id,
      'transactID' => $this->verification(12),
    ];
    // var_dump($data);
    return view('admin/events', $data);
  }
  public function calendar()
  {
    return view('admin/calendar');
  }

    public function index()
    {
      $order = new SalesModel();
      $book = new Booking();
      $today = date('Y-m-d');
      $data = [
        'header'      =>  'Welcome back! ',
        'pcount'      => $order->select('count(*) as count')->where('status', 'pending')->groupBy('o_tlid')->first(),
        'pprocess'    => $order->select('count(*) as count')->where('status', 'processing')->groupBy('o_tlid')->first(),
        'bookcount'   => $book->select('count(*) as count')->where('bstatus', 'pending')->first(),
        'scount'      => $book->select('count(*) as count')->where('bstatus', 'approved')->first(),
        'dsalescount' => $order->select('sum(p_price) as price')->where('status', 'processed')->where('date(ocreated_at)', $today)->first(),
        'net'         => $order->select('sum(p_price) as sales')->where('status', 'processed')->first(),
        'events'         => $book->where('bstatus', 'approved')->findAll(),
        'transactID' => $this->verification(12),
      ];
      // var_dump($data);
      $isLoggedIn = session()->get('isLoggedIn');
      $uid =session()->get('uid');
      if($isLoggedIn):
        if(session()->get('type') =='admin'){
          return view('admin/index', $data);
        }else{
          return redirect()->to('/');
        }
      else:
        return redirect()->to('/');
      endif;
    }
    public function dailysales($date =null)
    {
      $order = new SalesModel();
      $book = new Booking();
      $today = date('Y-m-d');
      $data = [
        'header'      => 'Daily Sales ' . $today,
        'pcount'      => $order->select('count(*) as count')->where('status', 'pending')->groupBy('o_tlid')->first(),
        'pprocess'    => $order->select('count(*) as count')->where('status', 'processing')->groupBy('o_tlid')->first(),
        'bookcount'   => $book->select('count(*) as count')->where('bstatus', 'pending')->first(),
        'scount'      => $book->select('count(*) as count')->where('bstatus', 'approved')->first(),
        'dsalescount' => $order->select('sum(p_price) as price')->where('status', 'processed')->where('date(ocreated_at)', $today)->first(),
        'net'         => $order->select('sum(p_price) as sales')->where('status', 'processed')->first(),
        'today'       => $order->select('sum(p_price) as price')->where('status', 'processed')->where('date(ocreated_at)', $date)->first(),
        'data'        => $order->join('users', 'orders.userID=users.uid')->where('date(ocreated_at)', $date)->where('status', 'processed')->groupBy('o_tlid')->findAll(),
        'transactID' => $this->verification(12),
      ];
      // var_dump($data);
        return view('admin/tsales', $data);
    }
    public function netsales()
    {
      $order = new SalesModel();
      $book = new Booking();
      $today = date('Y-m-d');

      $data = [
        'header'      => 'Net Sales as of ' .$today,
        'pcount'      => $order->select('count(*) as count')->where('status', 'pending')->groupBy('o_tlid')->first(),
        'pprocess'    => $order->select('count(*) as count')->where('status', 'processing')->groupBy('o_tlid')->first(),
        'bookcount'   => $book->select('count(*) as count')->where('bstatus', 'pending')->first(),
        'scount'      => $book->select('count(*) as count')->where('bstatus', 'approved')->first(),
        'dsalescount' => $order->select('sum(p_price) as price')->where('status', 'processed')->where('date(ocreated_at)', $today)->first(),
        'net'         => $order->select('sum(p_price) as sales')->where('status', 'processed')->first(),
        'today'       => $order->select('sum(p_price) as price')->where('status', 'processed')->first(),
        'data'        => $order->join('users', 'orders.userID=users.uid')->where('status', 'processed')->groupBy('o_tlid')->findAll(),
        'transactID' => $this->verification(12),
      ];
      // var_dump($data);
      return view('admin/tsales', $data);
    }
    public function confirmprocessing()
    {
        $orders = new SalesModel();
        $th= new TransHistory();
        $id= $this->request->getVar('id');
        $userID= $this->request->getVar('userID');
        $no = $this->getUserNo($userID);
        $session = session();
        if(isset($_POST['declined'])){
          $data = [
            'status' => 'declined'
          ];
          $up  = [
            'tlid' =>$id,
            'tstatus' => 'Your order was declined.'
          ];
          $session->setFlashdata('msg', 'Order was declined');
        }elseif(isset($_POST['yes'])){
          $data = [
            'status' => 'processed'
          ];
          $up  = [
            'tlid' =>$id,
            'tstatus' => 'Your order was set to delivered or claimed.'
          ];
          $session->setFlashdata('msg', 'Order was confirmed');
        }
        $orders->where('o_tlid', $id)->set($data)->update();
        $th->save($up);
        $message ="Your order with transaction no ". $id ." was ready for pick up/delivery";
        $this->sendSms($message, $no);
        return redirect()->to('/admin/pending');

    }
    public function getUserNo($userID = null)
    {
      $user = new UserModel();
      $no = $user->where('uid', $userID)->first();
      return $no['phone'];
    }
    public function orderval()
    {
      $orders = new SalesModel();
      $th= new TransHistory();
      $py = new OrderPaymentModel();
      $id= $this->request->getVar('id');
      $userID= $this->request->getVar('userID');
      $no = $this->getUserNo($userID);
      $session = session();
      if(isset($_POST['declined'])){
        $data = [
          'status' => 'declined'
        ];
        $up  = [
          'tlid' =>$id,
          'tstatus' => 'Your order was declined.'
        ];
        $session->setFlashdata('msg', 'Order was declined');
      }else{
        $amount= $this->request->getVar('amount');
        $ptype= $this->request->getVar('ptype');
        $odata = [
          'tlid' => $id,
          'type' => $ptype,
          'amount'=>$amount,
        ];
        $data = [
          'status' => 'processing'
        ];
        $up  = [
          'tlid' =>$id,
          'tstatus' => 'Your order was received and now processing.'
        ];
        $session->setFlashdata('msg', 'Order was confirmed');
      }

      $orders->where('o_tlid', $id)->set($data)->update();
      $th->save($up);
      $py->save($odata);
      $message ="Your order with transaction no ". $id ." was confirmed and received ". $amount . " as your payment";
      $this->sendSms($message, $no);
      return redirect()->to('/admin/pending');

    }
    public function viewpending($id=null)
    {
      $sales = new SalesModel();
      $orders = $sales->where('o_tlid', $id)->where('status', 'pending')->first();
      $py = new OrderPaymentModel();
      if($orders):
        $type = $orders['type'];
          $data = [
            'tp' =>'pending',
            'id' =>$id,
            'ss' => $sales->join('product', 'orders.packageID=product.pid')->where('o_tlid', $id)->where('status', 'pending')->findAll(),
            'userID' => $orders['userID'],
            'transactID' => $this->verification(12),
            'payment' => $py->where('tlid', $id)->findAll(),
            ];
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
        return view('admin/vieworders', $data);
      else:
        return redirect()->to('/admin/pending');
      endif;

    }
    public function viewtrans($id=null)
    {
      $sales = new SalesModel();
      $orders = $sales->where('o_tlid', $id)->where('status', 'processed')->first();
      if($orders):
        $type = $orders['type'];
          $data = [
            'ordering_date' => $orders['ocreated_at'],
            'transacted_date'=>$orders['oupdated_at'],
            'header'=>'Transaction',
            'tp'    =>'transacted',
            'id'   => $id,
            'userID' => $orders['userID'],
            'transactID' => $this->verification(12),
            ];
        return view('admin/viewsales', $data);
      else:
        return redirect()->to('/admin');
      endif;

    }
    public function viewprocessing($id=null)
    {
      $sales = new SalesModel();
      $py = new OrderPaymentModel();
      $orders = $sales->where('o_tlid', $id)->where('status', 'processing')->first();
      if($orders):
        $type = $orders['type'];
          $data = [
            'tp'  => 'processing',
            'id'   => $id,
            'userID' => $orders['userID'],
            'ss' => $sales->join('product', 'orders.packageID=product.pid')->where('o_tlid', $id)->where('status', 'processing')->findAll(),
            'transactID' => $this->verification(12),
            'payment' => $py->where('tlid', $id)->findAll(),
            ];
        return view('admin/vieworders', $data);
      else:
        return redirect()->to('/admin/processing');
      endif;

    }
    public function viewprocessed($id=null)
    {
      $sales = new SalesModel();
      $py = new OrderPaymentModel();
      $orders = $sales->where('o_tlid', $id)->where('status', 'processed')->first();
      if($orders):
        $type = $orders['type'];
          $data = [
            'tp'  =>'processed',
            'ss' => $sales->join('product', 'orders.packageID=product.pid')->where('o_tlid', $id)->where('status', 'processed')->findAll(),
            'id'   => $id,
            'userID' => $orders['userID'],
            'payment' => $py->where('tlid', $id)->findAll(),
            ];
        return view('admin/vieworders', $data);
      else:
        return redirect()->to('/admin/processed');
      endif;

    }
    public function addorders()
    {
      $sales = new SalesModel();
      $uid =session()->get('uid');
      $o_tlid = $this->request->getVar('otlid');
      $packageID = $this->request->getVar('packageID');
      $userID =  $uid;
      $status ='added';
      $o_quantity = $this->request->getVar('quantity');
      $p_price =$this->request->getVar('p_price');
      $type = 'single';
      $data = [
        'o_tlid' => $o_tlid,
        'packageID' => $packageID,
        'userID'  => $userID,
        'status'  => $status,
        'o_quantity' => $o_quantity,
        'p_price' => $p_price,
        'type'  => $type,
    ];
    $sales->save($data);
    return  'okay';
    }
    public function getTotal($id = null)
    {
      $sales = new SalesModel();
      $sum = $sales->where('o_tlid', $id)->findAll();
      $price = 0;
      foreach ($sum as $s) {
        // $price+= $s['oprice'] * $s['oquantity'];
        $price += $s['oprice'];
      }
      echo'Total: ₱ '. number_format($price,2);
    }
    public function getpend($id=null)
    {
      $order = new SalesModel();
      $orders =  $order->join('product', 'orders.packageID=product.pid')->where('o_tlid', $id)->findAll();
      foreach ($orders as $or) {
          $array[] = $or;
      }
      $dataset = array(
          "echo" => 1,
          "totalrecords" => count($array),
          "totaldisplayrecords" => count($array),
          "data" => $array
      );
      return json_encode($dataset);
      // echo '<pre>';
      // print_r($dataset);
      // echo '</pre>';
    }
    public function verification($length){
      $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      return substr(str_shuffle($str_result),
      0, $length);
    }
    public function vieworders($id =null)
    {
      $orders = new SalesModel();
      $data = [
        'orders' => $orders->join('walkin', 'orders.o_tlid=walkin.tlid')->join('users', 'walkin.clientID=users.uid')->where('o_tlid', $id)->findAll(),
        'tlid' => $id,
        // 'sum' => $orders->where('o_tlid', $id)->findAll(),
      ];
      return view('admin/vieworder', $data);

    }
    public function transaction()
    {
      #walkin transactions only
      $walkin = new WalkinModel();
      $data = [
        'rr' => $walkin->join('users', 'walkin.clientID=users.uid')->findAll()
      ];
      return view('admin/transactions', $data);
    }
    public function transact()
    {
      $sales = new SalesModel();
      $walkin = new WalkinModel();
      $client = $this->request->getVar('client');
      $amount = $this->request->getVar('amount');
      $total = $this->request->getVar('total');
      $transactID = $this->request->getVar('transactID');
      $session = session();
      if(is_numeric($amount)){
        if($total > $amount){
          $dd = 'amount must be higher than ordering amount';
        }else{
          $dd = 'okay';
          $data = [
            'tlid'=>$transactID,
            'total' => $total,
            'amount' => $amount,
            'clientID' => $client,
          ];
          $sdd = [
            'status' =>'done'
          ];
          $change = $amount - $total;
          $session->setFlashdata('msg', 'Change : ' . $change);
          $walkin->save($data);
          $sales->set($sdd)->where('o_tlid', $transactID)->update();

        }
      }else{
        $session->setFlashdata('msg', 'input must be number ');
        return redirect()->to($_SERVER['HTTP_REFERER']);
      }

      return redirect()->to('/admin/sales/'. $this->verification(12));
    }
    public function sales($id = null)
    {
      $or = new ProductModel();
      $sales = new SalesModel();
      $client = new UserModel();
      $data = [
        'sum' => $sales->where('o_tlid', $id)->findAll(),
        'type' =>  'sales',
        'transactID' => $id,
        'products' => $or->findAll(),
        'orders' =>  $sales->join('product', 'orders.packageID=product.pid')->where('o_tlid', $id)->where('status', 'added')->findAll(),
        'client'  => $client->findAll()
        // 'transactID' => $this->verification(12),
      ];

      return view('admin/benta', $data);
    }
    public function events()
    {
      $book = new Booking();
      $data = $book->where('bstatus', 'approved')->findAll();

      echo json_encode($data);
    }
    public function booked()
    {
      $book = new Booking();
      $data = [
        'header'  => 'All Bookings',
        'type'  =>  'booked',
        'transactID' => $this->verification(12),
        'fd'  => $book->findAll()
      ];
      return view('admin/book', $data);
    }
    public function pbooking()
    {
      $book = new Booking();
      $data = [
        'header' => 'Pending Booking',
        'type'  =>  'pending',
        'transactID' => $this->verification(12),
        'fd'  => $book->join('users', 'book.userID=users.uid')->where('bstatus', 'pending')->findAll()
      ];
      return view('admin/book', $data);
    }
    public function dbooking()
    {
      $book = new Booking();
      $today = date('Y-m-d');
      $data = [
        'header'=>'Done Bookings',
        'type'  =>  'done',
        'transactID' => $this->verification(12),
        'fd'  => $book->where('date(end) <', $today )->where('bstatus', 'approved')->findAll()
      ];
      return view('admin/book', $data);
    }
    public function cbooking()
    {
      $book = new Booking();
      $data = [
        'header'=>'Approved Bookings',
        'type'  =>  'done',
        'transactID' => $this->verification(12),
        'fd'  => $book->join('users','book.userID=users.uid')->where('bstatus', 'approved')->findAll()
      ];
      return view('admin/book', $data);
    }

    public function pending()
    {
      $th = new TransHistory();
      $data = [
        'header' =>'Pending Orders',
        'types' => 'Pending Orders',
        'type'  =>'pending',
        'transactID' => $this->verification(12),
        'trans' => $th->join('orders', 'transhistory.tlid=orders.o_tlid')->join('users', 'orders.userID=users.uid')->groupBy('o_tlid')->where('status', 'pending')->findAll(),
      ];
      // var_dump($data);
      return view('admin/sales', $data);
    }
    public function processing()
    {
      $th = new TransHistory();
      $data = [
        'header' => 'Processing Orders',
        'type' => 'processing',
        'transactID' => $this->verification(12),
        // 'trans' => $or->join('users', 'users.uid=orders.userID')->where('status', 'processing')->findAll(),
        'trans' => $th->join('orders', 'transhistory.tlid=orders.o_tlid')->join('users', 'orders.userID=users.uid')->groupBy('o_tlid')->where('status', 'processing')->findAll(),
      ];
      return view('admin/sales', $data);
    }
    public function processed()
    {
      $th = new TransHistory();
      $data = [
        'header'=>'Processed Orders',
        'type' => 'processed',
        'transactID' => $this->verification(12),
        // 'trans' => $or->join('users', 'users.uid=orders.userID')->where('status', 'processed')->findAll(),
        'trans' => $th->join('orders', 'transhistory.tlid=orders.o_tlid')->join('users', 'orders.userID=users.uid')->groupBy('o_tlid')->where('status', 'processed')->findAll(),
      ];
      return view('admin/sales', $data);
    }
    public function additems()
    {
      $pl = new PackageList();
      $lid = $this->request->getVar('lid');
      $quantity = $this->request->getVar('quantity');

      $session = session();
      $pl->where('packageID', $lid)->delete();
      if(isset($_POST['category'])){
        $category = $this->request->getVar('category');
        foreach( $category as $index => $cat ) {
          // $category = $kcat;
          // echo $cat['quantity'];
          $data = [
            'packageID' => $lid,
            'pl_quantity' => $quantity[$index],
            'pl_category' =>$cat
          ];


          $pl->insert($data);
          $session->setFlashdata('msg', 'Package was updated');
        }
      }else{
         $session->setFlashdata('msg', 'Package was updated');
      }
      return redirect()->to($_SERVER['HTTP_REFERER']);
    }
    public function packages()
    {
      $pc = new PackagesModel();
      $cat = new Category();
      $product = new ProductModel();
      $data = [
        'packages' => $pc->findAll(),
        'products' => $product->findAll(),
        'transactID' => $this->verification(12),
        'category' => $cat->findAll(),
      ];
      return view('admin/packages', $data);
    }
    public function updatepackages()
    {
      $pc = new PackagesModel();
      if(isset($_POST['updatepackages'])):
        $nfile=0;
        $id = $this->request->getVar('id');
        if($_FILES['file']['size'] == 0){
          $nfile = $this->request->getVar('old_banner');
          echo 'hindi nagupload';
        }else{
          $image = $this->request->getFile('file');
          $imageName = $image->getName();
          $dir = 'package_banner/';
          $nfile = $dir.$imageName;
          if (!file_exists($dir)) {
          mkdir($dir, 0777, true);
          }
          $image->move($dir . '/', $imageName);
          echo 'nagupload';
        }

        $data = [
          'package_name' => $this->request->getVar('name'),
          'package_description' => $this->request->getVar('description'),
          'package_banner' => $nfile,
          'price' => $this->request->getVar('price'),
          'promo' => $this->request->getVar('promo'),
          'validity'  => $this->request->getVar('validity'),
        ];
        // echo $nfile;
        $pc->update($id,$data);
        $session = session();
        $session->setFlashdata('msg', 'New package was created. please add food product to this package');
        return redirect()->to($_SERVER['HTTP_REFERER']);
      else:
        $session = session();
        $session->setFlashdata('msg', 'unable to create new package');
        return redirect()->to($_SERVER['HTTP_REFERER']);
      endif;


    }
    public function updateproducts()
    {
      $pc = new ProductModel();
      if(isset($_POST['updateproducts'])):
        $nfile=0;
        $id = $this->request->getVar('id');
        if($_FILES['file']['size'] == 0){
          $nfile = $this->request->getVar('old_banner');
          echo 'hindi nagupload';
        }else{
          $image = $this->request->getFile('file');
          $imageName = $image->getName();
          $dir = 'assets/images/products/';
          $nfile = $dir.$imageName;
          if (!file_exists($dir)) {
          mkdir($dir, 0777, true);
          }
          $image->move($dir . '/', $imageName);
          echo 'nagupload';
        }

        $data = [
          'name' => $this->request->getVar('name'),
          'description' => $this->request->getVar('description'),
          'picture' => $nfile,
          'price' => $this->request->getVar('price'),
        ];
        // echo $nfile;
        $pc->update($id,$data);
        $session = session();
        $session->setFlashdata('msg', 'Product was updated');
        return redirect()->to($_SERVER['HTTP_REFERER']);
      else:
        $session = session();
        $session->setFlashdata('msg', 'unable to modify product');
        return redirect()->to($_SERVER['HTTP_REFERER']);
      endif;
    }
    public function addproduct()
    {
      $pc = new ProductModel();
      if(isset($_POST['create'])):
        // echo 'fsdgdfd';
        $image = $this->request->getFile('file');
        $imageName = $image->getName();
        $dir = 'assets/images/products/';
        if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
        }
        $image->move($dir . '/', $imageName);

        $data = [
          'name' => $this->request->getVar('name'),
          'description' => $this->request->getVar('description'),
          'category' =>$this->request->getVar('category'),
          'picture' => $dir.$imageName,
          'price' => $this->request->getVar('price'),
          'stock' =>'0'
        ];
        $pc->insert($data);
        $session = session();
        $session->setFlashdata('msg', 'New Product was added');
        return redirect()->to($_SERVER['HTTP_REFERER']);
      else:
        $session = session();
        $session->setFlashdata('msg', 'unable to create new product');
        return redirect()->to($_SERVER['HTTP_REFERER']);
      endif;

    }
    public function createpackage()
    {
      $pc = new PackagesModel();
      if(isset($_POST['create'])):
        // echo 'fsdgdfd';
        $image = $this->request->getFile('file');
        $imageName = $image->getName();
        $dir = 'package_banner/';
        if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
        }
        $image->move($dir . '/', $imageName);

        $data = [
          'package_name' => $this->request->getVar('name'),
          'package_description' => $this->request->getVar('description'),
          'package_banner' => $dir.$imageName,
          'price' => $this->request->getVar('price'),
          'promo' => $this->request->getVar('promo'),
          'validity'  => $this->request->getVar('validity'),
        ];
        $pc->insert($data);
        $session = session();
        $session->setFlashdata('msg', 'New package was created. please add food product to this package');
        return redirect()->to($_SERVER['HTTP_REFERER']);
      else:
        $session = session();
        $session->setFlashdata('msg', 'unable to create new package');
        return redirect()->to($_SERVER['HTTP_REFERER']);
      endif;


    }
    public function products()
    {
      $pr = new ProductModel();
      $cat = new Category();
      $data = [
        'products' => $pr->findAll(),
        'transactID' => $this->verification(12),
        'category' => $cat->findAll(),
      ];
        return view('admin/products', $data);
    }
    public function viewproducts()
    {
        return view('admin/view_products');
    }


    public function sms()
    {
      $sms = new SmsModel();
      $data = [
        'header' => 'SMS Settings',
        'api' =>$sms->findAll(),
        'transactID' => $this->verification(12),
      ];
      return view('admin/sms', $data);
    }
    public function addapi()
    {
      $api = $this->request->getVar('api');
      $pwd = $this->request->getVar('pwd');
      $validity = $this->request->getVar('validity');
      $sms = new SmsModel();
      $data = [
        'api' => $api,
        'pwd' => $pwd,
        'validity' => $validity,
        'status' =>'inactive'
      ];
      $sms->save($data);
      $session = session();
      $session->setFlashdata('msg', 'New API Account was added');
      return redirect()->to($_SERVER['HTTP_REFERER']);
    }
    public function smsremove($id=null)
    {
      $sms = new SmsModel();
      $sms->where('sid', $id)->delete();
      $session = session();
      $session->setFlashdata('smsg', 'SMS Api was removed');
      return redirect()->to($_SERVER['HTTP_REFERER']);
    }
    public function remove($id = null)
    {
      $sales = new SalesModel();
      $sales->where('oid', $id)->delete();
    }
    public function gcashremove($id=null)
    {
      $gcash = new GCashModel();
      $gcash->where('gid', $id)->delete();
      $session = session();
      $session->setFlashdata('smsg', 'Gcash Information was removed');
      return redirect()->to($_SERVER['HTTP_REFERER']);
    }
    public function gcashmod($id=null)
    {
      $gcash = new GCashModel();
      $data = $gcash->where('gid', $id)->first();
      if($data):
        if ($data['gcash'] == 'off') {
          $gcash->set('gcash', 'on')->where('gid', $id)->update();
        } else{
          $gcash->set('gcash', 'off')->where('gid', $id)->update();
        }
      endif;
      $session = session();
      $session->setFlashdata('smsg', 'Gcash Payment was modified');
      return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function smsmod($id=null)
    {
      $sms = new SmsModel();
      $data = $sms->where('sid', $id)->first();
      if($data):
        if ($data['status'] == 'inactive') {
          $sms->set('status', 'active')->where('sid', $id)->update();
        } else{
          $sms->set('status', 'inactive')->where('sid', $id)->update();
        }
      endif;
      $session = session();
      $session->setFlashdata('smsg', 'SMS Api was modified');
      return redirect()->to($_SERVER['HTTP_REFERER']);
    }
    public function addgqr()
    {
      $del = new GCashModel();
      $image = $this->request->getFile('file');
      $imageName = $image->getName();
      $dir = 'images/qr';
      if (!file_exists($dir)) {
      mkdir($dir, 0777, true);
      }
      $image->move($dir . '/', $imageName);
      $data = [
        'gcash' => 'off',
        'g_no'  =>$this->request->getVar('no'),
        'g_qr' => '/'. $dir.'/' . $imageName,
      ];
      $del->insert($data);
      $session = session();
      $session->setFlashdata('msg', 'GCash Information was added');
      return redirect()->to($_SERVER['HTTP_REFERER']);
    }
    public function addrs()
    {
      $session  = session();
      $rs = new ReservationModel();
      $percentage = $this->request->getVar('percentage');
      $data = [
        'amount' => $percentage,
        'status' => 'inactive'
      ];
      $rs->save($data);
      $session->setFlashdata('msg', 'Reservation fee was added');
      return redirect()->to($_SERVER['HTTP_REFERER']);
    }
    public function add_del()
    {
      $dels = new DeliveryModel();
      $del = $this->request->getVar('del');
      $dstatus = $this->request->getVar('dstatus');
      if($dstatus == 'on'){
        $data = [
          'del_amount' => $del,
          'dstatus' => 'on'
        ];
        // $dels->save($data);
      }else{
        $data = [
          'del_amount' => $del,
          'dstatus' => 'off'
        ];

      }
      $dels->save($data);
      $session = session();
      $session->setFlashdata('msg', 'delivery Information was added');
      return redirect()->to($_SERVER['HTTP_REFERER']);

    }
    public function delmod($id=null)
    {

      $sms = new DeliveryModel();
      $data = $sms->where('did', $id)->first();
      if($data):
        if ($data['dstatus'] == 'inactive') {
          $sms->set('dstatus', 'active')->where('did', $id)->update();
        } else{
          $sms->set('dstatus', 'inactive')->where('did', $id)->update();
        }
      endif;
      $session = session();
      $session->setFlashdata('smsg', 'Delivery  was modified');
      return redirect()->to($_SERVER['HTTP_REFERER']);

    }
    public function rsmod($id=null)
    {

      $sms = new ReservationModel();
      $data = $sms->where('rid', $id)->first();
      if($data):
        if ($data['status'] == 'inactive') {
          $sms->set('status', 'active')->where('rid', $id)->update();
        } else{
          $sms->set('status', 'inactive')->where('rid', $id)->update();
        }
      endif;
      $session = session();
      $session->setFlashdata('smsg', 'Status change');
      return redirect()->to($_SERVER['HTTP_REFERER']);

    }
    public function delremove($id=null)
    {
      $del = new DeliveryModel();
      $del->where('did', $id)->delete();
      $session = session();
      $session->setFlashdata('smsg', 'Delivery chargewas removed');
      return redirect()->to($_SERVER['HTTP_REFERER']);
    }
    public function delrs($id=null)
    {
      $del = new ReservationModel();
      $del->where('rid', $id)->delete();
      $session = session();
      $session->setFlashdata('smsg', 'Status change');
      return redirect()->to($_SERVER['HTTP_REFERER']);
    }
    public function store()
    {
      $site = new SiteModel();
      $data = [
        'site' =>$site->first()
      ];
      return view('admin/store', $data);
    }
    public function siteinfo()
    {
      $site = new SiteModel();
      $data = [
        'name' =>$this->request->getVar('name'),
        'description' =>$this->request->getVar('description'),
        'address' =>$this->request->getVar('address'),
        'contact_no' =>$this->request->getVar('contact'),
        'email' =>$this->request->getVar('email'),
      ];
      $site->set($data)->where('id', '1')->update();
      $session = session();
      $session->setFlashdata('msg', 'Site information changed');
      return redirect()->to($_SERVER['HTTP_REFERER']);
    }
    public function gcash()
    {
      $del = new GCashModel();
      $data = [
        'header' =>'Gcash',
        'gcash' => $del->findAll(),
        'transactID' => $this->verification(12),
      ];
      return view('admin/gcash', $data);
    }
    public function delivery()
    {
      $del = new DeliveryModel();
      $data = [
        'delivery'=>$del->findAll(),
        'header'=>'Delivery Settings '
      ];
      return view('admin/delivery', $data);
    }

}
