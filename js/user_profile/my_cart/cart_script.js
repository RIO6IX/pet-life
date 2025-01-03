function decreaseItemCount(productId) {
    let count = document.getElementById("item-count-"+productId)
    if (parseInt(count.innerText) > 1) {
        fetch("process/user_profile/my_cart/update_cart.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "action=decrease&product_id=" + productId
        })
        .then(response => {
            if (response.ok) {
                count.innerText = parseInt(count.innerText) - 1
                calculateTotalCartValue()
            } else {
                alert("Error Updating Cart")
            }
        })
        .catch(error => console.error("Request Failed: ", error))
    }
}

function increaseItemCount(productId) {
    let count = document.getElementById("item-count-"+productId)
    
    fetch("process/user_profile/my_cart/update_cart.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "action=increase&product_id=" + productId
    })
    .then(response => {
        if (response.ok) {
            count.innerText = parseInt(count.innerText) + 1
            calculateTotalCartValue()
        } else {
            alert("Error Updating Cart")
        }
    })
    .catch(error => console.error("Request failed:", error))
}

function calculateTotalCartValue() {
    fetch("process/user_profile/my_cart/calculate_cart_value.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            userid: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        let amount = document.getElementById("amount")
        if (data.amount == 'empty') {
            amount.innerText = `Rs.${(0).toFixed(2)}`
        } else {
            amount.innerText = `Rs.${parseInt(data.amount).toFixed(2)}`
        }
    })
    .catch(error => console.error("Request Failed: ", error))
}

function addToCart(product_id) {
    fetch("process/user_profile/my_cart/update_cart.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "action=add&product_id=" + product_id
    })
    .then(resoponse => resoponse.json())
    .then(data => {
        if (data.status == "success") {
            alert(`${data.body}`)
        } else {
            alert(`${data.body}`)
        }
    })
    .catch(error => console.error("Request Failed:", error))
}

calculateTotalCartValue()