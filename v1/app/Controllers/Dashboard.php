<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\CustomersModel;
use App\Models\LoginModel;
use App\Models\PaymentsModel;

class Dashboard extends BaseController
{
    private $loggedInfo;
    private $loginModel;
    private $customersModel;
    private $paymentsModel;
    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->loggedInfo = session()->get('LoggedData');
        $this->customersModel = new CustomersModel();
        $this->paymentsModel = new PaymentsModel();
    }
    public function index()
    {
        $payments = $this->paymentsModel->select('sum(tAmount) as tAmount,sum(pAmount) as pAmount,sum(dAmount) as dAmount')->orderBy('income_expense', 'DESC')->groupBy('income_expense')->findAll();
        $date = date('d-m-Y');
        $paymentsToday = $this->paymentsModel->select('sum(tAmount) as tAmount,sum(pAmount) as pAmount,sum(dAmount) as dAmount')->where(['DATE_FORMAT(paymentDate, "%Y-%m-%d")' => date('Y-m-d', strtotime($date))])->orderBy('income_expense', 'DESC')->groupBy('income_expense')->findAll();
        $paymentsMonth = $this->paymentsModel->select('sum(tAmount) as tAmount,sum(pAmount) as pAmount,sum(dAmount) as dAmount')->where(['DATE_FORMAT(paymentDate, "%Y-%m")' => date('Y-m', strtotime($date))])->orderBy('income_expense', 'DESC')->groupBy('income_expense')->findAll();
        $paymentsYear = $this->paymentsModel->select('sum(tAmount) as tAmount,sum(pAmount) as pAmount,sum(dAmount) as dAmount')->where(['DATE_FORMAT(paymentDate, "%Y")' => date('Y', strtotime($date))])->orderBy('income_expense', 'DESC')->groupBy('income_expense')->findAll();
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Dashboard',
            'loggedInfo' => $this->loggedInfo,
            'payments' => $payments,
            'paymentsToday' => $paymentsToday,
            'paymentsMonth' => $paymentsMonth,
            'paymentsYear' => $paymentsYear
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
    public function customer()
    {
        $panNo = $this->request->getPost("panNo");
        $customerData = $this->customersModel->where(['panNo' => $panNo])->findAll();
        if (!empty($customerData)) {
            $data = [
                'success' => true,
                'customer_id'   => $customerData[0]['customer_id'],
                'panNo'   => $customerData[0]['panNo'],
                'name'   => $customerData[0]['name'],
                'mobile'   => $customerData[0]['mobile'],
                'msg' => "Exists customer Check your Data"
            ];
        } else {
            $data = [
                'customer_id' => ''
            ];
        }
        return $this->response->setJSON($data);
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
            $panNo = $this->request->getPost("panNo");
            $custom = $this->customersModel->where('panNo', $panNo)->first();
            if (!empty($custom)) {
                $customer_id = $custom['customer_id'];
            } else {
                $customer = [
                    'panNo' => $panNo,
                    'name' => $this->request->getPost("name"),
                    'mobile' => $this->request->getPost("mobile"),
                    'login_id' => $this->loggedInfo['login_id'],
                    'status' => 1,
                    'createDate' => date('Y-m-d H:i:s'),
                ];
                $this->customersModel->insert($customer);
                $customer_id = $this->customersModel->getInsertID();
            }
            $inputData = [
                'customer_id' => $customer_id,
                'income_expense' => 'Income',
                'categoryType' => $this->request->getPost("incomeType"),
                'year' => $this->request->getPost("year"),
                'tAmount' => $this->request->getPost("tAmount"),
                'pAmount' => $this->request->getPost("pAmount"),
                'dAmount' => $this->request->getPost("dAmount"),
                'paymentType' => $this->request->getPost("paymentType"),
                'note' => $this->request->getPost("note"),
                'login_id' => $this->loggedInfo['login_id'],
                'status' => 1,
                'paymentDate' => date('Y-m-d H:i:s')
            ];
            $query = $this->paymentsModel->insert($inputData);
            $paymentId  = $this->paymentsModel->getInsertID();
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
                'customer_id' => 1,
                'income_expense' => 'Expense',
                'categoryType' => $this->request->getPost("expenseType"),
                'year' => date('Y'),
                'tAmount' => $this->request->getPost("pAmount"),
                'pAmount' => $this->request->getPost("pAmount"),
                'dAmount' => 0,
                'paymentType' => $this->request->getPost("paymentType"),
                'note' => $this->request->getPost("note"),
                'login_id' => $this->loggedInfo['login_id'],
                'status' => 1,
                'paymentDate' => date('Y-m-d H:i:s')
            ];
            $query = $this->paymentsModel->insert($inputData);
            $paymentId = $this->paymentsModel->getInsertID();
        }
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
        } else {
            return  redirect()->to('dashboard/index')->with('success', 'Congratulations! Saved');
        }
    }
    public function yearView()
    {
        $years = $this->paymentsModel->select('paymentDate')->orderBy('paymentDate', 'desc')->groupBy('DATE_FORMAT(paymentDate, "%Y")')->findAll();
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Year View',
            'loggedInfo' => $this->loggedInfo,
            'years' => $years
        ];
        return view('common/top', $data)
            . view('dashboard/yearView')
            . view('common/bottom');
    }
    public function monthView()
    {
        $year = json_encode($this->request->getPost("year"));
        $months = $this->paymentsModel->select('paymentDate')->where(['DATE_FORMAT(paymentDate, "%Y")' => date('Y', strtotime(json_decode($year)))])->orderBy('paymentDate', 'desc')->groupBy('DATE_FORMAT(paymentDate, "%Y-%m")')->findAll();
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Month View',
            'loggedInfo' => $this->loggedInfo,
            'months' => $months
        ];
        return view('common/top', $data)
            . view('dashboard/monthView')
            . view('common/bottom');
    }
    public function dayView()
    {
        $month = json_encode($this->request->getPost("month"));
        $days = $this->paymentsModel->select('paymentDate')->where(['DATE_FORMAT(paymentDate, "%Y-%m")' => date('Y-m', strtotime(json_decode($month)))])->orderBy('paymentDate', 'desc')->groupBy('DATE_FORMAT(paymentDate, "%Y-%m-%d")')->findAll();
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Day View',
            'loggedInfo' => $this->loggedInfo,
            'days' => $days
        ];
        return view('common/top', $data)
            . view('dashboard/dayView')
            . view('common/bottom');
    }
    public function details()
    {
        $day = json_encode($this->request->getPost("day"));
        $details = $this->paymentsModel->select('*')->where(['DATE_FORMAT(paymentDate, "%Y-%m-%d")' => date('Y-m-d', strtotime(json_decode($day)))])->orderBy('income_expense', 'desc')->findAll();
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Day View',
            'loggedInfo' => $this->loggedInfo,
            'details' => $details
        ];
        return view('common/top', $data)
            . view('dashboard/details')
            . view('common/bottom');
    }
}
