// state 
let statusEdit = false;
let indexTable = 1;

let dataIdCustomer = 0;

// paginate
let page;
let perPage;
let search;

let totalData;
let allData = 0;

let query = {};

// card
const index = document.getElementById('index');
const cardFormInput = document.getElementById('card-form-input');

// alert
const successAlert = document.getElementById('success-alert');
const closeSuccessAlert = document.getElementById('close-success-alert');
const statusAlert = document.getElementById('status-alert');

// definisi id pada elemen table
const tableData = document.getElementById("table-data");

// search input
const searchInput = document.getElementById('search-input');
const submitSearch = document.getElementById('submit-search');

// button
const addButton = document.getElementById('add-button');
const cancelButton = document.getElementById('cancel-button');
const showMoreButton = document.getElementById('show-more-button');

// card form input
const headerCard = document.getElementById('header-card');
const submitForm = document.getElementById('submit-form');

const idCustomer = document.getElementById('id-customer');
const nama = document.getElementById('nama');
const validasiNama = document.getElementById('validasi-nama');

const alamat = document.getElementById('alamat');
const noHp = document.getElementById('no-hp');

// modal
const confirmModal = document.getElementById('confirm-modal');

const showMore = async () => {
    allData = await countData();

    if (totalData < allData) {
        showMoreButton.classList.remove('d-none');
    } else {
        showMoreButton.classList.add('d-none');
    }

}

function showMoreFunc(){

    totalData += perPage;
    page++;
    query = {...query, page: page}

    showData();
    showMore();
}

const reset = () => {

    // reset paginate
    page = 1;
    perPage = 5;
    search = '';
    totalData = 5;

    query = {
        page: page,
        perPage: perPage,
        search: search
    }

    indexTable = 1;
    statusEdit = false;

    cardFormInput.classList.add('d-none');
    index.classList.remove('d-none');

    nama.value = '';
    alamat.value = '';
    noHp.value = '';
    idCustomer.value = '';

    searchInput.value = '';

    $('#table-body').empty();
    showData();
    showMore();
}

const hapusData = (id) => {
    dataIdCustomer = id;
}

const getData = () => {
    let url = `/api/customer?page=${query.page}&perPage=${query.perPage}&search=${query.search}`;

    return fetch(url)
        .then(response => response.json())
        .then(response => response.data)
}

function countData(){
    return fetch(`/api/customers?search=${query.search}`)
        .then(response => response.json())
        .then(response => response.data)
}

const showData = async () => {
    let data = await getData();
    let customers = Object.values(data);
    
    if (customers.length < 1) {
        $('#table-body')
        .append(`<tr>
                    <td colspan=5 class="text-center font-italic">
                        Data Belum Dimasukkan
                    </td>
                </tr>`)
    } else {
        customers.map(customer => {
            let hp = customer.no_hp ? customer.no_hp : '';
            $('#table-body')
            .append(`<tr>
                        <th scope="row">${indexTable++}</th>
                        <td class="text-capitalize">${customer.nama}</td>
                        <td class="text-capitalize">${customer.alamat}</td>
                        <td>${hp}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal" onClick="hapusData(${customer.id})">Hapus</button>
                            <button class="btn btn-sm btn-secondary" onClick="ubahData(${customer.id})">Ubah</button>
                        </td>
                    </tr>`)
        })
    }
}

const ubahData = (id) => {
    cardFormInput.classList.remove('d-none');
    index.classList.add('d-none');
    headerCard.innerText = "Ubah Data";

    statusEdit = true;

    // get data by Id
    axios.get(`/api/customer/${id}`)
    .then(function (response) {
        // handle success

        nama.value = response.data.data.nama;
        alamat.value = response.data.data.alamat;
        noHp.value = response.data.data.no_hp;
        dataIdCustomer = response.data.data.id;

    })
    .catch(function (error) {
        // handle error
        console.log(error);
    })
}

window.addEventListener('load',async function(){

    reset();

});

addButton.addEventListener('click', function() {
    statusEdit = false;
    cardFormInput.classList.remove('d-none');
    index.classList.add('d-none');
    headerCard.innerText = "Tambah Data";
});

cancelButton.addEventListener('click', function(){
    index.classList.remove('d-none');
    cardFormInput.classList.add('d-none');
});

submitForm.addEventListener('click', function(){
    let data = {
        nama: nama.value,
        alamat: alamat.value,
        no_hp: noHp.value
    }

    if (statusEdit) {
        // update data produk ke database

        axios.put(`/api/customer/${dataIdCustomer}`,data)
        .then(async (response) => {
            if (response.data) {

                reset();              
                statusAlert.innerText = "mengubah"
                successAlert.classList.remove('d-none'); 
            }
        })
        .catch((error) => {
            
            if (error) {
                let errResponse = error.response.data.errors;

                if (errResponse.kode) {
                    validasiKode.classList.remove('d-none');
                }

                if (errResponse.nama_produk) {
                    validasiNama.classList.remove('d-none');
                }
            }
            
        })

    } else {

        // input data produk baru ke database

        axios.post('/api/customer',data)
        .then(async (response) => {
            if (response.data) {

                reset();      
                
                statusAlert.innerText = "menambah"
                successAlert.classList.remove('d-none'); 
            }
        })
        .catch((error) => {

            if (error) {
                validasiNama.classList.remove('d-none');
            }

        })
    }   
});

confirmModal.addEventListener('click',function(){

    axios.delete(`/api/customer/${dataIdCustomer}`)
    .then(async (response) => {
        if (response.data) {
            
            statusAlert.innerText = "menghapus"
            successAlert.classList.remove('d-none');

            $('#deleteConfirmationModal').modal('toggle');
            reset(); 
        }
    })
    .catch((err) => {
            console.log(err);
    })

})

closeSuccessAlert.addEventListener('click', function(){
    successAlert.classList.add('d-none');
});

submitSearch.addEventListener('click', function(){
    
    query = {...query, search: searchInput.value};

    indexTable = 1;
    
    $('#table-body').empty();
    showData();
    showMore();


})
