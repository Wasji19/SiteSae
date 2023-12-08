

/* si ca marche pas aller voir la vidéo du mec : https://www.youtube.com/watch?v=TlP5WIxVirU */




const userCardTemplate = document.querySelector("[data-user-template]")
const userCardContainer = document.querySelector("[data-user-cards-container]")
const searchInput = document.querySelector("[data-search]")

let users = []

searchInput.addEventListener("input", e => {
  const value = e.target.value.toLowerCase()
  users.forEach(user => {
    const isVisible =
      user.name.toLowerCase().includes(value) ||
      user.descrpiton.toLowerCase().includes(value) ||
      user.age.toLowerCase().includes(values)
    user.element.classList.toggle("hide", !isVisible)
  })
})

fetch("notre fichier j'crois")
  .then(res => res.json())
  .then(data => {
    users = data.map(user => {
      const card = userCardTemplate.content.cloneNode(true).children[0]
      const header = card.querySelector("[data-name || data-age]")    /* pas sur du || data-Age c'est moi j'ai ajouté   */
      const body = card.querySelector("[data-description]")
      header.textContent = user.name
      header.textContent = user.age
      body.textContent = user.descrpiton
      userCardContainer.append(card)
      return { Name: user.name, Age: user.age, descrpiton: user.descrpiton, element: card }
    })
  })
