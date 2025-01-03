/* credit: Treehouse Youtube channel : https://youtu.be/aNDqzlAKmZc*/

const hamMenu = document.querySelector('.hb_menu')
const offScreenMenu = document.querySelector('.off-screen-menu')

hamMenu.addEventListener('click', () => {
    offScreenMenu.classList.toggle('active')
})