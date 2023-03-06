<?php
class UserController extends BaseController
{
    public function getInvoiceData($customer_id) {	
        //get invoice data, store in array
        $userModel = new UserModel();
        $invoiceModel = new InvoiceModel();
        $getCustomer = $userModel->getCompanyData($customer_id);
        $getLastInvoiceId = $invoiceModel->getLastInvoiceId();
        $getLastCompanyId = $userModel->getLastCompanyId();

        $results = [];
        foreach($getCustomer as $customer){
            $results['customer'] = [
                'id'=>$customer['id'], 
                'name'=>$customer['name'], 
                'company_name'=>$customer['company_name'], 
                'street_address'=>$customer['street_address'], 
                'city'=>$customer['city'],
                'postal_code'=>$customer['postal_code'], 
                'phone_number'=>$customer['phone_number'], 
                'fax'=>$customer['fax'], 
                'website'=>$customer['website']
            ];
        }
        $results['getLastInvoiceId'] = $getLastInvoiceId;
        $results['getLastCompanyId'] = $getLastCompanyId;

        header('Content-Type: application/json');
        return $results;	
    }

    public function getAllCompanies() {	
        //get all companies, store in array	
        $userModel = new UserModel();
        $getAllCompanies = $userModel->getAllCompanies();
        $results = [];

        foreach($getAllCompanies as $companyKey => $companyValue){
            $results[$companyKey] = $companyValue;
        }

        header('Content-Type: application/json');
        return $results;	
    }

    public function submitNewCompany($data) {	
        //save new company	
        $userModel = new UserModel();
        $submitNewCompany = $userModel->submitNewCompany($data);
        
        $getLastCompanyId = $userModel->getLastCompanyId();
        header('Content-Type: application/json');
        return ($getLastCompanyId);	
    }
}
?>