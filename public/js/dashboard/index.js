// elemen card
const lastIncome = document.getElementById('last-income');
const detailIncome = document.getElementById('detail-income');

const lastOutcome = document.getElementById('last-outcome');
const detailOutcome = document.getElementById('detail-outcome');

const labels = [];

const dataIncomes = [];
const dataOutcomes = [];

const data = {
    labels: labels,
    datasets: [
        {
            label: 'Pemasukan/Omset',
            backgroundColor: 'rgb(52,144,220)',
            borderColor: 'rgb(52,144,220)',
            data: dataIncomes,
        },
        {
            label: 'Pengeluaran',
            backgroundColor: 'rgb(227,52,47)',
            borderColor: 'rgb(227,52,47)',
            data: dataOutcomes,
        },
        
    ]
};

const config = {
    type: 'bar',
    data,
    options: {}
};


window.addEventListener('load', async function()
{
    let incomes = await getMonthlyIncome();
    let outcomes = await getMonthlyOutcome();

    console.log(outcomes[0].bulan);
    
    let lastIncomeCurrency = new Number(incomes[0].jumlah).toLocaleString("id-ID");
    let lastOutcomeCurrency = new Number(outcomes[0].jumlah).toLocaleString("id-ID");

    lastIncome.innerText = `Rp. ${lastIncomeCurrency}`;
    detailIncome.innerText = `Bulan ${incomes[0].bulan}, ${incomes[0].tahun}`;

    lastOutcome.innerText = `Rp. ${lastOutcomeCurrency}`;
    detailOutcome.innerText = `Bulan ${outcomes[0].bulan}, ${outcomes[0].tahun}`;

    let i = 0;
    incomes.map(income => {
        dataIncomes[i] = income.jumlah;
        i++;
    })

    i = 0;
    outcomes.map(outcome => {
        dataOutcomes[i] = outcome.jumlah;
        labels[i] = outcome.bulan
        i++;
    })

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
})