<?php

namespace App\Models;

use CodeIgniter\Model;

class RollTransaction extends Model
{
    protected $table      = 'roll_transactions';
    protected $primaryKey = 'transaction_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = false;

    protected $allowedFields = ['transaction_id', 'roll_id', 'transaction_type', 'transaction_quantity', 'transaction_quantity_total', 'sub_capital', 'sub_total', 'sub_profit',   'transaction_date',  'invoice_id', 'is_deleted'];

    function getAllRollTransactions($month = null, $year = null, $transactionType = null)
    {
        if ($month == null || $year == null) {
            $month = getMonthNow();
            $year = getYearNow();
        }


        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        if ($transactionType == "in") {
            $builder->select('roll_transactions.*,  rolls.roll_code, rolls.roll_name, rolls.basic_price, units.unit_name');
            $builder->where('roll_transactions.is_deleted', 0);
            $builder->where('roll_transactions.invoice_id IS NULL', null, FALSE);
            $builder->where('roll_transactions.transaction_type', 0);
            $builder->where('MONTH(roll_transactions.transaction_date)', $month);
            $builder->where('YEAR(roll_transactions.transaction_date)', $year);
            $builder->orderBy("roll_transactions.transaction_id", "DESC");
            $builder->join('rolls', 'rolls.roll_id = roll_transactions.roll_id');
            $builder->join('units', 'units.unit_id = rolls.unit_id');
        } else {
            $builder->select('roll_transactions.*, customers.customer_name, users.fullname, rolls.roll_code,rolls.roll_name,rolls.roll_name, rolls.basic_price, invoices.invoice_code, units.unit_name');
            $builder->where('roll_transactions.is_deleted', 0);
            $builder->where('roll_transactions.transaction_type', 1);
            $builder->where('MONTH(roll_transactions.transaction_date)', $month);
            $builder->where('YEAR(roll_transactions.transaction_date)', $year);
            $builder->orderBy("roll_transactions.transaction_id", "DESC");
            $builder->join('rolls', 'rolls.roll_id = roll_transactions.roll_id');
            $builder->join('units', 'units.unit_id = rolls.unit_id');
            $builder->join('invoices', 'invoices.invoice_id = roll_transactions.invoice_id');
            $builder->join('users', 'users.user_id = invoices.user_id');
            $builder->join('customers', 'customers.customer_id = invoices.customer_id', "left");
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    function getRollTransactionById($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('roll_transactions.*, customers.customer_name, users.fullname, rolls.roll_code, rolls.roll_quantity, rolls.all_quantity,rolls.roll_name,rolls.unit_quantity,rolls.basic_price,rolls.selling_price, invoices.invoice_code, units.unit_name');
        $builder->where('roll_transactions.is_deleted', 0);
        $builder->where('roll_transactions.invoice_id', $id);
        $builder->join('rolls', 'rolls.roll_id = roll_transactions.roll_id');
        $builder->join('units', 'units.unit_id = rolls.unit_id');
        $builder->join('invoices', 'invoices.invoice_id = roll_transactions.invoice_id');
        $builder->join('users', 'users.user_id = invoices.user_id');
        $builder->join('customers', 'customers.customer_id = invoices.customer_id', "left");
        $query = $builder->get();
        return $query->getResultArray();
    }
    function getRollTransactionByInvoiceId($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('roll_transactions.*, customers.customer_name, users.fullname, rolls.roll_code, rolls.roll_quantity, rolls.all_quantity,rolls.roll_name,rolls.unit_quantity,rolls.basic_price,rolls.selling_price, invoices.invoice_code, units.unit_name');
        $builder->where('roll_transactions.is_deleted', 0);
        $builder->where('roll_transactions.invoice_id', $id);
        $builder->join('rolls', 'rolls.roll_id = roll_transactions.roll_id');
        $builder->join('units', 'units.unit_id = rolls.unit_id');
        $builder->join('invoices', 'invoices.invoice_id = roll_transactions.invoice_id');
        $builder->join('users', 'users.user_id = invoices.user_id');
        $builder->join('customers', 'customers.customer_id = invoices.customer_id', "left");
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getSummaryFinance($month = null, $year = null)
    {
        if ($month === null || $year === null) {
            $month = getMonthNow();
            $year = getYearNow();
        }
        $db      = \Config\Database::connect();

        $query = $db->query("SELECT rolls.roll_id,rolls.roll_name, SUM(transaction_quantity_total) as quantity_total,SUM(transaction_quantity) as quantity_sold,SUM(sub_profit) as profit, SUM(sub_capital) as capital
        FROM roll_transactions 
        INNER JOIN rolls ON rolls.roll_id = roll_transactions.roll_id
        WHERE  roll_transactions.transaction_type = 1 
        GROUP BY roll_transactions.roll_id");
        $result = $query->getResultArray();
        return $result;
    }
    // public function getSummaryFinanceReport($lowerLimit, $upperLimit)
    // {

    //     $lowerLimit = explode("/", $lowerLimit);
    //     $upperLimit = explode("/", $upperLimit);
    //     $newLowerLimit = $lowerLimit[2] . "-" . $lowerLimit[0] . "-" . $lowerLimit[1] . " 00.00.00";
    //     $newUpperLimit = $upperLimit[2] . "-" . $upperLimit[0] . "-" . $upperLimit[1] . " 00.00.00";

    //     $db      = \Config\Database::connect();
    //     $query = $db->query("SELECT rolls.roll_id,rolls.roll_name, SUM(transaction_quantity_total) as quantity_total,SUM(transaction_quantity) as quantity_sold,SUM(sub_profit) as profit, SUM(sub_capital) as capital
    //     FROM roll_transactions 
    //     INNER JOIN rolls ON rolls.roll_id = roll_transactions.roll_id
    //     WHERE  roll_transactions.transaction_type = 1 
    //     AND roll_transactions.transaction_date BETWEEN
    //     '$newLowerLimit' AND
    //     '$newUpperLimit'
    //     GROUP BY roll_transactions.roll_id");
    //     $result = $query->getResultArray();
    //     return $result;
    // }
    public function getFinanceByRollId($id)
    {
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT rolls.roll_name, SUM(transaction_quantity) as quantity,SUM(sub_profit) as profit, SUM(sub_capital) as capital
        FROM roll_transactions INNER JOIN rolls ON rolls.roll_id = roll_transactions.roll_id
        WHERE roll_transactions.roll_id =$id AND roll_transactions.transaction_type = 1");
        $result = $query->getResultArray();
        return $result;
    }

    public function getTransactionsRange($lowerLimit, $upperLimit, $invoiceId = null)
    {
        $lowerLimit = explode("/", $lowerLimit);
        $upperLimit = explode("/", $upperLimit);
        $newLowerLimit = $lowerLimit[2] . "-" . $lowerLimit[0] . "-" . $lowerLimit[1] . " 00.00.00";
        $newUpperLimit = $upperLimit[2] . "-" . $upperLimit[0] . "-" . $upperLimit[1] . " 00.00.00";

        $db      = \Config\Database::connect();
        if ($invoiceId == null) {
            $query = $db->query("SELECT * FROM roll_transactions 
            INNER JOIN rolls ON rolls.roll_id = roll_transactions.roll_id 
            INNER JOIN units ON units.unit_id = rolls.unit_id
            WHERE roll_transactions.transaction_type = 1 AND roll_transactions.transaction_date BETWEEN '$newLowerLimit' AND '$newUpperLimit'");
            $result = $query->getResultArray();
            return $result;
        } else {
            $query = $db->query("SELECT * FROM roll_transactions 
            INNER JOIN rolls ON rolls.roll_id = roll_transactions.roll_id 
            INNER JOIN units ON units.unit_id = rolls.unit_id
            WHERE roll_transactions.transaction_type = 1 AND roll_transactions.invoice_id = $invoiceId AND roll_transactions.transaction_date BETWEEN '$newLowerLimit' AND '$newUpperLimit'");
            $result = $query->getResultArray();
            return $result;
        }
    }
}
