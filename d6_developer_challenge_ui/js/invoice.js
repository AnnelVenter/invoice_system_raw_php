document.addEventListener("DOMContentLoaded", function() {
    // get companies, invoice configurations and preconfigured invoice items on load
    getCompanies();
    getSelectedCompanyDetails();
    getInvoiceConfig();
    getPreconfiguredInvoiceItems();
});

function allCompanies() {
    // show all companies dropdown
    document.getElementById("companiesDropdown").classList.toggle("show");
}

function getCompanies() {
    // get the list of all the companies
    fetch('http://localhost/d6_developer_challenge_api/api.php?type=getCompanies', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        var companies = data;
        companiesDropdown = document.getElementById("companiesDropdown");

        companies.forEach((item, index)=>{
            option = document.createElement('option');
            option.text = item.company_name;
            option.value = item.id;
            companiesDropdown.appendChild(option);    
        })
    })
    .catch(error => {
        throw new Error('Unable to get all companies.');
    });
}

function getSelectedCompany(selectObject) {
    // get the selected company and display data in invoice unless 'new' is selected, then show the form
    var value = 0;

    if (isNaN(selectObject)) {
        value = selectObject.value;  
    } else {
        value = selectObject;  
    }

    if (value > 0) {
        document.getElementById("get_selected_company_details").classList.add("hidden");
        getSelectedCompanyDetails(value);
    } else if (value == 0) {
        document.getElementById("get_selected_company_details").classList.remove("hidden");
    } else {
        document.getElementById("get_selected_company_details").classList.add("hidden");
    }
}

function submitData(event) {
    //submit the new company information and display in invoice
    event.preventDefault();
    const company_name = document.getElementById('company_name_input').value;
    const name = document.getElementById('name_input').value;
    const email = document.getElementById('email_input').value;
    const street_address = document.getElementById('street_address_input').value;
    const city = document.getElementById('city_input').value;
    const postal_code = document.getElementById('postal_code_input').value;
    const phone_number = document.getElementById('phone_number_input').value;
    const fax = document.getElementById('fax_input').value;
    const website = document.getElementById('website_input').value;

    fetch('http://localhost/d6_developer_challenge_api/api.php?type=submitData', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ company_name, name, email, street_address, city, postal_code, phone_number, fax, website}),
    })
    .then(response => response.json())
    .then(data => {
        getSelectedCompany(data[0]['last_company_id']);
    })
    .catch(error => {
        throw new Error('Unable to save new company.');
    });
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
        }
    }
}

function getSelectedCompanyDetails(value = 1) {
    // get the details of the selected company
    customer_id = value;
    fetch('http://localhost/d6_developer_challenge_api/api.php?type=getData&customer_id='+customer_id, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        customer = data['customer'];
        last_invoice_id = data['getLastInvoiceId'][0]['last_invoice_id'];
        last_company_id = data['getLastCompanyId'][0]['last_company_id'];
        Object.entries(customer).forEach(eachCustomer => {
            itemClass = document.getElementsByClassName(eachCustomer[0]);
            [].slice.call(itemClass).forEach(function (eachItem) {
                eachItem.innerHTML = eachCustomer[1];
            });
        });
        
        if (last_invoice_id == null) {
            new_invoice_id = 1;
        } else {
            new_invoice_id = parseInt(last_invoice_id) + 1
        }
        document.getElementById('invoice_number').innerHTML = new_invoice_id;

        if (customer['id'] == null) {
            if (last_company_id == null) {
                new_customer_id = 1;
            } else {
                new_customer_id = parseInt(last_company_id) + 1
            }
            document.getElementById('id').innerHTML = new_customer_id;
        }

        
        document.getElementById("save_invoice").onclick=function(){saveInvoice()};
        document.getElementById("save_invoice").classList.remove("cursor-disabled");
        document.getElementById("save_invoice").classList.add("cursor-pointer");
        
        
    })
    .catch(error => {
        throw new Error('Unable to get selected company.');
    });
}

function allPreconfiguredInvoiceData(preconfiguredInvoiceDataId = 1) {
    // show all invoice items in dropdown
    document.getElementById("invoiceItemsDropdown_" + preconfiguredInvoiceDataId).classList.toggle("show");
}

