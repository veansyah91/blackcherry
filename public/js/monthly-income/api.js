const getMonthlyIncome = () => {
    return axios.get('/api/monthly-income')
                .then(res=>res.data.data)
                .catch(err=>err)
}

const setMonthlyIncome = (data) => {
    return axios.put('/api/monthly-income', data)
                .then(res=>res.data)
                .catch(err=>err)
}