<?php

namespace App\Models;

use CodeIgniter\Model;

class Invoices extends Model
{
    protected $table      = 'invoices';
    protected $primaryKey = 'invoice_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['invoice_id', 'invoice_code', 'total_capital', 'total_payment', 'total_profit', 'type_payment', 'customer_id', 'user_id', 'date_invoice', 'is_deleted', "is_paid"];

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();

        $this->rollTransactionModel = new \App\Models\RollTransaction();
        $this->rollModel = new \App\Models\Rolls();
    }


    /**
     * * Mengambil data total transaksi di invoice berdasarkan customer
     * * CustomerService::getDataIndex()
     */
    public function getSumTransactionByCustomer()
    {
        return  $this->builder($this->table)
            ->select('customer_id')
            ->selectSum('total_payment', 'total_payment')
            ->groupBy('customer_id')
            ->get()->getResultArray();
    }


    /**
     * * Mengambil semua data invoice hari ini
     * * DashboardService::getDataIndex()
     */
    public function getInvoicesToday()
    {
        return $this->builder($this->table)
            ->select('invoices.invoice_code,invoices.total_payment, invoices.total_profit,invoices.date_invoice,customers.customer_name, users.fullname')
            ->where(['invoices.is_deleted' => 0, 'DATE(invoices.date_invoice)' => getDateNow()])
            ->join('users', 'users.user_id = invoices.user_id')
            ->join('customers', 'customers.customer_id = invoices.customer_id', "left")
            ->orderBy('invoice_code', 'DESC')
            ->get()
            ->getResultArray();
    }


    /**
     * * Mengambil data invoice dengan 2 opsi, semuanya atau by id
     * * InvoiceService::getDataIndex() 
     * * InvoiceService::getDataEdit() 
     * * InvoiceService::printInvoice() 
     */
    public function getInvoices($id = null, $month = null, $year = null, $limit = null)
    {
        if ($month == null || $year == null) {
            $month = getMonthNow();
            $year = getYearNow();
        }


        $whereCondition = [
            'MONTH(invoices.date_invoice)' => $month,
            'YEAR(invoices.date_invoice)' => $year,
            'invoices.is_deleted' => 0
        ];

        if ($id) $whereCondition['invoices.invoice_id'] = $id;

        return   $this->builder($this->table)
            ->select('invoices.*, customers.customer_name, users.fullname')
            ->where([
                'MONTH(invoices.date_invoice)' => $month,
                'YEAR(invoices.date_invoice)' => $year,
                'invoices.is_deleted' => 0
            ])
            ->limit($limit, 0)
            ->orderBy("invoice_id", "DESC")
            ->join('users', 'users.user_id = invoices.user_id')
            ->join('customers', 'customers.customer_id = invoices.customer_id', "left")
            ->get()
            ->getResultArray();
    }






    public function getLastInvoiceCode()
    {
        $builder = $this->db->table($this->table);
        return $builder->select("invoice_code")
            ->where(['is_deleted' => 0, 'MONTH(date_invoice)' => getMonthNow(), 'YEAR(date_invoice)' =>  getYearNow()])
            ->orderBy("invoice_id", "DESC")
            ->limit(1)
            ->get()
            ->getRowObject();
    }








    public function getFinanceInvoice($type = "yearly", $month = null, $year = null)
    {
        $whereClause = "";
        if ($year == null) {
            $year = getYearNow();
        }
        if ($month == null) {
            $month = getMonthNow();
        }
        if ($type == "yearly") {
            $whereClause .= "WHERE YEAR(date_invoice) = $year";
        } elseif ($type == "monthly") {
            $whereClause .= "WHERE YEAR(date_invoice) = $year AND MONTH(date_invoice) = $month";
        }
        $db = db_connect();
        $query = $db->query("SELECT YEAR(date_invoice) AS year,MONTH(date_invoice) AS month,SUM(total_payment) AS total_payment, SUM(total_profit) AS total_profit, SUM(total_capital) AS total_capital
        FROM invoices 
        $whereClause
        GROUP BY YEAR(date_invoice),MONTH(date_invoice) ORDER BY YEAR(date_invoice),MONTH(date_invoice)");
        return $query->getResultArray();
    }




    public function getLastInvoice()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('invoices.*, customers.customer_name, users.fullname');
        $builder->where('invoices.is_deleted', 0);
        $builder->limit(1);
        $builder->orderBy("invoices.invoice_id", "desc");
        $builder->join('users', 'users.user_id = invoices.user_id');
        $builder->join('customers', 'customers.customer_id = invoices.customer_id', "left");
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getInvoicesRange($lowerLimit, $upperLimit)
    {
        $lowerLimit = explode("/", $lowerLimit);
        $upperLimit = explode("/", $upperLimit);
        $newLowerLimit = $lowerLimit[2] . "-" . $lowerLimit[0] . "-" . $lowerLimit[1] . " 00.00.00";
        $newUpperLimit = $upperLimit[2] . "-" . $upperLimit[0] . "-" . $upperLimit[1] . " 00.00.00";

        $db      = \Config\Database::connect();
        $query = $db->query("SELECT * FROM invoices LEFT JOIN customers ON customers.customer_id = invoices.customer_id WHERE invoices.date_invoice BETWEEN '$newLowerLimit' AND '$newUpperLimit'");
        $result = $query->getResultArray();
        return $result;
    }
    public function getInvoicesRangePaid($lowerLimit, $upperLimit)
    {
        $lowerLimit = explode("/", $lowerLimit);
        $upperLimit = explode("/", $upperLimit);
        $newLowerLimit = $lowerLimit[2] . "-" . $lowerLimit[0] . "-" . $lowerLimit[1] . " 00.00.00";
        $newUpperLimit = $upperLimit[2] . "-" . $upperLimit[0] . "-" . $upperLimit[1] . " 00.00.00";

        $db      = \Config\Database::connect();
        $query = $db->query("SELECT * FROM invoices LEFT JOIN customers ON customers.customer_id = invoices.customer_id WHERE invoices.is_paid = 1 AND invoices.date_invoice BETWEEN '$newLowerLimit' AND '$newUpperLimit'");
        $result = $query->getResultArray();
        return $result;
    }
}
