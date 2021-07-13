// global state
let start = 0;

// defenisikan elemen input 
const inputTanggal = document.getElementById('input-tanggal');

// defenisikan elemen validasi
const validasiTanggal = document.getElementById('validasi-tanggal')

// defenisikan tombol
const submitForm = document.getElementById('submit-form');

const showDailyIncome = async (start) => {
    results = await getDailyIncome(start);

    $('#table-body').empty();

    let i = 1;

    if (results.length < 1) {
        $('#table-body')
            append(`<tr>
                        <td colspan="3" class="text-center font-italic">
                            Data Pemasukan Belum Ada
                        </td>
                    </tr>`)
    } else {
        results.map(result => {
            let currency = new Number(result.jumlah).toLocaleString("id-ID");

            $('#table-body')
            .append(`<tr>
                        <td class="text-center">${i++}</td>
                        <td class="text-center">${result.tanggal}</td>
                        <td class="text-center">Rp. ${currency}</td>
                    </tr>`)
        })
    }
}

window.addEventListener('load', async function(){
    console.log('haloo');
    showDailyIncome(start);
    let countData = await countDailyIncome();
    console.log(countData.data.data);
    
});

submitForm.addEventListener('click', async function(){
    let data = {
        tanggal: inputTanggal.value
    }

    result = await setDailyIncome(data);

    start = 0;

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