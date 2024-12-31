import { DataTable } from "simple-datatables"
import "simple-datatables/dist/style.css"

document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector(".simple-datatables");
    if (table) {
        new DataTable(table);
    }
});