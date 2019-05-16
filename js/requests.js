//Gets all customer records and puts them in table
function getCustomers(){
    var request = new XMLHttpRequest();
    request.open('GET', 'http://localhost/code-challenge/ws/customers/', true)
    request.onload = function() {
      var data = JSON.parse(this.response);
      if (request.status >= 200 && request.status < 400) {
        rowPopulate(data);
      } else {
        console.log('Customer not Found');
      }
    }
    
    request.send();
}

//Function to get customer amount for dashboard
function getCustomerAmount(){
  var request = new XMLHttpRequest();
  var amount = 0;
    request.open('GET', 'http://localhost/code-challenge/ws/customers/', false)
    request.onload = function() {
      var data = JSON.parse(this.response);
      if (request.status >= 200 && request.status < 400) {
        data.forEach(customer => {
          amount++;
        })
      } else {
        console.log('Customer not Found');
      }
    }
    
    request.send();
    return amount;
}

//gets single customer record 
function getCustomer(id){
    var request = new XMLHttpRequest();
    request.open('GET', 'http://localhost/code-challenge/ws/customers/' + id, true)
    request.onload = function() {
      // Begin accessing JSON data here
      var data = JSON.parse(this.response);
    
      if (request.status >= 200 && request.status < 400) {
        Parent=document.getElementsByTagName("tbody").item(0);
        while(Parent.hasChildNodes()) {
            Parent.removeChild(Parent.firstChild);
        }
        rowPopulate(data);
      } else {
        console.log('Customer not Found');
      }
    }
    
    request.send();
}

//Helper function to populate table rows (Change to object arrays  + loops)
function rowPopulate(data) {
    data.forEach(customer => {
        tabBody=document.getElementsByTagName("tbody").item(0);   
        row=document.createElement("tr");
        cell1 = document.createElement("td");
        cell2 = document.createElement("td");
        cell3 = document.createElement("td");
        cell4 = document.createElement("td");
        cell5 = document.createElement("td");
        cell6 = document.createElement("td");
        cell7 = document.createElement("td");
        textnode1=document.createTextNode(customer.id);
        textnode2=document.createTextNode(customer.email);
        textnode3=document.createTextNode(customer.first_name);
        textnode4=document.createTextNode(customer.last_name);
        textnode5=document.createTextNode(customer.ip);
        textnode6=document.createTextNode(customer.latitude);
        textnode7=document.createTextNode(customer.longitude);
        cell1.appendChild(textnode1);
        cell2.appendChild(textnode2);
        cell3.appendChild(textnode3);
        cell4.appendChild(textnode4);
        cell5.appendChild(textnode5);
        cell6.appendChild(textnode6);
        cell7.appendChild(textnode7);
        row.appendChild(cell1);
        row.appendChild(cell2);
        row.appendChild(cell3);
        row.appendChild(cell4);
        row.appendChild(cell5);
        row.appendChild(cell6);
        row.appendChild(cell7);
        tabBody.appendChild(row);
        })
}
