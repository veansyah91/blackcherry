// elemen input
const mulai = document.getElementById('mulai');
const validasiTanggalAwal = document.getElementById('validasi-tanggal-awal');

const akhir = document.getElementById('akhir');
const validasiTanggalAkhir = document.getElementById('validasi-tanggal-akhir');

const bulan = document.getElementById('bulan');
const tahun = document.getElementById('tahun');

const submitForm = document.getElementById('submit-form');

const reset = () => {
    mulai.value = '';
    akhir.value = '';

    validasiTanggalAwal.classList.add('d-none');
    validasiTanggalAkhir.classList.add('d-none');

}

const showMonthlyIncome = async () => {
    let results = await getMonthlyIncome();
    
    console.log(results);
    $('#table-body').empty();

    let i = 1;
    results.length > 0
    && results.map(result => {
        let currency = new Number(result.jumlah).toLocaleString("id-ID");

        $('#table-body')
        .append(`<tr>
                    <td>${i++}</td>
                    <td class="text-center">${result.tahun}</td>
                    <td class="text-center">${result.bulan}</td>
                    <td class="text-center">Rp. ${currency}</td>
        
                </tr>`)
    })

}

submitForm.addEventListener('click',async function(){
    let data = {
        mulai: mulai.value,
        akhir: akhir.value,
        bulan: bulan.value,
        tahun: tahun.value
    }

    let result = await setMonthlyIncome(data);

    if (result.response) {
        if (result.response.data.errors.mulai) {
            validasiTanggalAwal.classList.remove('d-none');
        } else {
            validasiTanggalAwal.classList.add('d-none');
        }

        if (result.response.data.errors.akhir) {
            validasiTanggalAkhir.classList.remove('d-none');
        } else {
            validasiTanggalAkhir.classList.add('d-none');
        }
        
    } else{
        reset();
        showMonthlyIncome();
    }

    
})

window.addEventListener('load', function(){
    showMonthlyIncome();
    let date = new Date();
    bulan.value = date.getMonth() + 1;
    tahun.value = date.getFullYear();
})