function getPreconfiguredInvoiceItems(preconfiguredInvoiceDataId = 1) {
    // show all preconfigured invoice items in dropdown
    fetch('http://localhost/d6_developer_challenge_api/api.php?type=getPreconfiguredInvoiceItems', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        var invoiceItems = data;

        if (preconfiguredInvoiceDataId > 1) {
            var table = document.getElementById("invoiceItemsTable");
            var row = table.insertRow(preconfiguredInvoiceDataId);
            var dropdownTd = row.insertCell(0);
            dropdownTd.id = 'preconfiguredInvoiceData_ ' + preconfiguredInvoiceDataId;
            dropdownTd.innerHTML = '<td>' +
                                        '<div class="invoiceItems w-50">' +
                                            '<select id="invoiceItemsDropdown_' + preconfiguredInvoiceDataId + '" onclick="allPreconfiguredInvoiceData(' + preconfiguredInvoiceDataId + ')" onchange="getSelectedInvoiceItem(this, ' + preconfiguredInvoiceDataId + ')" class="dropdown-content w-full">' +
                                                '<option value="-1">Please select a service</option>' +
                                            '</select>' +
                                        '</div>' +
                                    '</td>';
            

            var quantity = row.insertCell(1);
            quantity.id = 'quantity_' + preconfiguredInvoiceDataId;
            quantity.className = 'text-center';            

            var taxable = row.insertCell(2);
            taxable.id = 'taxable_' + preconfiguredInvoiceDataId;
            taxable.className = 'text-center';
            taxable.innerHTML = '<td></td>';

            var fee = row.insertCell(3);
            fee.id = 'fee_' + preconfiguredInvoiceDataId;
            fee.className = 'text-right';
            fee.innerHTML = '<td></td>';
        }

        invoiceItemsDropdown = document.getElementById("invoiceItemsDropdown_" + preconfiguredInvoiceDataId);

        invoiceItems.forEach((item, index)=>{
            option = document.createElement('option');
            option.text = item.product;
            option.value = item.id + '_' + preconfiguredInvoiceDataId;
            invoiceItemsDropdown.appendChild(option);    
        })
          
        
    })
    .catch(error => {
        throw new Error('Unable to get preconfigured invoice data.');
    });
}

function getSelectedInvoiceItem(selectedItem, preconfiguredInvoiceDataId = 1) {
    // get a selected invoice item
    var value = 0;
    
    if (isNaN(selectedItem)) {
        value = selectedItem.value;  
    } else {
        value = selectedItem;  
    }
    
    newValue = parseInt(value.slice(0, -2));


    if (newValue > 0) {
        fetch('http://localhost/d6_developer_challenge_api/api.php?type=getSelectedInvoiceItem&invoice_item_id='+newValue, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            var invoiceItems = data['config'];

            if (invoiceItems[0]['product'] == "Labor") {
                document.getElementById('quantity_' + preconfiguredInvoiceDataId).innerHTML = '<input type="number" id="labor_hours" name="labor_hours" min="1" max="5000" value="' + invoiceItems[0]['quantity'] + '" onchange="updateLaborValue(this, ' + preconfiguredInvoiceDataId + ')"><input type="hidden" id="labor_hours_base" value="' + invoiceItems[0]['price'] + '">' 
            } else {
                document.getElementById('quantity_' + preconfiguredInvoiceDataId).innerHTML = invoiceItems[0]['quantity'];

            }
            
            taxable = '';
            if (invoiceItems[0]['taxable'] == 1) {
                taxable = 'x';
            }
            document.getElementById('taxable_' + preconfiguredInvoiceDataId).innerHTML = taxable;
            document.getElementById('fee_' + preconfiguredInvoiceDataId).innerHTML = invoiceItems[0]['price'];                
        })
        .catch(error => {
            throw new Error('Unable to get selected invoice item.');
        });
        
    } else if (newValue == 0) {
        var input = document.createElement("input");
        input.type = "number";
        input.name = "quantity";
        document.getElementById("quantity").appendChild(input);

        const taxable = document.getElementById("taxable");

        var input = document.createElement("input");
        const radioBtn = {
            "Yes": false,
            "No": false
        }

        for (let radio in radioBtn) {
            let label = document.createElement("label");

            let input = document.createElement("input");
            input.type = "radio";
            taxable.appendChild(input);

            label.innerText = radio;
            taxable.appendChild(label);
        }

        var input = document.createElement("input");
        input.type = "float";
        input.name = "fee";
        document.getElementById("fee").appendChild(input);
    }
}

