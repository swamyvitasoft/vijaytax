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
        $income = $this->incomeModel->select('sum(tAmount) as tAmount,sum(pAmount) as pAmount,sum(dAmount) as dAmount')->first();
        $expense = $this->expenseModel->select('sum(pAmount) as pAmount')->first();

        $date = date('d-m-Y');
        $today = $this->incomeModel->select('sum(tAmount) as tAmount,sum(pAmount) as pAmount,sum(dAmount) as dAmount')->where(['DATE_FORMAT(createDate, "%Y-%m-%d")' => date('Y-m-d', strtotime($date))])->first();
        $month = $this->incomeModel->select('sum(tAmount) as tAmount,sum(pAmount) as pAmount,sum(dAmount) as dAmount')->where(['DATE_FORMAT(createDate, "%Y-%m")' => date('Y-m', strtotime($date))])->first();
        $year = $this->incomeModel->select('sum(tAmount) as tAmount,sum(pAmount) as pAmount,sum(dAmount) as dAmount')->where(['DATE_FORMAT(createDate, "%Y")' => date('Y', strtotime($date))])->first();

        $today_expense = $this->expenseModel->select('sum(pAmount) as pAmount')->where(['DATE_FORMAT(createDate, "%Y-%m-%d")' => date('Y-m-d', strtotime($date))])->first();
        $month_expense = $this->expenseModel->select('sum(pAmount) as pAmount')->where(['DATE_FORMAT(createDate, "%Y-%m")' => date('Y-m', strtotime($date))])->first();
        $year_expense = $this->expenseModel->select('sum(pAmount) as pAmount')->where(['DATE_FORMAT(createDate, "%Y")' => date('Y', strtotime($date))])->first();

        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Dashboard',
            'loggedInfo' => $this->loggedInfo,
            'income'  => $income,
            'expense'  => $expense,
            'today_tAmount' => $today['tAmount'],
            'today_pAmount' => $today['pAmount'],
            'today_dAmount' => $today['dAmount'],
            'today_expense' => $today_expense['pAmount'],

            'month_tAmount' => $month['tAmount'],
            'month_pAmount' => $month['pAmount'],
            'month_dAmount' => $month['dAmount'],
            'month_expense' => $month_expense['pAmount'],

            'year_tAmount' => $year['tAmount'],
            'year_pAmount' => $year['pAmount'],
            'year_dAmount' => $year['dAmount'],
            'year_expense' => $year_expense['pAmount'],
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
        if (!empty($this->request->getPost("today"))) {
            $today = $this->request->getPost("today");
        } else {
            $today = date('d-m-Y');
        }
        $todayInfo = $this->incomeModel->where(['DATE_FORMAT(createDate, "%Y-%m-%d")' => date('Y-m-d', strtotime($today))])->findAll();
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Today',
            'loggedInfo' => $this->loggedInfo,
            'todayInfo'    => $todayInfo
        ];
        return view('common/top', $data)
            . view('dashboard/today')
            . view('common/bottom');
    }
    public function month()
    {
        if (!empty($this->request->getPost("month"))) {
            $month = $this->request->getPost("month");
        } else {
            $month = date('m-Y');
        }
        $monthInfo = $this->incomeModel->where(['DATE_FORMAT(createDate, "%Y-%m")' => date('Y-m', strtotime($month))])->findAll();
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Month',
            'loggedInfo' => $this->loggedInfo,
            'monthInfo'    => $monthInfo
        ];
        return view('common/top', $data)
            . view('dashboard/month')
            . view('common/bottom');
    }
    public function year()
    {
        if (!empty($this->request->getPost("year"))) {
            $year = $this->request->getPost("year");
        } else {
            $year = date('Y');
        }
        $yearInfo = $this->incomeModel->where(['DATE_FORMAT(createDate, "%Y")' => date('Y', strtotime($year))])->findAll();
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Year',
            'loggedInfo' => $this->loggedInfo,
            'yearInfo' => $yearInfo
        ];
        return view('common/top', $data)
            . view('dashboard/year')
            . view('common/bottom');
    }

    public function yearView()
    {
        if ($this->request->getPost("year") == "All") {
            $yearIncome = $this->incomeModel->select('sum(tAmount) as tAmount,sum(pAmount) as pAmount,sum(dAmount) as dAmount,createDate')->groupBy('DATE_FORMAT(createDate, "%Y")')->orderBy('createDate', 'desc')->findAll();
            $yearExpense = $this->expenseModel->select('sum(pAmount) as pAmount,createDate')->groupBy('DATE_FORMAT(createDate, "%Y")')->orderBy('createDate', 'desc')->findAll();
        }
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Year View',
            'loggedInfo' => $this->loggedInfo,
            'yearIncome' => $yearIncome,
            'yearExpense' => $yearExpense
        ];
        return view('common/top', $data)
            . view('dashboard/yearView')
            . view('common/bottom');
    }

    public function monthView()
    {
        if ($this->request->getPost("month") == "All") {
            $monthIncome = $this->incomeModel->select('sum(tAmount) as tAmount,sum(pAmount) as pAmount,sum(dAmount) as dAmount,createDate')->groupBy('DATE_FORMAT(createDate, "%Y-%m")')->orderBy('createDate', 'desc')->findAll();
            $monthExpense = $this->expenseModel->select('sum(pAmount) as pAmount,createDate')->groupBy('DATE_FORMAT(createDate, "%Y-%m")')->orderBy('createDate', 'desc')->findAll();
        }
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Month View',
            'loggedInfo' => $this->loggedInfo,
            'monthIncome' => $monthIncome,
            'monthExpense' => $monthExpense
        ];
        return view('common/top', $data)
            . view('dashboard/monthView')
            . view('common/bottom');
    }

    public function dayView()
    {
        if ($this->request->getPost("day") == "All") {
            $dayIncome = $this->incomeModel->select('sum(tAmount) as tAmount,sum(pAmount) as pAmount,sum(dAmount) as dAmount,createDate')->groupBy('DATE_FORMAT(createDate, "%Y-%m-%d")')->orderBy('createDate', 'desc')->findAll();
            $dayExpense = $this->expenseModel->select('sum(pAmount) as pAmount,createDate')->groupBy('DATE_FORMAT(createDate, "%Y-%m-%d")')->orderBy('createDate', 'desc')->findAll();
        }
        $data = [
            'pageTitle' => 'Vijay | Dashboard',
            'pageHeading' => 'Day View',
            'loggedInfo' => $this->loggedInfo,
            'dayIncome' => $dayIncome,
            'dayExpense' => $dayExpense
        ];
        return view('common/top', $data)
            . view('dashboard/dayView')
            . view('common/bottom');
    }
}
