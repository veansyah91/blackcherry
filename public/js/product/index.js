let statusEdit = true;

let dataIdSelect = 0;

let page = 1;
let start = 1;

let perPage = 5;
let totalData = 0;

let indexTable = 1;

let search = '';

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

//defenisi element pada form input
const headerCard = document.getElementById('header-card');

const submitForm = document.getElementById('submit-form');

const idProduct = document.getElementById('id-product');

const kode = document.getElementById('kode');
const validasiKode = document.getElementById('validasi-kode-produk');

const namaProduk = document.getElementById('nama-produk');
const validasiNama = document.getElementById('validasi-nama-produk');

const jenisProduk = document.getElementById('jenis-produk');

const harga = document.getElementById('harga');

// show more
const showMore = document.getElementById('show-more');

// modal
const confirmModal = document.getElementById('confirm-modal');

function countData(){
    return fetch(`/api/products?search=${query.search}`)
        .then(response => response.json())
        .then(response => response.data)
}

function getData(){
    let url= `/api/product?page=${query.page}&perPage=${query.perPage}&search=${query.search}`;
    
    return fetch(url)
        .then(response => response.json())
        .then(response => response.data)
}

function getDataPerId(id){
    return fetch(`/api/product/${id}`)
        .then(response => response.json())
        .then(response => response.data)
}

function hapusData(id){
    dataIdSelect = id;
}

async function ubahData(id)
{
    cardFormInput.classList.remove('d-none');
    index.classList.add('d-none');
    headerCard.innerText = "Ubah Data";
    statusEdit = true;

    let product = await getDataPerId(id);

    idProduct.value = product[0].id;
    kode.value = product[0].kode;
    namaProduk.value = product[0].nama_produk;
    jenisProduk.value = product[0].jenis_produk;
    harga.value = product[0].harga;
}

async function showData(){

    let products = [];

    data = await getData();

    products = Object.values(data);

    $('#table-body').empty();

    if (products.length < 1) {
        $('#table-body')
        .append(`<tr>
                    <td colspan=5 class="text-center font-italic">
                        Data Belum Dimasukkan
                    </td>
                </tr>`)
    } else {
                
        products.map(product => {

            let currency = new Number(product.harga).toLocaleString("id-ID");

            let warna = product.jenis_produk == 'makanan' ? 'text-danger' : 'text-primary'

            $('#table-body')
            .append(`<tr>
                        <th scope="row">${indexTable++}</th>
                        <td>${product.nama_produk}</td>
                        <td class="text-capitalize ${warna}">${product.jenis_produk}</td>
                        <td>Rp. ${currency}</td>
                        <td>${product.kode}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal" onClick="hapusData(${product.id})">Hapus</button>
                            <button class="btn btn-sm btn-secondary" onClick="ubahData(${product.id})">Ubah</button>
                        </td>
                    </tr>`)
        })

    }
}

async function showMoreFunc(){
    let products = [];

    page = page + 1;

    query = {
        perPage : perPage,
        page: page,
        search: search
    }

    data = await getData();

    products = Object.values(data);

    products.map(product => {

        let currency = new Number(product.harga).toLocaleString("id-ID");

        let warna = product.jenis_produk == 'makanan' ? 'text-danger' : 'text-primary'

        $('#table-body')
        .append(`<tr>
                    <th scope="row">${indexTable++}</th>
                    <td>${product.nama_produk}</td>
                    <td class="text-capitalize ${warna}">${product.jenis_produk}</td>
                    <td>Rp. ${currency}</td>
                    <td>${product.kode}</td>
                    <td>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal" onClick="hapusData(${product.id})">Hapus</button>
                        <button class="btn btn-sm btn-secondary" onClick="ubahData(${product.id})">Ubah</button>
                    </td>
                </tr>`)
    })

    if (totalData < perPage * page) {
        showMore.classList.add('d-none');
    }
}

const reset = () => {
    index.classList.remove('d-none');
    cardFormInput.classList.add('d-none');
    validasiKode.classList.add('d-none');
    validasiNama.classList.add('d-none');

    kode.value = "",
    namaProduk.value = ""
    jenisProduk.value = "makanan",
    harga.value = 0;

    searchInput.value = '';
}

window.addEventListener('load', async function()
{
    query = {
        perPage : perPage,
        page: page,
        search: search
    }

    // ambil data product 
    showData();
    // akhir masukkan data ke table

    totalData = await countData();

    if (totalData < perPage) {
        showMore.classList.add('d-none');
    }

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

closeSuccessAlert.addEventListener('click', function(){
    successAlert.classList.add('d-none');
});

confirmModal.addEventListener('click',function(){
    axios.delete(`/api/product/${dataIdSelect}`)
        .then(async (response) => {
            if (response.data.data) {
                console.log(response.data);

                reset();              
                statusAlert.innerText = "menghapus"
                successAlert.classList.remove('d-none'); 

                indexTable = 1;
                page = 1;

                query = {
                    perPage : perPage,
                    page: page,
                    search: searchInput.value
                }
                
                showData();
                totalData = await countData();
                if (totalData < perPage) {
                    showMore.classList.add('d-none');
                } else {
                    showMore.classList.remove('d-none');
                }

                $('#deleteConfirmationModal').modal('toggle')
            }
        })
        .catch((error) => {
            
            let errResponse = error.response.data.errors;
            console.log(errResponse);

        })
})

submitForm.addEventListener('click',async function(e){

    let data = {
        "kode" : kode.value,
        "nama_produk" : namaProduk.value,
        "jenis_produk" : jenisProduk.value,
        "harga" : harga.value,
    }

    if (statusEdit) {
        // update data produk ke database

        axios.put(`/api/product/${idProduct.value}`,data)
        .then(async (response) => {
            if (response.data.data) {
                console.log(response.data);

                reset();              
                statusAlert.innerText = "mengubah"
                successAlert.classList.remove('d-none'); 

                indexTable = 1;
                page = 1;

                query = {
                    perPage : perPage,
                    page: page,
                    search: searchInput.value
                }

                showData();
                totalData = await countData();
                if (totalData < perPage) {
                    showMore.classList.add('d-none');
                } else {
                    showMore.classList.remove('d-none');
                }
            }
        })
        .catch((error) => {
            
            let errResponse = error.response.data.errors;
            console.log(errResponse);

            if (errResponse.kode) {
                validasiKode.classList.remove('d-none');
            }

            if (errResponse.nama_produk) {
                validasiNama.classList.remove('d-none');
            }

        })

    } else {

        // input data produk baru ke database

        axios.post('/api/product',data)
        .then(async (response) => {
            if (response.data.data) {

                reset();              
                statusAlert.innerText = "menambah"
                successAlert.classList.remove('d-none'); 

                indexTable = 1;
                page = 1;

                query = {
                    perPage : perPage,
                    page: page,
                    search: searchInput.value
                }

                showData();
                totalData = await countData();

                if (totalData < perPage) {
                    showMore.classList.add('d-none');
                } else {
                    showMore.classList.remove('d-none');
                }
            }
        })
        .catch((error) => {
            
            let errResponse = error.response.data.errors;

            if (errResponse.kode) {
                validasiKode.classList.remove('d-none');
            }

            if (errResponse.nama_produk) {
                validasiNama.classList.remove('d-none');
            }

        })
    }    
});

submitSearch.addEventListener('click', async function(){

    page = 1;

    query = {
        perPage : perPage,
        page: page,
        search: searchInput.value
    }

    indexTable = 1;

    totalData = await countData();

    if (totalData < perPage) {
        showMore.classList.add('d-none');
    } else {
        showMore.classList.remove('d-none');
    }

    showData();
})

