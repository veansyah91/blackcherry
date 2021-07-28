
const getDailyIncomes = (start) => {
    // tampilkan setiap 7 hari 
    return axios.get(`/api/daily-income?start=${start}`)
                .then(res => res.data.data)
                .catch(err => err)
}

const setDailyIncome = (data) => {
    return axios.put('/api/daily-income', data)
                .then(res => res)
                .catch(err => err)
}

const countDailyIncome = () => {
    return axios.get('/api/count-daily-income')
                .then(res=>res.data.data)
                .catch(err=>err)
}

const getSingleDailyIncome = () => {
    return axios.get(`/api/single-daily-income`)
                .then(res=>res.data.data)
                .catch(err => err)
}

const getDailyIncome = (id) => {
    return axios.get(`/api/daily-income/${id}`)
                .then(res=>res.data.data)
                .catch(err=>err)
}