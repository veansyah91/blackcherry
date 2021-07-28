// global state
let start = 0;
let showDetail = false;
let dataLength = 0;

// elemen card 
let mainContent = document.getElementById('main-content');
let detailContent = document.getElementById('detail-content');
let showMoreParent = document.getElementById('show-more-parent');

const detailContentBody = document.getElementById('detail-content-body');

// defenisikan elemen input 
const inputTanggal = document.getElementById('input-tanggal');

// defenisikan elemen validasi
const validasiTanggal = document.getElementById('validasi-tanggal')

// defenisikan tombol
const submitForm = document.getElementById('submit-form');
const cancelShowDetailButton = document.getElementById('cancel-show-detail');
const showMore = document.getElementById('btn-show-more');

const showDailyIncome = async (start) => {
    results = await getDailyIncomes(start);    

    if (results.length < 1) {
        $('#table-body')
            .append(`<tr>
                        <td colspan="4" class="text-center font-italic">
                            Data Pemasukan Belum Ada
                        </td>
                    </tr>`)
    } else {
        results.map(result => {
            let currency = new Number(result.jumlah).toLocaleString("id-ID");

            $('#table-body')
            .append(`<tr>
                        <td class="text-center">${result.tanggal}</td>
                        <td class="text-center">Rp. ${currency}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary" onclick="getDetail(${result.id})">
                                Detail
                            </button>
                        </td>
                    </tr>`)
        })
    }
}

const getDetail = async (id) => {
    // loading state
    detailContentBody.innerHTML = `
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    `
    detailContent.classList.remove('d-none');
    mainContent.classList.add('d-none');

    let showDetails = await getDailyIncome(id);

    if (showDetails.length > 0) {
        
        let contentBody = '';
        showDetails.map(detail => {

            let detailProducts = '';

            detail.details.map(detailProduct => {
                let total = detailProduct.jumlah * detailProduct.harga;
                let currency = new Number(total).toLocaleString("id-ID");
                detailProducts += `
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        ${detailProduct.nama_produk}
                        <span> ${detailProduct.jumlah} pcs </span>
                        <span>Rp. ${currency}</span>
                    </li>`
            })

            let currency = new Number(detail.jumlah).toLocaleString("id-ID");
            contentBody += `
            <div class="list-group mb-1">
                <li class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Nomor Nota: ${detail.nomorNota}</h5>
                        <h5>${detail.nama}</h5>
                    </div>
                    <ul class="list-group">
                        ${detailProducts}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Total</strong> 
                            <span> <strong>Rp. ${currency}</strong>  </span>
                        </li>
                    </ul>
                </li>
            </div>`
            
        });
        detailContentBody.innerHTML = contentBody;
    } else {
        detailContentBody.innerHTML=`
            <div class="list-group">
                <center><i>data kosong</i></center>
            </div>`
    }

}

cancelShowDetailButton.addEventListener('click', function(){
    detailContent.classList.add('d-none');
    mainContent.classList.remove('d-none');
})

showMore.addEventListener('click', async function(){
    start += 7;
    console.log(`Start: ${start}`);
    console.log(`length: ${dataLength}`);
    dataLength > start + 7 ? showMoreParent.classList.remove('d-none') : showMoreParent.classList.add('d-none');
    showDailyIncome(start);
})

window.addEventListener('load', async function(){
    showDailyIncome(start);
    dataLength = await countDailyIncome();
    dataLength > start + 7 && showMoreParent.classList.remove('d-none');
});

submitForm.addEventListener('click', async function(){
    let data = {
        tanggal: inputTanggal.value
    }

    result = await setDailyIncome(data);
    start = 0;

    $('#table-body').empty();
    showDailyIncome(start);

    if (result.response) {
        // jika ada error
        if (result.response.data.errors.tanggal) {
            validasiTanggal.classList.remove('d-none');
        } else {
            validasiTanggal.classList.add('d-none');
        }
    }    
})