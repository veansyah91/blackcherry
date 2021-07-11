// defenisikan element
// history card
const historyCard = document.getElementById('history-card');

// detail card
const detailCard = document.getElementById('detail-card');

// form input
const mulai = document.getElementById('mulai');
const akhir = document.getElementById('akhir');

const submitForm = document.getElementById('submit-form');

const fetchHistory = async (awal, akhir, limit) => {
    axios.get(`/api/daily-outcome-history?awal=${awal}&akhir=${akhir}&limit=${limit}`,)
        .then(response => {
            let data = response.data.data;
            let objectToArray = Object.entries(data);

            $('#table-body-1').empty();
            if (data.length < 1) {
                
                $('#table-body-1')
                .append(`<tr>
                            <td colspan=5 class="text-center font-italic">
                                Data Tidak Ada
                            </td>
                        </tr>`)
            } 
            else {
                objectToArray.forEach(([key, value])=> {
                    let val = value;
                    let currency = new Number(val.sum).toLocaleString("id-ID");
                    $('#table-body-1')
                    .append(`<tr>
                                <td class="text-capitalize">${val.tanggal}</td>

                                <td class="text-right">${currency}</td>
                                <td>
                                    <a href="#formInputCard" class="btn btn-sm btn-outline-info" onClick="detail('${val.tanggal}')">Lihat Detail</a>
                                </td>
                            </tr>`)
                })

            }
        })
        .catch(err => {
            console.log(err);
        })
}

const fetchDetail = (tanggal) => {
    axios.get(`/api/daily-outcome-detail?tanggal=${tanggal}`)
        .then(response => {
            let data = response.data.data;
            if (data.length < 1) {
                $('#table-body-2')
                .append(`<tr>
                            <td colspan=5 class="text-center font-italic">
                                Data Belum Dimasukkan
                            </td>
                        </tr>`)
            } else {
                let indexTable = 1;
                
                data.map(data => {
                    let currency = new Number(data.jumlah).toLocaleString("id-ID");
                    $('#table-body-2')
                    .append(`<tr>
                                <th scope="row">${indexTable++}</th>
                                <td>${data.tanggal}</td>
                                <td>Rp. ${currency}</td>
                                <td class="text-capitalize ">${data.keterangan}</td>
                            </tr>`)
                })
            }

        })
        .catch(err => {
            console.log(err)
        })
}

const detail = (tanggal) => {
    historyCard.classList.add('d-none');
    detailCard.classList.remove('d-none');
    $('#table-body-2 ').empty();
    fetchDetail(tanggal);
}

const showHistory = () => {
    historyCard.classList.remove('d-none');
    detailCard.classList.add('d-none');
}

window.addEventListener('load', function(){
    fetchHistory(null ,null, 7);
})

submitForm.addEventListener('click', function(){
    $('#table-body-1').empty();
    fetchHistory(mulai.value ,akhir.value, 0);
})