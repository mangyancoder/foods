<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Noauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
      if (session()->get('isLoggedIn')) {
        // if (session()->get('type') == "admin") {
        //   return redirect()->to(base_url('admin'));
        // }
        // if (session()->get('type') == "client") {
        //   return redirect()->to(base_url('editor'));
        // }
        // if (session()->get('type') == "owner") {
        //   return redirect()->to(base_url('store'));
        // }
      }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
