let menu_buttons = document.querySelectorAll(".btn")

menu_buttons.forEach(btn => {
    btn.addEventListener('click', () => {
        if ("active" in btn.classList) {
            btn.classList.remove("active")
        }
        console.log(btn.classList)
        btn.classList.add("active")
    })
});

