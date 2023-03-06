<!DOCTYPE html>
<html>
	<head>
		<title>D6 Invoice System - Developer Challenge</title>
		<link rel="stylesheet" type="text/css" href="css/styling.css" >
		<script type='text/javascript' src="js/invoice.js"></script>
	</head>

	<body>
		<div class="invoice padding-2 flex flex-col mx-auto mb-10">
			<div class="flex flex-between w-full">
				<!-- Form for when you want to select a company or create a new company -->
				<form id="populate_new_company_form" class="w-full">
					<div class="flex flex-col">
						<div class="flex flex-row">
							<label for="company_name" class="w-50">Company:</label>
							<div class="companies w-50">
								<select id="companiesDropdown" onclick="allCompanies()" onchange="getSelectedCompany(this)" class="dropdown-content w-full">
									<option value="-1">Please select</option>
									<option value="0">New</option>
								</select>
							</div>
						</div>
					</div>

					<div id="get_selected_company_details" class="hidden flex flex-col">
						<div class="flex flex-row">
							<label for="company_name_input" class="w-60">Company Name:</label><input type="text" id="company_name_input" value="">
						</div>
						<div class="flex flex-row">
							<label for="name_input" class="w-60">Name:</label><input type="text" id="name_input" value="">
						</div>
						<div class="flex flex-row">
							<label for="email_input" class="w-60">Email:</label><input type="text" id="email_input" value="">
						</div>
						<div class="flex flex-row">
							<label for="street_address_input" class="w-60">Address:</label><input type="text" id="street_address_input" value="">
						</div>
						<div class="flex flex-row">
							<label for="city_input" class="w-60">City:</label><input type="text" id="city_input" value="">
						</div>
						<div class="flex flex-row">
							<label for="postal_code_input" class="w-60">ZIP:</label><input type="text" id="postal_code_input" value="">
						</div>
						<div class="flex flex-row">
							<label for="phone_number_input" class="w-60">Phone:</label><input type="text" id="phone_number_input" value="">
						</div>
						<div class="flex flex-row">
							<label for="fax_input" class="w-60">Fax:</label><input type="text" id="fax_input" value="">
						</div>
						<div class="flex flex-row">
							<label for="website_input" class="w-60">Website:</label><input type="text" id="website_input" value="">
						</div>
						<div class="flex flex-row text-right justify-end">
							<input type="submit" value="Populate Invoice" onclick="submitData(event)">				
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="invoice padding-2 flex flex-col mx-auto">
			<div class="flex flex-between w-full">
				
				<!-- Populate company data into invoice -->
				<div class="company_details flex flex-col w-50">
					<h2 class="company_name text-dark-blue"></h2>

					<div class="flex flex-row">
						<div class="inline">Address:</div> <div class="street_address"></div>
					</div>
					<div class="flex flex-row">
						<div class="inline">City, ZIP:</div> 
						<div class="flex flex-row">
							<div class="city"></div>, 
							<div class="postal_code"></div>
						</div>
					</div>
					<div class="flex flex-row">
						<div class="inline">Phone:</div> <div class="phone_number"></div>
					</div>
					<div class="flex flex-row">
						<div class="inline">Fax:</div> <div class="fax"></div>
					</div>
					<div class="flex flex-row">
						<div class="inline">Website:</div> <div class="website"></div>
					</div>

				</div>
				<div class="invoice_details flex flex-col justify-end w-50">

					<h1 class="invoice flex justify-end text-right uppercase text-light-blue">Invoice</h1>
				
					<div class="flex flex-row justify-end">
						<div class="date_name uppercase text-right inline padding-r-4">Date</div>
						<div id="invoice_date" class="date border-1 border-solid border-blue-500 w-100 padding-2 text-center inline"></div>
					</div>
					<div class="flex flex-row justify-end">
						<div class="invoice_number_name uppercase text-right inline padding-r-4">Invoice #</div>
						<div id="invoice_number" class=" border-1 border-solid border-blue-500 w-100 padding-2 text-center inline"></div>
					</div>
					<div class="flex flex-row justify-end">
						<div class="customer_id_name uppercase text-right inline padding-r-4">Customer ID</div>
						<div id="customer_id" class="id border-1 border-solid border-blue-500 w-100 padding-2 text-center inline"></div>
					</div>
					<div class="flex flex-row justify-end">
						<div class="due_date_name uppercase text-right inline padding-r-4">Due Date</div>
						<div id="due_date" class="due_date border-1 border-solid border-blue-500 w-100 padding-2 text-center inline bg-light-blue"></div>
					</div>
				</div>
			</div>
			<br>
			<div class="flex flex-between w-full">
				<div class="bill_to flex flex-col w-50">
					<div class="bg-dark-blue text-white w-full padding-l-4">Bill To</div>
					<div class="flex flex-row padding-l-4">
						<div class="inline">Name:</div> <div class="inline name"></div>
					</div>
					<div class="flex flex-row padding-l-4">
						<div class="inline">Company Name:</div> <div class="inline company_name"></div>
					</div>
					<div class="flex flex-row padding-l-4">
						<div class="inline">Address:</div> <div class="inline street_address"></div>
					</div>
					<div class="flex flex-row padding-l-4">
						<div class="inline">City, ZIP:</div> 
						<div class="flex flex-row">
							<div class="city"></div>, 
							<div class="postal_code"></div>
						</div>
					</div>
					<div class="flex flex-row padding-l-4">
						<div class="inline">Phone:</div> <div class="phone_number"></div>
					</div>

				</div>
				<div class="w-50"></div>
			</div>
			<br>
			
			<div class="clear-fix"></div>
			<!-- Get invoice items to select from  -->
			<table border='1' cellspacing='0' id="invoiceItemsTable">
				<tr>
					<th width=250 class="bg-dark-blue text-white text-center uppercase">Description</th>
					<th width=100 class="bg-dark-blue text-white text-center uppercase">Quantity</th>
					<th width=100 class="bg-dark-blue text-white text-center uppercase">Taxed</th>
					<th width=100 class="bg-dark-blue text-white text-center uppercase">Amount</th>
				</tr>

				<tr>
					<td id="preconfiguredInvoiceData_1">
						<div class="invoiceItems w-50">
							<select id="invoiceItemsDropdown_1" onclick="allPreconfiguredInvoiceData(1)" onchange="getSelectedInvoiceItem(this, 1)" class="dropdown-content w-full">
								<option value="-1">Please select a service</option>
								<!-- a custom field can be added for additional items, but it would be better to only have a form in the backend to add more services -->
							</select>
						</div>
					</td>
					<td id="quantity_1" class="text-center"></td>
					<td id="taxable_1" class="text-center"></td>
					<td id="fee_1" class="text-right"></td>
				</tr>
			</table>

			<div class="clear-fix"></div>
			<!-- Add another item to the list or calculate totals -->
			<div class="add_item_wrapper padding-2 w-full inline-block">
				<div class="text-left inline float-left">
					<div id="add_item" onclick="add_item()" class="save_calculate cursor-pointer inline" >Add Item</div>				
				</div>
				<div class="text-right inline float-right">
					<div id="calculate_totals" onclick="calculate_totals()" class="save_calculate cursor-pointer inline" >Calculate Totals</div>				
				</div>
			</div>

			
			<div class="flex flex-between w-full">
				<div class="other_comments flex flex-col w-50 border-1 border-solid border-blue-500 mt-10">
					<div class="bg-dark-blue text-white w-full padding-l-4">Other Comments</div>
					<div class="flex flex-row padding-l-4">
						<div class="comments_text" id="other_comments"></div>
					</div>
				</div>
				<div class="w-50">
					<table>
						<tr>
							<td class='text-right'>Sub total</td>
							<td class='text-right' id="sub_total_value"></td>
						</tr>
						<tr>
							<td class='text-right'>Taxable</td>
							<td class='text-right' id="taxable_value"></td>
						</tr>
						<tr>
							<td class='text-right'>Tax Rate</td>
							<td class='text-right' id="tax_rate_value"></td>
						</tr>
						<tr>
							<td class='text-right'>Tax Due</td>
							<td class='text-right' id="tax_due_value"></td>
						</tr>
						<tr>
							<td class='text-right'>Other</td>
							<td class='text-right'>-</td>
						</tr>
						<tr>
							<td class='text-right'><b>TOTAL</b></td>
							<td class='text-right bg-light-blue' id="total_value"></td>
						</tr>
						<tr>
							<td colspan="2" class='text-center'><b>Make all checks payable to <br><span class="company_name"></span></b></td>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="text-center w-full">
				<p>
					If you have any questions about this invoice, please contact <br>
					<span id="contact_name"></span>, <span id="contact_number"></span>, <span id="contact_email"></span><br>
					<b>Thank You For Your Business!</b>
				</p>
			</div>
			
		</div>

		<!-- Save invoice  -->
		<div class="save_invoice_wrapper padding-2 flex flex-col mx-auto">
			<div class="flex flex-row text-right justify-end">
				<div id="save_invoice" class="save_invoice cursor-disabled" >Save Invoice</div>				
			</div>
		</div>

	</body>

</html>