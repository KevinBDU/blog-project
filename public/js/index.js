const searchForm = document.getElementById('search-article')
console.log(searchForm)
searchForm.addEventListener("submit", function (e) {
    e.preventDefault()
    e.stopPropagation()
    const userSearch = this.elements["search-value"].value
    const urlEncoded = encodeURI(`${BASE_URL}?userSearch=${userSearch}`)
    console.log(urlEncoded)
    window.location = urlEncoded
});