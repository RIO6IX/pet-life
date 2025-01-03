function scrolldown() {
    document.getElementById("book-service-btn").addEventListener("click", function () {
        document.getElementById("booking").scrollIntoView({behavior: "smooth"})
    })
}
