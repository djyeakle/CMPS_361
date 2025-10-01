function searchTable() {
    var input, filter, table, tr, td, i, j, txtValue;

    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    table = document.getElementById("dataGrid");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) { //starts at 1 to skip header
        tr[i].style.display = "none"; // hides rows to start
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) { // look through each cell
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = ""; //show row if a match is found
                    break;
                }
            }
        }
    }
}