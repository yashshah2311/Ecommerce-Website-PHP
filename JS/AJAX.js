/*
 #Revision History
 #DEV                DATE               DESC
 #YASH (2014107)     2020-12-06         Created ajax Javascript file and folder.
 #YASH (2014107)     2020-12-06         Added script for ajax xhr response.
 #YASH (2014107)     2020-12-06         Added script for searchPurchases response.
 #YASH (2014107)     2020-12-08         Implemented deletePurchases functionality.
 #YASH (2014107)     2020-12-11         Removed bug from delete functionality.
 */

//java script error handler
function handleError(error) {
    alert("An error occured in the javascript code: " + error);
}

//get xml http request
function getXmlHttpRequest() {
    try {
        var xhr = null;
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        } else {
            if (window.ActiveXObject) {
                try {
                    xhr = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (error) {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
            } else {
                alert("Your browser doesnot support XMLHTTPRequest Objects.")
                var xhr = null;
            }
        }
        return xhr;
    } catch (error) {
        handleError(error);
    }
}

//search purchase ajax response
function searchPurchases() {
    try {
        //get ajax response
        var xhr = getXmlHttpRequest();
        //if state changes and if success show ajax response
        xhr.onreadystatechange = function ()
        {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('searchResults').innerHTML = xhr.responseText;
            }
        };
        //send query to search purchases
        xhr.open("POST", "searchPurchases.php");
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var searchTextbox = document.getElementById('searchQuery');
        var searchQuery = searchTextbox.value;
        xhr.send("searchQuery=" + searchQuery);
    } catch (error) {
        handleError(error);
    }
}

//delete purchase ajax response
function deletePurchases() {
    //confirm user to delete the purchase
    var x = confirm("Are you sure you want to delete?");
    //if yes try deleting purchase using ajax
    if (x) {
        try {
            //get id of the purchase element clicked 
            purchase_id = event.srcElement.id;
            //get ajax response request
            var xhr = getXmlHttpRequest();
            //check for ready state change
            xhr.onreadystatechange = function ()
            {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    //get element by id and remove nodes.
                    var row = document.getElementById(purchase_id);
                    row.parentNode.removeChild(row);
                }
            };
            
            // send delete id using ajax to make db call
            xhr.open("POST", "deletePurchase.php");
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var deleteQuery = purchase_id.toString();
            xhr.send("deleteQuery=" + deleteQuery);
        } catch (error) {
            handleError(error);
        }
        return true;
    } else {
        return false;
    }
}