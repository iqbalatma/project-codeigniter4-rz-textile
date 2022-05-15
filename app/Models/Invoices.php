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


    public function getSumTransactionByCustomerId()
    {
        $query = db_connect()->query("SELECT customer_id, SUM(total_payment) as total_payment FROM invoices GROUP BY invoices.customer_id;");
        return $query->getResultArray();
    }


    /**
     * !USED IN DASHBOARD CONTROLLER
     */
    public function getInvoicesToday()
    {
        $builder = $this->db->table($this->table);
        $builder->select('invoices.*, customers.customer_name, users.fullname');
        $builder->where('invoices.is_deleted', 0);
        $builder->where('DATE(invoices.date_invoice)', getDateNow());
        $builder->orderBy("invoice_code", "DESC");
        $builder->join('users', 'users.user_id = invoices.user_id');
        $builder->join('customers', 'customers.customer_id = invoices.customer_id', "left");
        $query = $builder->get();
        return $query->getResultArray();
    }


    public function getInvoices($id = null, $month = null, $year = null, $limit = null)
    {
        if ($month == null || $year == null) {
            $month = getMonthNow();
            $year = getYearNow();
        }
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('invoices.*, customers.customer_name, users.fullname');
        $builder->where('MONTH(invoices.date_invoice)', $month);
        $builder->where('YEAR(invoices.date_invoice)', $year);
        $builder->where('invoices.is_deleted', 0);
        if ($id) {
            $builder->where('invoices.invoice_id', $id);
        }
        $builder->limit($limit, 0);
        $builder->orderBy("invoice_id", "DESC");
        $builder->join('users', 'users.user_id = invoices.user_id');
        $builder->join('customers', 'customers.customer_id = invoices.customer_id', "left");
        $query = $builder->get();
        return $query->getResultArray();
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
