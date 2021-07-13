// state
let nomorNotaState = 0;
let totalInvoice = 0;
let invoice = {};
// button
const newInvoice = document.getElementById('new-invoice-button');
const bayar = document.getElementById('bayar-button');
const bayar2 = document.getElementById('bayar-button-2');
const backToTodayDetail = document.getElementById('back-to-today-detail-button');

// card
const detailCard2 = document.getElementById('detail-card-2');
const detailTodayCard = document.getElementById('detail-today-card');

// form invoice
const nomorNota = document.getElementById('nomor-nota');

const inputNama = document.getElementById('input-nama');
const cariNama = document.getElementById('cari-nama');
const daftarCariNama = document.getElementById('daftar-cari-nama');
const idPelanggan = document.getElementById('id-pelanggan');

const namaProduk = document.getElementById('nama-produk');
const cariProduk = document.getElementById('cari-produk');
const daftarCariProduk = document.getElementById('daftar-cari-produk');
const idProduk = document.getElementById('id-produk');

const inputHarga = document.getElementById('input-harga');
const qty = document.getElementById('qty');

const submitForm = document.getElementById('submit-form');

// table detail invoice
const keteranganNomorNota = document.getElementById('keterangan-nomor-nota');

const totalBelanja = document.getElementById("total-belanja");

const totalToday = document.getElementById('total-today');

const totalInvoiceDetail = document.getElementById('total-invoice-detail');

let total = 0;

// modal
const confirmModal = document.getElementById('confirm-modal');

const setInvoiceNumber = () => {
    axios.get('/api/get-invoice-number')
            .then(response => {
                console.log(response.data.data.nomor);
                if (response.data.data) {
                    nomorNota.value = parseInt(response.data.data.nomor) + 1; 
                    keteranganNomorNota.innerText = parseInt(response.data.data.nomor) + 1;
                } else {
                    nomorNota.value = 1;
                    keteranganNomorNota.innerText = 1;
                }
            })
            .catch(err => {
                console.log(err);
            })
}

const cariNamaPelanggan = () => {
    $('#daftar-cari-nama').empty();

    $('#daftar-cari-nama')
    .append(`<a class="dropdown-item font-italic" href="#">Masukkan Nama Pelanggan</a>`);
}

const cariNamaProduk = () => {
    $('#daftar-cari-produk').empty();
    $('#daftar-cari-produk')
    .append(`<a class="dropdown-item font-italic" href="#">Masukkan Nama Produk</a>`);
}

const pilihNama = (id, nama) => {
    idPelanggan.value = id;
    inputNama.value = nama;
}

const pilihProduk = (id, produk, harga) => {
    idProduk.value = id;
    namaProduk.value = produk;
    inputHarga.value = harga;
}

const resetDetail = () => {
    total = 0;
    totalBelanja.innerText = total;
    $('.table-body').empty();
    $('.table-body')
        .append(`<tr>
                    <td colspan=5 class="text-center font-italic">
                        Belum Ada Transaksi
                    </td>
                </tr>`)
}

const showToday = () => {
    axios.get('/api/invoices-today')
            .then(res => {
                let invoices = res.data.data;
                $('#detail-table').empty();

                let i = 1;
                let total = 0;

                if (invoices.length < 1) {
                    $('#detail-table')
                    .append(`<tr>
                                <td class="text-center" colspan="5>
                                    <i>Belum Ada Transaksi Hari Ini</i>
                                </td>
                            </tr>`)
                } else {
                    invoices.map(invoice =>{
                        let currency = invoice.jumlah ? new Number(invoice.jumlah).toLocaleString("id-ID") : '-';

                        let status = invoice.status == 'belum' ? 'Belum Bayar' : 'Sudah Bayar';
                        
                        let color = invoice.status == 'belum' ? 'text-danger' : 'text-success';

                        let visible = invoice.status == 'belum' ? 'd-block' : 'd-none';
                        total += invoice.jumlah ? parseInt(invoice.jumlah) : 0;

                        $('#detail-table')
                        .append(`<tr>
                                    <td class="text-center">${i++}</td>
                                    <td class="text-center">${invoice.nomor}</td>
                                    <td class="text-center">${invoice.nama}</td>
                                    <td class="text-right">Rp. ${currency}</td>
                                    <td class="${color}">
                                        ${status}
                                    </td>
                                    <td class="${visible}">
                                        <button class="btn btn-sm btn-secondary" onclick="showDetail(${invoice.id}, ${invoice.nomor})">
                                            Bayar
                                        </button>
                                    </td>
                                </tr>`)
                    })
                    let currencyTotalToday =  new Number(total).toLocaleString("id-ID");
                    totalToday.innerText = currencyTotalToday;
                }

            })
            .catch(err => {
                console.log(err);
            })
}

const getInvoiceDetails = (invoiceId) => {
    return axios.get(`/api/get-invoice-detail/${invoiceId}`)
                .then(res => res.data.data)
                .catch(err => err)
}

const updateInvoiceStatus = (data) => {
    return axios.put(`/api/invoice-update`, data)
            .then(res => {
                console.log(res.data);
                
            })
            .catch(err => {
                console.log(err);
            })
}

const showDetail = async (invoiceId, nomorNota) => {

    detailTodayCard.classList.add('d-none');
    detailCard2.classList.remove('d-none');
    let getInvoices = await getInvoiceDetails(invoiceId);
    nomorNotaState = nomorNota;
    let i = 1;
    let total = 0;
    
    $('#detail-invoice-table').empty();    

    getInvoices.map(detail=>{
        let currencyharga = new Number(detail.harga).toLocaleString("id-ID");

        let currencyTotal = new Number(detail.harga * detail.jumlah).toLocaleString("id-ID");

        total += detail.harga * detail.jumlah;
        $('#detail-invoice-table')
        .append(`<tr>
                    <td class="text-center">${i++}</td>
                    <td class="text-left">${detail.nama_produk}</td>
                    <td class="text-right">Rp. ${currencyharga}</td>
                    <td class="text-center">${detail.jumlah}</td>
                    <td class="text-right">Rp. ${currencyTotal}</td>
                    
                </tr>`)
    })

    let currencyTotal = new Number(total).toLocaleString("id-ID");

    totalInvoiceDetail.innerText = currencyTotal;
}

