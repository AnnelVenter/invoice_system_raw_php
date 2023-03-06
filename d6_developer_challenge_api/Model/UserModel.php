<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class UserModel extends Database
{
    public function getCompanyData($company_id) {
        // get selected company data
        return $this->select("SELECT id, name, company_name, email, street_address, city, postal_code, phone_number, fax, website FROM customers WHERE id = '".$company_id."' ORDER BY id DESC");
    }

    public function getAllCompanies() {
        // get all company data to display in dropdown
        return $this->select("SELECT id, company_name FROM customers WHERE active = '1' ORDER BY company_name ASC");
    }

    public function getLastCompanyId() {
        // get company id of last inserted id
        return $this->select("SELECT MAX(id) as last_company_id FROM customers");
    }

    public function submitNewCompany($data) {
        //save the new company if one was created
        return $this->insert("INSERT INTO customers SET name='".$data['name']."', company_name='".$data['company_name']."', email='".$data['email']."', street_address='".$data['street_address']."', city='".$data['city']."', postal_code='".$data['postal_code']."', phone_number='".$data['phone_number']."', fax='".$data['fax']."', website='".$data['website']."'");
    }
}
?>