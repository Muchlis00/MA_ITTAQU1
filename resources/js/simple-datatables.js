import { DataTable, exportCSV  } from "simple-datatables"
import "simple-datatables/dist/style.css"

document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector(".simple-datatables");
    const dataTable = table ? new DataTable(table) : null;

    document.querySelector(".simple-datatables-export-button").addEventListener("click", () => {
        const exportOptions = {
            filename: 'export',
            columnDelimiter: ','
        }
        
        exportCSV(dataTable, exportOptions)
    })
});

