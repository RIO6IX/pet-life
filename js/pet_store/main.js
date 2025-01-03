// credit: www.w3school.com

const slider = document.getElementById('slider')
const prevBtn = document.getElementById('prevBtn')
const nextBtn = document.getElementById('nextBtn')

const scrollAmount = 300

let currentPosition = 0

nextBtn.addEventListener('click', () => {
    const maxScroll = slider.scrollWidth - slider.clientWidth

    if (currentPosition < maxScroll) {
        currentPosition += scrollAmount
        slider.style.transform = `translateX(-${currentPosition}px)`
    }
})

prevBtn.addEventListener('click', () => {
    if (currentPosition > 0) {
        currentPosition -= scrollAmount
        slider.style.transform = `translateX(-${currentPosition}px)`
    }
})