


//Filter
/*$(document).ready(function () {
  $('select').selectize({
    // sortField: 'text',
  });
});*/

function Selectize(selector) {
  selector.selectize({
    // sortField: 'text',
  });
}

function PreloaderOFF() {
  $('#preloader').addClass('d-none');
}

function PreloaderON() {
  $('#preloader').removeClass('d-none');
}

function ModalLoaderON() {
  $('#ModalLoader').removeClass('d-none');
  $('#ModalBody').addClass('d-none');
}

function ModalLoaderOFF() {
  $('#ModalLoader').addClass('d-none');
  $('#ModalBody').removeClass('d-none');
}


function exportCSVFile(headers, items, fileTitle) {
    if (headers) {
        items.unshift(headers);
    }

    // Convert Object to JSON
    var jsonObject = JSON.stringify(items);

    var csv = convertToCSV(jsonObject);

    var exportedFilenmae = fileTitle + '.csv' || 'export.csv';

    var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, exportedFilenmae);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", exportedFilenmae);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}

function convertToCSV(objArray) {
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';

    for (var i = 0; i < array.length; i++) {
        var line = '';
        for (var index in array[i]) {
            if (line != '') line += ','

            line += array[i][index];
        }

        str += line + '\r\n';
    }

    return str;
}


//Toast
function Toast(msg) {
    let template = `
        <div id="ToastPop" class="container pop-up-message">
          <div class="row">
            <div class="col-md-4 offset-8 pop-up-message--box me-0">
              <div class="card">
                <div class="card-body">
                  🎉
                  <span>${msg}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
    `;

    $('#SectionArea').prepend(template);

    function HideToast(){
        $(document).ready(function () {
            $('body #SectionArea #ToastPop').remove();
        })
    }

    setTimeout(HideToast, 2000)
}


function DownloadToast(table){
    table.on('click', '.download-link', function (e) {
        let link = $(this).attr('href');
        if(link == "null"){
            Toast("Here is no downloadable file.")
            e.preventDefault();
        }
    });
}