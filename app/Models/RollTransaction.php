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

    /**
     * * Mengembalikan data transaksi berdasarkan id invoice
     * * InvoiceService::getDataEdit()
     * * InvoiceService::printInvoice()
     * * InvoiceService::getInvoiceById()
     * * RollTransactionService::getTrasactionByInvoiceId()
     */
    function getRollTransactionByInvoiceId($id)
    {
        return $this->builder($this->table)
            ->select('roll_transactions.*, customers.customer_name, users.fullname, rolls.roll_code, rolls.roll_quantity, rolls.all_quantity,rolls.roll_name,rolls.unit_quantity,rolls.basic_price,rolls.selling_price, invoices.invoice_code, units.unit_name')
            ->where([
                'roll_transactions.is_deleted' => 0,
                'roll_transactions.invoice_id' => $id
            ])
            ->join('rolls', 'rolls.roll_id = roll_transactions.roll_id')
            ->join('units', 'units.unit_id = rolls.unit_id')
            ->join('invoices', 'invoices.invoice_id = roll_transactions.invoice_id')
            ->join('users', 'users.user_id = invoices.user_id')
            ->join('customers', 'customers.customer_id = invoices.customer_id', "left")
            ->get()
            ->getResultArray();
    }






    /**
     * * Untuk mengambil data transaksi
     * * RollTransactionService:getShowData()
     * * RollTransactionService::getDataTransactionMonthly()
     */
    function getAllRollTransactions($month = null, $year = null, $transactionType = null)
    {
        if ($month == null || $year == null) {
            $month = getMonthNow();
            $year = getYearNow();
        }

        // $this->builder($this->table)
        $query = $this->builder($this->table);
        if ($transactionType == 'in') {
            $query->select('roll_transactions.*,  rolls.roll_code, rolls.roll_name, rolls.basic_price, units.unit_name')
                ->where([
                    'roll_transactions.is_deleted' => 0,
                    'roll_transactions.transaction_type' => 0,
                    'MONTH(roll_transactions.transaction_date)' => $month,
                    'YEAR(roll_transactions.transaction_date)' => $year
                ])
                ->where('roll_transactions.invoice_id IS NULL', null, FALSE)
                ->orderBy("roll_transactions.transaction_id", "DESC")
                ->join('rolls', 'rolls.roll_id = roll_transactions.roll_id')
                ->join('units', 'units.unit_id = rolls.unit_id');
        } else {
            $query->select('roll_transactions.*, customers.customer_name, users.fullname, rolls.roll_code,rolls.roll_name,rolls.roll_name, rolls.basic_price, invoices.invoice_code, units.unit_name')
                ->where([
                    'roll_transactions.is_deleted' => 0,
                    'roll_transactions.transaction_type' => 1,
                    'MONTH(roll_transactions.transaction_date)' => $month,
                    'YEAR(roll_transactions.transaction_date)' => $year,
                ])
                ->orderBy("roll_transactions.transaction_id", "DESC")
                ->join('rolls', 'rolls.roll_id = roll_transactions.roll_id')
                ->join('units', 'units.unit_id = rolls.unit_id')
                ->join('invoices', 'invoices.invoice_id = roll_transactions.invoice_id')
                ->join('users', 'users.user_id = invoices.user_id')
                ->join('customers', 'customers.customer_id = invoices.customer_id', "left");;
        }

        return  $query->get()
            ->getResultArray();
    }

    /**
     * * RollService:getIndexData()
     */
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

    public function getFinanceByRollId($id)
    {
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT rolls.roll_name, SUM(transaction_quantity) as quantity,SUM(sub_profit) as profit, SUM(sub_capital) as capital
        FROM roll_transactions INNER JOIN rolls ON rolls.roll_id = roll_transactions.roll_id
        WHERE roll_transactions.roll_id =$id AND roll_transactions.transaction_type = 1");
        $result = $query->getResultArray();
        return $result;
    }

    /**
     * * InvoiceService::getInvoiceForReport
     */
    public function getTransactionsRange($lowerLimit, $upperLimit, $invoiceId = null)
    {
        $lowerLimit = explode("/", $lowerLimit);
        $upperLimit = explode("/", $upperLimit);
        $newLowerLimit = $lowerLimit[2] . "-" . $lowerLimit[0] . "-" . $lowerLimit[1] . " 00.00.00";
        $newUpperLimit = $upperLimit[2] . "-" . $upperLimit[0] . "-" . $upperLimit[1] . " 00.00.00";

        $db      = db_connect();
        if ($invoiceId == null) {
            $query = $db->query("SELECT * FROM roll_transactions 
            INNER JOIN rolls ON rolls.roll_id = roll_transactions.roll_id 
            INNER JOIN units ON units.unit_id = rolls.unit_id
            WHERE roll_transactions.transaction_type = 1 AND roll_transactions.transaction_date BETWEEN '$newLowerLimit' AND '$newUpperLimit'");
        } else {
            $query = $db->query("SELECT * FROM roll_transactions 
            INNER JOIN rolls ON rolls.roll_id = roll_transactions.roll_id 
            INNER JOIN units ON units.unit_id = rolls.unit_id
            WHERE roll_transactions.transaction_type = 1 AND roll_transactions.invoice_id = $invoiceId AND roll_transactions.transaction_date BETWEEN '$newLowerLimit' AND '$newUpperLimit'");
        }
        return $query->getResultArray();
    }
}
