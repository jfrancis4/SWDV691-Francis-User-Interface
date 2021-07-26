/* Javascript file to activate the hamburger menu, eventListener is added to the toggle button, and when it is clicked the navbarLinks becomes active */
const toggleButton = document.getElementsByClassName('toggle-button')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]

toggleButton.addEventListener('click', () => {
  navbarLinks.classList.toggle('active')
})



