<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\ExpenseModel;
use App\Models\IncomeModel;
use App\Models\LoginModel;

class Dashboard extends BaseController
{
    private $loggedInfo;
    private $loginModel;
    private $incomeModel;
    private $expenseModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->loggedInfo = session()->get('LoggedData');
        $this->incomeModel = new IncomeModel();
        $this->expenseModel = new ExpenseModel();
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
    public function incomeAction()
    {
        $validation = $this->validate([
            'incomeType' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ],
            'panNo' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ],
            'name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ],
            'mobile' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ],
            'year' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ],
            'tAmount' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ],
            'pAmount' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ],
            'dAmount' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ],
            'paymentType' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ],
            'note' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ]
        ]);
        if (!$validation) {
            return  redirect()->back()->with('validation', $this->validator)->withInput();
        } else {
            $inputData = [
                'incomeType' => $this->request->getPost("incomeType"),
                'panNo' => $this->request->getPost("panNo"),
                'name' => $this->request->getPost("name"),
                'mobile' => $this->request->getPost("mobile"),
                'year' => $this->request->getPost("year"),
                'tAmount' => $this->request->getPost("tAmount"),
                'pAmount' => $this->request->getPost("pAmount"),
                'dAmount' => $this->request->getPost("dAmount"),
                'paymentType' => $this->request->getPost("paymentType"),
                'note' => $this->request->getPost("note"),
                'login_id' => $this->loggedInfo['login_id'],
                'status' => 1,
                'createDate' => date('Y-m-d H:i:s'),
                'modifyDate' => date('Y-m-d H:i:s')
            ];
            $query = $this->incomeModel->insert($inputData);
            $incomeId = $this->incomeModel->getInsertID();
        }
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
        } else {
            return  redirect()->to('dashboard/index')->with('success', 'Congratulations! Saved');
        }
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
    public function expenseAction()
    {
        $validation = $this->validate([
            'expenseType' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ],
            'pAmount' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ],
            'paymentType' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ],
            'note' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'required.'
                ]
            ]
        ]);
        if (!$validation) {
            return  redirect()->back()->with('validation', $this->validator)->withInput();
        } else {
            $inputData = [
                'expenseType' => $this->request->getPost("expenseType"),
                'pAmount' => $this->request->getPost("pAmount"),
                'paymentType' => $this->request->getPost("paymentType"),
                'note' => $this->request->getPost("note"),
                'login_id' => $this->loggedInfo['login_id'],
                'status' => 1,
                'createDate' => date('Y-m-d H:i:s'),
                'modifyDate' => date('Y-m-d H:i:s')
            ];
            $query = $this->expenseModel->insert($inputData);
            $expenseId = $this->expenseModel->getInsertID();
        }
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
        } else {
            return  redirect()->to('dashboard/index')->with('success', 'Congratulations! Saved');
        }
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
