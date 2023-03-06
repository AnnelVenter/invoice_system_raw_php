<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class InvoiceModel extends Database
{
    public function getLastInvoiceId() {
        //get invoice id of last inserted id
        return $this->select("SELECT MAX(id) as last_invoice_id FROM invoices");
    }

    public function getInvoiceConfig() {
        //get the config of the invoice
        return $this->select("SELECT tax_rate, other_comments, contact_name, contact_number, contact_email, due_date_days 
        FROM invoice_config ORDER BY id DESC LIMIT 1");
    }

    public function getLaborConfig() {
        //get the config of the labor for when we want to update the labor values
        return $this->select("SELECT id, product, price, quantity, taxable FROM invoice_preconfigured WHERE product = 'Labor' ORDER BY id DESC LIMIT 1");
    }

    public function getPreconfiguredInvoiceItems() {
        //get the preconfigured invoice items
        return $this->select("SELECT id, product, price, quantity, taxable FROM invoice_preconfigured ORDER BY product ASC");
    }

    public function getSelectedInvoiceItem($invoice_item_id) {
        //get the selected invoice item
        return $this->select("SELECT id, product, price, quantity, taxable FROM invoice_preconfigured WHERE id = '" . $invoice_item_id . "' LIMIT 1");
    }

    public function submitNewInvoice($data) {
        //save the new invoice

        $invoice_date_data =  $data['invoice_date'];
        $invoice_date = date('Y-m-d', strtotime($invoice_date_data)); 
        
        $due_date_data =  $data['due_date'];
        $due_date = date('Y-m-d', strtotime($due_date_data)); 
        
        $created_at_data =  $data['created_at'];
        $created_at = date('Y-m-d H:i:s', strtotime($created_at_data)); 

        //customer_id, invoice_date, taxable, tax_rate, tax_due, total, created_at_, due_date, active
        return $this->insert("INSERT INTO invoices SET customer_id='".$data['customer_id']."', invoice_date='".$invoice_date."', 
        taxable='".$data['taxable']."', tax_rate='".$data['tax_rate']."', tax_due='".$data['tax_due']."', total='".$data['total']."', 
        created_at='".$created_at."', due_date='".$due_date."', active='".$data['active']."'");
    }
}
?>