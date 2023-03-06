<?php
    header('Content-Type: application/json');
    require __DIR__ . "/inc/bootstrap.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET["type"] == 'submitData') {
        //when submitData is called, save the data, get the new data and return as json
        $data = json_decode(file_get_contents('php://input'), true);
        require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
        $api = new UserController();
        $submitNewCompany = $api->submitNewCompany($data);
        $response = json_encode($submitNewCompany);
        echo ($response);

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET["type"] == 'submitInvoice') {
        //when submitInvoice is called, save the invoice, get the mew data and return as json
        $data = json_decode(file_get_contents('php://input'), true);
        require PROJECT_ROOT_PATH . "/Controller/Api/InvoiceController.php";
        $api = new InvoiceController();
        $submitNewInvoice = $api->submitNewInvoice($data);
        $response = json_encode($submitNewInvoice);
        echo ($response);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET["type"] == 'getData') {
        //when getData is called, get the invoice data and return as json
        require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
        $api = new UserController();
        if ($_GET['customer_id']) {
            $customer_id = $_GET['customer_id'];
        } else {
            $customer_id = 1;
        }
        $getInvoiceData = $api->getInvoiceData($customer_id);
        $response = json_encode($getInvoiceData);
        echo ($response);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET["type"] == 'getCompanies') {
        //when getCompanies is called, get all companies and return as json
        require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
        $api = new UserController();
        $customer_id = ($_GET['id'] ?? 1);
        $getAllCompanies = $api->getAllCompanies();
        header('Content-Type: application/json');
        $response = json_encode($getAllCompanies);	
        echo ($response);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET["type"] == 'getInvoiceConfig') {
        //when getInvoiceConfig is called, get the invoice configuration and return as json        
        require PROJECT_ROOT_PATH . "/Controller/Api/InvoiceController.php";
        $api = new InvoiceController();
        $geInvoiceConfig = $api->getInvoiceConfig();
        $response = json_encode($geInvoiceConfig);
        echo ($response);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET["type"] == 'getLaborConfig') {
        //when getLaborConfig is called, get the labor configuration and return as json
        require PROJECT_ROOT_PATH . "/Controller/Api/InvoiceController.php";
        $api = new InvoiceController();
        $getLaborConfig = $api->getLaborConfig();
        $response = json_encode($getLaborConfig);
        echo ($response);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET["type"] == 'getPreconfiguredInvoiceItems') {
        //when getPreconfiguredInvoiceItems is called, get the preconfigured invoice items and return as json
        require PROJECT_ROOT_PATH . "/Controller/Api/InvoiceController.php";
        $api = new InvoiceController();
        $getPreconfiguredInvoiceItems = $api->getPreconfiguredInvoiceItems();
        $response = json_encode($getPreconfiguredInvoiceItems); 
        echo ($response);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET["type"] == 'getSelectedInvoiceItem') {
        //when getSelectedInvoiceItem is called, get the selected invoice item and return as json
        require PROJECT_ROOT_PATH . "/Controller/Api/InvoiceController.php";
        $api = new InvoiceController();
        $invoice_item_id = $_GET['invoice_item_id'];
        $getSelectedInvoiceItem = $api->getSelectedInvoiceItem($invoice_item_id);
        $response = json_encode($getSelectedInvoiceItem); 
        echo ($response);
    } else {
        $response = ['status' => 'error'];
        echo json_encode($response);
    }

    
?>