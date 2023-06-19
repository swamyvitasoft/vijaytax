<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\LoginModel;

class Dashboard extends BaseController
{
    private $loggedInfo;
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->loggedInfo = session()->get('LoggedData');
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Dashboard',
            'loggedInfo' => $this->loggedInfo
        ];
        return view('common/top', $data)
            . view('dashboard/index')
            . view('common/bottom');
    }
    public function changepwd()
    {
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Dashboard',
            'loggedInfo' => $this->loggedInfo
        ];
        return view('common/top', $data)
            . view('dashboard/changepwd')
            . view('common/bottom');
    }
    public function updatepwd()
    {
        $validation = $this->validate([
            'username' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Username is required.'
                ]
            ],
            'password' => [
                'rules'  => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must have atleast 5 characters in length.',
                    'max_length' => 'Password must not have characters more thant 20 in length.',
                ],
            ],
        ]);
        if (!$validation) {
            return  redirect()->back()->with('validation', $this->validator)->withInput();
        } else {
            $inputData = array(
                'password' => Hash::make($this->request->getPost("password"))
            );
            $query = $this->loginModel->update($this->loggedInfo['login_id'], $inputData);
            if (!$query) {
                return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
            } else {
                return  redirect()->back()->with('success', 'Your Password Changed Success');
            }
        }
    }
    public function income()
    {
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Income',
            'loggedInfo' => $this->loggedInfo
        ];
        return view('common/top', $data)
            . view('dashboard/income')
            . view('common/bottom');
    }
    public function expense()
    {
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Expense',
            'loggedInfo' => $this->loggedInfo
        ];
        return view('common/top', $data)
            . view('dashboard/expense')
            . view('common/bottom');
    }
    public function today()
    {
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Today',
            'loggedInfo' => $this->loggedInfo
        ];
        return view('common/top', $data)
            . view('dashboard/today')
            . view('common/bottom');
    }
    public function month()
    {
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Month',
            'loggedInfo' => $this->loggedInfo
        ];
        return view('common/top', $data)
            . view('dashboard/month')
            . view('common/bottom');
    }
    public function year()
    {
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Year',
            'loggedInfo' => $this->loggedInfo
        ];
        return view('common/top', $data)
            . view('dashboard/year')
            . view('common/bottom');
    }
}
