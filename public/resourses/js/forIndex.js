$(document).ready(function () {
    bsCustomFileInput.init()
})

sendTxtFileForm.onsubmit = async (e) => {
    e.preventDefault();


    let response = await fetch('/actions/send_text_file_form', {
        method: 'POST',
        body: new FormData(sendTxtFileForm)
    });

    let result = await response.json();

    $( "#uploadFileStatusLight" ).removeClass( "bg-secondary" );
    $( "#uploadFileStatusLight" ).removeClass( "bg-success" );
    $( "#uploadFileStatusLight" ).removeClass( "bg-danger" );

    if (result?.status == 'UPLOAD') {
        $( "#uploadFileStatusLight" ).addClass( "bg-success" );
        appendResultTableFromFile(result.body);
    } else {
        $( "#uploadFileStatusLight" ).addClass( "bg-danger" );
    }
};

let appendResultTableFromFile = function(tableData){

    $('#fileResultTable').remove();
    let rows = '';
    for (const [key, value] of Object.entries(tableData)) {
        rows += `<tr>
                <th scope="row">${key}</th>
                <td>${value}</td>
            </tr>`;
    }

    let tableElem = `
    <table id="fileResultTable" class="table mt-3">
        <thead>
            <tr>
                <th scope="col">Номер строки</th>
                <th scope="col">Количество цифр</th>
            </tr>
        </thead>
        <tbody>
            ${rows}
        </tbody>
    </table>`
    $( "#sendTxtFileForm").append(tableElem);
}