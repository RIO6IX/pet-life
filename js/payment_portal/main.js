/* Credit: w3schools website :- https://www.w3schools.com/howto/howto_js_accordion.asp*/


var acc = document.getElementsByClassName("accordion")
let i
var notClicked = true

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active")
        notClicked = false

        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none"
        } else {
            panel.style.display = "block"
            
        }
    })
}

function getSavedCardInfo() {
    if (notClicked) {

        fetch("process/payment_portal/process_payment.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "method=getcard"
        })
        .then(response => response.json())
        .then(data => {
            if (data.status == "success") {
                let choice = confirm("Saved Credit Card Found. Do you want to use it?")
                if (choice) {
                    document.getElementById("card-number").value = data.cardnum
                    document.getElementById("exp-date").value = data.expdate
                    document.getElementById("cvc").value = data.cvc
                    document.getElementById("name").value = data.name
                }
                document.getElementById("card").style.display = "block"
            }
        })
        .catch(error => console.error(error))
    }
}

function getAddressInfo() {
   
    fetch("process/payment_portal/process_payment.php", {
        method: "POST",
        headers: {
            "Content-type": "application/x-www-form-urlencoded"
        },
        body: "method=getaddress"
    })
    .then(response => response.json())
    .then(data => {
        if (data.status == "success") {
            document.getElementById("full-name").value = data.name
            document.getElementById("mobile-num").value = data.mobile_num
            document.getElementById("street").value = data.street
            document.getElementById("city").value = data.city
            document.getElementById("postal-code").value = data.postal_code

            document.getElementById("cod").style.display = "block"
        } else {
            alert("No address found.")
        }
    })
    .catch(error => console.error(error))
    
}
