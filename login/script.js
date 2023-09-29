$(".flip").click(function () {
    $(this).parents(".card__inner").toggleClass("flipped");
});
$(".clickcard").click(function () {
    $(this).toggleClass("flipped");
});

// let container = document.getElementById('container')

// toggle = () => {
// 	container.classList.toggle('sign-in')
// 	container.classList.toggle('sign-up')
// }

// setTimeout(() => {
// 	container.classList.add('sign-in')
// }, 200)