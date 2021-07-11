// form input
const bulan = document.getElementById('bulan');
const mulai = document.getElementById('mulai');
const akhir = document.getElementById('akhir');
const tahun = document.getElementById('tahun');

const validasiTanggalAwal = document.getElementById('validasi-tanggal-awal');
const validasiTanggalAkhir = document.getElementById('validasi-tanggal-akhir');

const submitForm = document.getElementById('submit-form');

// alert
const statusAlert = document.getElementById('status-alert');

// state 
let indexTable = 1;

const showData = () => {
    axios.get(`/api/monthly-outcome`)
            .then(response => {
                console.log(response.data);
                let data = response.data.data;

                if (data.length < 1) {
                    $('#table-body')
                    .append(`<tr>
                                <td class="font-italic" colspan="4">Data Transaksi Bulanan Belum Dibuat</td>
                            </tr>`)
                } else {
                    data.map(data => {
                        let currency = new Number(data.jumlah).toLocaleString("id-ID");
                        $('#table-body')
                        .append(`<tr>
                                    <th scope="row">${indexTable++}</th>
                                    <td class="text-capitalize text-center">${data.tahun}</td>
                                    <td class="text-capitalize text-center">${data.bulan}</td>
                                    <td class="text-capitalize">Rp. ${currency}</td>
                                </tr>`)
                    })
                    
                }
            })
            .catch(err => {
                console.log(err);
            })
        }

window.addEventListener('load', function(){

    let date = new Date();
    bulan.value = date.getMonth() + 1;
    tahun.value = date.getFullYear();

    showData();

})

submitForm.addEventListener('click', function(){
    let data = {
        mulai: mulai.value,
        akhir: akhir.value,
        bulan: bulan.value,
        tahun: tahun.value
    }

    axios.put('/api/monthly-outcome', data)
            .then(response => {
                console.log(response.data);
            })
            .catch(err => {
                if (err) {
                    let errResponse = err.response.data.errors;
                    console.log(errResponse);

                    if (errResponse.mulai) {
                        validasiTanggalAwal.classList.remove('d-none');
                    } else {
                        validasiTanggalAwal.classList.add('d-none');
                    }

                    if (errResponse.akhir) {
                        validasiTanggalAkhir.classList.remove('d-none');
                    } else {
                        validasiTanggalAkhir.classList.add('d-none');
                    }
                }
                
            })
})