function getInvoiceConfig() {
    // get invoice configuration
    fetch('http://localhost/d6_developer_challenge_api/api.php?type=getInvoiceConfig', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        var config = data['config'];

        const today = new Date();
        const yyyy = today.getFullYear();
        let mm = today.getMonth() + 1;
        let dd = today.getDate();

        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;

        const formattedToday = mm + '/' + dd + '/' + yyyy;

        document.getElementById('invoice_date').innerHTML = formattedToday;

        var dueDate = today;
        dueDate.setDate(dueDate.getDate() + parseInt(config['due_date_days']));

        const dueYear = today.getFullYear();
        let dueMonth = today.getMonth() + 1;
        let dueDays = today.getDate();

        if (dueDays < 10) dueDays = '0' + dueDays;
        if (dueMonth < 10) dueMonth = '0' + dueMonth;

        const formattedDueDate = dueMonth + '/' + dueDays + '/' + dueYear;

        document.getElementById('due_date').innerHTML = formattedDueDate;

        document.getElementById('other_comments').innerHTML = config['other_comments'];

        
        document.getElementById('contact_name').innerHTML = config['contact_name'];
        document.getElementById('contact_number').innerHTML = config['contact_number'];
        document.getElementById('contact_email').innerHTML = config['contact_email'];

          
        
    })
    .catch(error => {
        throw new Error('Unable to get invoice configurations.');
    });
}

function updateLaborValue(item, preconfiguredInvoiceDataId) {
    // update labor value on quantity change

    fetch('http://localhost/d6_developer_challenge_api/api.php?type=getInvoiceConfig', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        var config = data['config'];

        var labor_hours = 0;

        if (document.getElementById('labor_hours')) {
            labor_hours = document.getElementById('labor_hours').value;
            getBaseLaborFee = document.getElementById('labor_hours_base').value;
            document.getElementById('fee_' + preconfiguredInvoiceDataId).innerHTML = (labor_hours * parseFloat(getBaseLaborFee)).toFixed(2);
        }

        updateTotals(config, labor_hours);
        
    })
    .catch(error => {
        throw new Error('Unable to update labor amount and totals.');
    });
}

function saveInvoice() {
    // save invoice
    const customer_id = document.getElementById('customer_id').innerHTML;
    const invoice_date = document.getElementById('invoice_date').innerHTML;
    const taxable = document.getElementById('taxable_value').innerHTML;
    const tax_rate = document.getElementById('tax_rate_value').innerHTML;
    const tax_due = document.getElementById('tax_due_value').innerHTML;
    const total_value = document.getElementById('total_value').innerHTML;
    const created_at = document.getElementById('invoice_date').innerHTML;
    const due_date = document.getElementById('due_date').innerHTML;
    const active = 1;

    total = total_value.slice(1);

    fetch('http://localhost/d6_developer_challenge_api/api.php?type=submitInvoice', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ customer_id, invoice_date, taxable, tax_rate, tax_due, total, created_at, due_date, active}),
    })
    .then(response => response.json())
    .then(data => {
        alert('Invoiced Saved Successfully');
    })
    .catch(error => {
        throw new Error('Unable to save invoice.');
    });
}

function updateTotals(config, labor_hours = 1) {
    // update the totals of the invoice
    if (labor_hours == 0 || labor_hours == null) {
        labor_hours = 1;
    }

    var getQuantitiesToCalculate = document.querySelectorAll('[id^="quantity_"]');
    var getTaxedToCalculate = document.querySelectorAll('[id^="taxable_"]');
    var getFeeToCalculate = document.querySelectorAll('[id^="fee_"]');

    var subTotal = 0;
    var taxable = 0;

    var tax_rate = parseFloat(config['tax_rate']);

    for(var i in getQuantitiesToCalculate){
        var quantities = parseInt(getQuantitiesToCalculate[i]);
        var taxed = getTaxedToCalculate[i];

        var fees = parseFloat(getFeeToCalculate[i].innerHTML);
        if (fees > 0) {
            subTotal += fees;
    
            if (taxed.innerHTML == 'x') {
                taxable += fees;
            }
        }
    }

    document.getElementById('sub_total_value').innerHTML = (subTotal).toFixed(2);
    document.getElementById('taxable_value').innerHTML = (taxable).toFixed(2);

    taxRate = tax_rate + '%';
    document.getElementById('tax_rate_value').innerHTML = taxRate;
    
    tax_due = taxable * (tax_rate / 100);
    document.getElementById('tax_due_value').innerHTML = (tax_due).toFixed(2);

    total_value = subTotal + tax_due;
    document.getElementById('total_value').innerHTML = "$" + (total_value).toFixed(2);
}

function add_item() {
    // add a new item to the invoice items list

    var preconfiguredInvoiceDataId = document.querySelectorAll('[id^="preconfiguredInvoiceData_"]');

    var totalDataItems = preconfiguredInvoiceDataId.length;

    getPreconfiguredInvoiceItems(totalDataItems + 1);
}

function calculate_totals() {
    // calculate the totals of the invoice

    var preconfiguredInvoiceDataId = document.querySelectorAll('[id^="preconfiguredInvoiceData_"]');

    var totalDataItems = preconfiguredInvoiceDataId.length;

    updateLaborValue(null, totalDataItems);

}