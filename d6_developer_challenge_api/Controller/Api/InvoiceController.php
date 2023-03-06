<?php
class InvoiceController extends BaseController
{
    public function getInvoiceConfig() {		
        //get the invoice config, store in array
        $invoiceModel = new InvoiceModel();
        $getInvoiceConfig = $invoiceModel->getInvoiceConfig();
        $results = [];

        foreach($getInvoiceConfig as $config){
            $results['config'] = [
                'tax_rate'=>$config['tax_rate'],
                'other_comments'=>$config['other_comments'],
                'contact_name'=>$config['contact_name'], 
                'contact_number'=>$config['contact_number'], 
                'contact_email'=>$config['contact_email'], 
                'due_date_days'=>$config['due_date_days']
            ];
        }

        $responseData = $results;

        header('Content-Type: application/json');
        return $responseData;	
    }

    public function getLaborConfig() {		
        //get the labor config, store in array
        $invoiceModel = new InvoiceModel();
        $getLaborConfig = $invoiceModel->getLaborConfig();
        $results = [];
        //$results[] = $getAllCompanies;

        foreach($getLaborConfig as $configKey => $configValue){
            $results['config'] = [
                $configKey=>$configValue
            ];
        }

        $responseData = $results;

        header('Content-Type: application/json');
        return $responseData;	
    }

    public function getPreconfiguredInvoiceItems() {	
        //get the preconfigured invoice items, store in array	
        $invoiceModel = new InvoiceModel();
        $getPreconfiguredInvoiceItems = $invoiceModel->getPreconfiguredInvoiceItems();
        $results = [];
        

        foreach($getPreconfiguredInvoiceItems as $configKey => $configValue){
            $results[] = $configValue;
        }

        $responseData = $results;

        header('Content-Type: application/json');
        return $responseData;	
    }

    public function getSelectedInvoiceItem($invoice_item_id) {	
        //get the selected invoice item, store in array	
        $invoiceModel = new InvoiceModel();
        $getAllInvoiceItems = $invoiceModel->getSelectedInvoiceItem($invoice_item_id);
        $results = [];

        foreach($getAllInvoiceItems as $configKey => $configValue){
            $results['config'] = [
                $configKey=>$configValue
            ];
        }

        $responseData = $results;

        header('Content-Type: application/json');
        return $responseData;	
    }
    

    public function submitNewInvoice($data) {	
        //save the invoice	
        $invoiceModel = new InvoiceModel();
        $submitNewCompany = $invoiceModel->submitNewInvoice($data);
    
        header('Content-Type: application/json');
        return ($submitNewCompany);	
    }
}
?>