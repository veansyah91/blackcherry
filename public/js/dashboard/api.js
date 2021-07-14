const getMonthlyIncome = () => {
    return axios.get('/api/monthly-income')
                .then(res=>res.data.data)
                .catch(err=>err)
}

const getMonthlyOutcome = () => {
    return axios.get('/api/monthly-outcome')
                .then(res=>res.data.data)
                .catch(err=>err)
}