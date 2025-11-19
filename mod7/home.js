window.onload = function() {
    setTimeout(function() {
        let go = confirm("Would you like to talk to our chatbot?");
        if (go) {
            window.location.href = "../mod13/index.php";
        }
    }, 10000);
}

function viewProducts() {
    window.open("../mod8/product.php", "_self");
}

function logout() {
    window.open("logout.php", "_self");
}