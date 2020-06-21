function filterTable(search_id, table_id) {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById(search_id);
  filter = input.value.toUpperCase();
  table = document.getElementById(table_id);
  tr = table.getElementsByTagName("tr");
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    tds = tr[i].getElementsByTagName("td");
    for (var j=1, max=3; j < max; j++) {
        td = tds[j];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
    }
  }
}
