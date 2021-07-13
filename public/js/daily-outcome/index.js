// state
let indexTable = 1;
let statusUpdate;
let dataId;

// element main content
const mainContent = document.getElementById('main-content');
// akhir main content

// element alert
const successAlert = document.getElementById('success-alert');
const statusAlert = document.getElementById('status-alert');
const closeSuccessAlert = document.getElementById('close-success-alert');
// akhir element alert

// element form
const formInputCard = document.getElementById('form-input-card');
const cancelEditForm = document.getElementById('cancel-edit-form');

const headerForm = document.getElementById('header-form');

const idDailyOutcome = document.getElementById('id-daily-outcome');
const tanggal = document.getElementById('tanggal');
const validasiTanggal = document.getElementById('validasi-tanggal');

const jumlah = document.getElementById('jumlah');
const validasiJumlah = document.getElementById('validasi-jumlah');

const keterangan = document.getElementById('keterangan');
const validasiKeterangan = document.getElementById('validasi-keterangan');
const submitForm = document.getElementById('submit-form');
// akhir elemen form

// element card
const total = document.getElementById('total');
// akhir element card

// modal
const confirmModal = document.getElementById('confirm-modal');
// akhir modal

const reset = () => {
    indexTable = 1;
    statusUpdate = false;
    headerForm.innerHTML = "Input Pengeluaran";

    // kosongkan input value 
    jumlah.value = '';
    keterangan.value = '';

    $('#table-body').empty();
}

const getData = () => {
    axios.get('/api/daily-outcome')
        .then(response => {
            response.data.data            
        })
        .catch(error=> {
            console.log(error);
        })
}

const showData = async () => {
    await axios.get('/api/daily-outcome')
        .then(response => {
            let data = response.data.data;
            
            if (data.length < 1) {
                
                $('#table-body')
                .append(`<tr>
                            <td colspan=5 class="text-center font-italic">
                                Data Belum Dimasukkan
                            </td>
                        </tr>`)
            } 
            else {
                let totalData = 0;
                data.map(data => {
                    let currency = new Number(data.jumlah).toLocaleString("id-ID");
                    totalData += parseInt(data.jumlah);
                    $('#table-body')
                    .append(`<tr>
                                <th scope="row">
                                    ${indexTable++}
                                </th>
                                <td class="text-right">${currency}</td>
                                <td class="text-capitalize">${data.keterangan}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal" onClick="hapusData(${data.id})">Hapus</button>
                                    <a href="#formInputCard" class="btn btn-sm btn-secondary" onClick="ubahData(${data.id})">Ubah</a>
                                </td>
                            </tr>`)
                })
                let currencyTotal = new Number(totalData).toLocaleString("id-ID");
                total.innerText = `Rp. ${currencyTotal}`;

            }
        })
        .catch(error=> {
            console.log(error);
        })
    
}

const hapusData = (id) => {
    dataId = id;
}

const ubahData = (id) => {
    statusUpdate = true;
    headerForm.innerText = 'Edit Pengeluaran';
    cancelEditForm.classList.remove('d-none');

    // hilangkan validasi
    validasiJumlah.classList.add('d-none');
    validasiKeterangan.classList.add('d-none');
    validasiTanggal.classList.add('d-none');

    axios.get(`/api/daily-outcome/${id}`)
        .then(response => {
            let data = response.data.data;
            tanggal.value = data.tanggal;
            keterangan.value = data.keterangan;
            jumlah.value = data.jumlah;
            idDailyOutcome.value = data.id;
        })
        .catch(error=> {
            console.log(error);
        })
}

window.addEventListener('load',async function(){
    reset();
    showData();
})

submitForm.addEventListener('click', function(){

    let data = {
        jumlah: jumlah.value,
        keterangan: keterangan.value,
        tanggal: tanggal.value
    }
    
    if (statusUpdate) {

        // input data produk baru ke database

        axios.put(`/api/daily-outcome/${idDailyOutcome.value}`, data)
        .then(async (response) => {
            if (response.data) {

                reset();      
                showData();
                console.log(response.data);
                statusAlert.innerText = "mengubah"
                successAlert.classList.remove('d-none'); 

                // hilangkan validasi
                validasiJumlah.classList.add('d-none');
                validasiKeterangan.classList.add('d-none');
                validasiTanggal.classList.add('d-none');

                cancelEditForm.classList.add('d-none');
            }
        })
        .catch((error) => {
            console.log(error);
            if (error) {
                let errResponse = error.response.data.errors;

                if (errResponse.jumlah) {
                    validasiJumlah.classList.remove('d-none');
                } else {
                    validasiJumlah.classList.add('d-none');
                }

                if (errResponse.keterangan) {
                    validasiKeterangan.classList.remove('d-none');
                }else {
                    validasiKeterangan.classList.add('d-none');
                }

                if (errResponse.tanggal) {
                    validasiTanggal.classList.remove('d-none');
                } else {
                    validasiTanggal.classList.add('d-none');
                }
            }

        })
    } else {

        // input data produk baru ke database
        console.log(data);
        axios.post('/api/daily-outcome', data)
        .then(async (response) => {
            if (response.data) {

                reset();      
                showData();
                console.log(response.data);
                statusAlert.innerText = "menambah"
                successAlert.classList.remove('d-none'); 

                // hilangkan validasi
                validasiJumlah.classList.add('d-none');
                validasiKeterangan.classList.add('d-none');
                validasiTanggal.classList.add('d-none');

            }
        })
        .catch((error) => {
            console.log(error);
            if (error) {
                let errResponse = error.response.data.errors;
                console.log(errResponse);

                if (errResponse.jumlah) {
                    validasiJumlah.classList.remove('d-none');
                } else {
                    validasiJumlah.classList.add('d-none');
                }

                if (errResponse.keterangan) {
                    validasiKeterangan.classList.remove('d-none');
                }else {
                    validasiKeterangan.classList.add('d-none');
                }

                if (errResponse.tanggal) {
                    validasiTanggal.classList.remove('d-none');
                } else {
                    validasiTanggal.classList.add('d-none');
                }
            }

        })
    }

})

closeSuccessAlert.addEventListener('click', function(){
    successAlert.classList.add('d-none'); 
})

confirmModal.addEventListener('click', function(){
    axios.delete(`/api/daily-outcome/${dataId}`)
        .then(async (response) => {
            if (response.data) {
                reset();      
                showData();
                console.log(response.data);
                statusAlert.innerText = "menghapus"
                successAlert.classList.remove('d-none');

                $('#deleteConfirmationModal').modal('toggle');
                reset(); 
            }
        })
        .catch((error) => {
            
            console.log(error);

        })
})

cancelEditForm.addEventListener('click', function(){
    cancelEditForm.classList.add('d-none');

    statusUpdate = false;
    headerForm.innerHTML = "Input Pengeluaran";

    // kosongkan input value 
    jumlah.value = '';
    keterangan.value = '';

    // hilangkan validasi
    validasiJumlah.classList.add('d-none');
    validasiKeterangan.classList.add('d-none');
    validasiTanggal.classList.add('d-none');
})