const hapusData = (id) => {
    invoiceDetailId = id;
}

window.addEventListener('load', function(){
    setInvoiceNumber();
    resetDetail();
    showToday();
})

cariNama.addEventListener('keyup', function(){
    let search = cariNama.value;

    axios.get(`/api/search-customer?search=${search}`)
        .then(response => {
            let results = response.data.data;

            $('#daftar-cari-nama').empty();
            if (results.length < 1) {
                $('#daftar-cari-nama')
                .append(`<a class="dropdown-item font-italic" href="#">Nama Tidak Ditemukan</a>`);
            } else {
                results.map(result => {
                    $('#daftar-cari-nama')
                    .append(`<a class="dropdown-item" href="#" onclick="pilihNama(${result.id}, '${result.nama}')">${result.nama}</a>
                    `);
                    $('#daftar-cari-nama')
                    .append(`<div class="dropdown-divider"></div>`);
                })
            }
        })
        .catch(err => {
            console.log(err);
        })
})

cariProduk.addEventListener('keyup', function(){
    let search = cariProduk.value;
    axios.get(`/api/seacrh-product?search=${search}`)
            .then(response => {
                let results = response.data.data;

                $('#daftar-cari-produk').empty();
                    
                if (results.length < 1) {
                    $('#daftar-cari-produk')
                    .append(`<a class="dropdown-item font-italic" href="#">Produk Tidak Ditemukan</a>`);
                } else {
                    results.map(result => {
                        $('#daftar-cari-produk')
                        .append(`<a class="dropdown-item" href="#" onclick="pilihProduk(${result.id}, '${result.nama_produk}', ${result.harga})">${result.nama_produk}</a>
                        `);
                        $('#daftar-cari-produk')
                        .append(`<div class="dropdown-divider"></div>`);
                    })
                    
                }
            })
            .catch(err => {
                console.log(err);
            })
})

submitForm.addEventListener('click', function(){
    
    let data = {
        nomorNota: nomorNota.value,
        idPelanggan: idPelanggan.value,
        namaPelanggan: inputNama.value,
        idProduk: idProduk.value,
        namaProduk: namaProduk.value,
        inputHarga: inputHarga.value,
        qty: qty.value
    };

    // simpan ke database
    axios.post(`/api/invoice`, data)
            .then(response => {
                let invoiceId = response.data.data.id;
                getInvoiceDetail(invoiceId);
            })
            .catch(err => {
                console.log(err);
            })

    // hapus element input produk, input harga dan set qty = 1
    idProduk.value = '';
    namaProduk.value = '';
    inputHarga.value = '';
    cariProduk.value = '';
    qty.value = 1;

})

const getInvoiceDetail = (invoiceId) => {
    // tampilkan detail

    axios.get(`/api/get-invoice-detail/${invoiceId}`)
            .then(res => {
                $('.table-body').empty();
                let data = res.data.data;
                let i = 1;

                totalInvoice = 0;
                
                data.map(data => {
                    let currencyHarga = new Number(data.harga).toLocaleString("id-ID");

                    let total = data.harga * data.jumlah;

                    totalInvoice += total;

                    let currencyTotal = new Number(total).toLocaleString("id-ID");

                    $('.table-body')
                    .append(`<tr>
                                <td class="text-center">${i++}</td>
                                <td>${data.nama_produk}</td>
                                <td class="text-center">Rp. ${currencyHarga}</td>
                                <td class="text-center">${data.jumlah}</td>
                                <td class="text-center">Rp ${currencyTotal}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal" onClick="hapusData(${data.id})">Hapus</button>

                                </td>
                            </tr>`)
                });

                let totalInvoiceCurrency = new Number(totalInvoice).toLocaleString("id-ID");

                totalBelanja.innerText = totalInvoiceCurrency;
                
            })
            .catch(err => {
                console.log(err);
            })
}

confirmModal.addEventListener('click', function(){
    
    axios.delete(`/api/get-invoice-detail/${invoiceDetailId}`)
            .then(res => {
                let invoiceDetail = res.data.data;
                $('#deleteConfirmationModal').modal('toggle');
                getInvoiceDetail(invoiceDetail.invoice_id);
            })
            .catch(err => {
                console.log(err);
            })

})

newInvoice.addEventListener('click', function(){
    inputNama.value = '';
    setInvoiceNumber();
    resetDetail();
    showToday();
})

bayar.addEventListener('click', async function(){
    // ubah status bayar dan update jumlah pada tabel invoice
    console.log(nomorNota.value);
    let data = {
        nomorNota: nomorNota.value
    }

    await updateInvoiceStatus(data);

    inputNama.value = '';
    setInvoiceNumber();
    resetDetail();
    showToday();
})

bayar2.addEventListener('click', async function(){
        let data = {
        nomorNota: nomorNotaState
    }

    await updateInvoiceStatus(data);

    inputNama.value = '';
    setInvoiceNumber();
    resetDetail();
    showToday();
    detailTodayCard.classList.remove('d-none');
    detailCard2.classList.add('d-none');
    $('#detail-invoice-table').empty(); 
})

backToTodayDetail.addEventListener('click', function(){
    detailTodayCard.classList.remove('d-none');
    detailCard2.classList.add('d-none');
})